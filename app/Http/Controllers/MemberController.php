<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRegistrationRequest;
use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class MemberController extends Controller
{
    /**
     * Display the registration form.
     */
    public function showRegistrationForm()
    {
        return view('welcome');
    }

    /**
     * Handle member registration.
     */
    public function register(MemberRegistrationRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            // Additional server-side validation for contact number
            $contact = preg_replace('/[^0-9+]/', '', $request->contact);
            
            // Normalize contact number format
            if (preg_match('/^(\+?63|0)(9[0-9]{9})$/', $contact, $matches)) {
                $normalizedContact = '+63' . $matches[2];
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid contact number format.',
                    'errors' => [
                        'contact' => ['Please enter a valid Philippine mobile number.']
                    ]
                ], 422);
            }

            // Check if contact number already exists (including soft deleted)
            $existingContact = Member::withTrashed()->where('contact', $normalizedContact)->first();
            if ($existingContact) {
                if ($existingContact->trashed()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'This contact number was previously registered but archived. Please contact admin for restoration.',
                        'errors' => [
                            'contact' => ['This contact number was previously registered but archived.']
                        ]
                    ], 422);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'This contact number is already registered.',
                        'errors' => [
                            'contact' => ['This contact number is already registered.']
                        ]
                    ], 422);
                }
            }

            // Create the member
            $member = Member::create([
                'firstname' => ucfirst(strtolower($request->firstname)),
                'lastname' => ucfirst(strtolower($request->lastname)),
                'middlename' => $request->middlename ? ucfirst(strtolower($request->middlename)) : null,
                'contact' => $normalizedContact,
                'email' => strtolower($request->email),
                'terms_accepted' => true,
                'status' => 'pending',
            ]);

            DB::commit();

            // Log successful registration
            Log::info('New member registration', [
                'member_id' => $member->id,
                'email' => $member->email,
                'full_name' => $member->full_name,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Registration submitted successfully! We will contact you within 24-48 hours.',
                'data' => [
                    'member_id' => $member->id,
                    'full_name' => $member->full_name,
                    'email' => $member->email,
                    'status' => $member->status,
                    'formatted_contact' => $member->formatted_contact,
                ]
            ], 201);

        } catch (ValidationException $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            
            // Handle duplicate email error specifically
            if ($e->getCode() === '23000' || str_contains($e->getMessage(), 'Duplicate entry')) {
                $field = str_contains($e->getMessage(), 'email') ? 'email' : 'contact';
                $message = $field === 'email' 
                    ? 'This email address is already registered.' 
                    : 'This contact number is already registered.';
                
                return response()->json([
                    'success' => false,
                    'message' => $message,
                    'errors' => [
                        $field => [$message]
                    ]
                ], 422);
            }

            Log::error('Database error during member registration', [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'request_data' => $request->except(['_token']),
                'ip_address' => $request->ip(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'A database error occurred. Please try again later.',
            ], 500);

        } catch (\Exception $e) {
            DB::rollback();
            
            Log::error('Unexpected error during member registration', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['_token']),
                'ip_address' => $request->ip(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred. Please try again later.',
            ], 500);
        }
    }

    /**
     * Get all members (for admin).
     */
 public function index(Request $request): JsonResponse
{
    try {
        $query = Member::query();

        // Include trashed records if requested
        if ($request->boolean('include_deleted')) {
            $query->withTrashed();
        }

        // Show only deleted records if requested
        if ($request->boolean('only_deleted')) {
            $query->onlyTrashed();
        }

        // Filter by status if provided
        if ($request->has('status') && in_array($request->status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $request->status);
        }

        // Enhanced search functionality with filter support
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $filter = $request->get('filter', 'all');
            
            $query->where(function ($q) use ($search, $filter) {
                switch ($filter) {
                    case 'firstname':
                        $q->where('firstname', 'like', "%{$search}%");
                        break;
                    case 'lastname':
                        $q->where('lastname', 'like', "%{$search}%");
                        break;
                    case 'email':
                        $q->where('email', 'like', "%{$search}%");
                        break;
                    case 'contact':
                        $q->where('contact', 'like', "%{$search}%");
                        break;
                    case 'all':
                    default:
                        $q->where('firstname', 'like', "%{$search}%")
                          ->orWhere('lastname', 'like', "%{$search}%")
                          ->orWhere('middlename', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%")
                          ->orWhere('contact', 'like', "%{$search}%");
                        break;
                }
            });
        }

        $perPage = min(max($request->get('per_page', 15), 5), 100);
        $members = $query->orderBy('created_at', 'desc')
                       ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $members
        ]);

    } catch (\Exception $e) {
        Log::error('Error fetching members', [
            'error' => $e->getMessage(),
            'request_params' => $request->all(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Error fetching members data.',
        ], 500);
    }
}

    /**
     * Update member status.
     */
    public function updateStatus(Request $request, Member $member): JsonResponse
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        try {
            $oldStatus = $member->status;
            
            $member->update([
                'status' => $request->status
            ]);

            Log::info('Member status updated', [
                'member_id' => $member->id,
                'old_status' => $oldStatus,
                'new_status' => $member->status,
                'updated_by_ip' => $request->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => "Member status updated to {$member->status}.",
                'data' => $member->fresh() // Get fresh data from database
            ]);

        } catch (\Exception $e) {
            Log::error('Error updating member status', [
                'member_id' => $member->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error updating member status.',
            ], 500);
        }
    }

    /**
     * Soft delete a member (Archive).
     */
    public function destroy(Member $member): JsonResponse
    {
        try {
            $member->delete(); // Soft delete
            
            Log::info('Member archived (soft deleted)', [
                'member_id' => $member->id,
                'member_name' => $member->full_name,
                'archived_by_ip' => request()->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Member archived successfully. Can be restored anytime.',
                'data' => [
                    'member_id' => $member->id,
                    'archived_at' => $member->deleted_at
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error archiving member', [
                'member_id' => $member->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error archiving member.',
            ], 500);
        }
    }

    /**
     * Restore a soft deleted member.
     */
    public function restore($id): JsonResponse
    {
        try {
            $member = Member::withTrashed()->findOrFail($id);
            
            if (!$member->trashed()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Member is not archived.',
                ], 400);
            }

            $member->restore();
            
            Log::info('Member restored from archive', [
                'member_id' => $member->id,
                'member_name' => $member->full_name,
                'restored_by_ip' => request()->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Member restored successfully.',
                'data' => $member->fresh()
            ]);

        } catch (\Exception $e) {
            Log::error('Error restoring member', [
                'member_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error restoring member.',
            ], 500);
        }
    }

    /**
     * Permanently delete a member (Force delete).
     */
    public function forceDestroy($id): JsonResponse
    {
        try {
            $member = Member::withTrashed()->findOrFail($id);
            $memberName = $member->full_name;
            
            $member->forceDelete(); // Permanent delete
            
            Log::warning('Member permanently deleted', [
                'member_id' => $id,
                'member_name' => $memberName,
                'deleted_by_ip' => request()->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Member permanently deleted. This action cannot be undone.',
            ]);

        } catch (\Exception $e) {
            Log::error('Error permanently deleting member', [
                'member_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error permanently deleting member.',
            ], 500);
        }
    }

    /**
     * Reset auto increment ID.
     */
    public function resetAutoIncrement(): JsonResponse
    {
        try {
            // Get the current maximum ID
            $maxId = Member::withTrashed()->max('id') ?? 0;
            $nextId = $maxId + 1;
            
            // Reset auto increment to next available ID
            DB::statement("ALTER TABLE members AUTO_INCREMENT = {$nextId}");
            
            Log::info('Auto increment reset', [
                'table' => 'members',
                'reset_to' => $nextId,
                'reset_by_ip' => request()->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => "Auto increment reset to {$nextId}.",
                'data' => [
                    'next_id' => $nextId,
                    'current_max_id' => $maxId
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error resetting auto increment', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error resetting auto increment.',
            ], 500);
        }
    }

    /**
     * Clear all data and reset auto increment to 1.*/
    public function clearAllData(): JsonResponse
    {
        try {
            // Permanently delete all records including soft deleted
            Member::withTrashed()->forceDelete();
            
            // Reset auto increment to 1
            DB::statement('ALTER TABLE members AUTO_INCREMENT = 1');
            
            Log::warning('All member data cleared and auto increment reset', [
                'cleared_by_ip' => request()->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'All member data cleared and auto increment reset to 1.',
                'warning' => 'This action cannot be undone.'
            ]);

        } catch (\Exception $e) {
            Log::error('Error clearing all data', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error clearing all data.',
            ], 500);
        }
    }

    /**
     * Get member statistics.
     */
    public function statistics(): JsonResponse
    {
        try {
            $stats = [
                'total_members' => Member::count(),
                'pending_members' => Member::pending()->count(),
                'approved_members' => Member::approved()->count(),
                'rejected_members' => Member::rejected()->count(),
                'archived_members' => Member::onlyTrashed()->count(),
                'recent_registrations' => Member::where('created_at', '>=', now()->subDays(7))->count(),
                'today_registrations' => Member::whereDate('created_at', today())->count(),
            ];

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching member statistics', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error fetching statistics.',
            ], 500);
        }
    }
}