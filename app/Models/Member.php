<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'firstname',
        'lastname',
        'middlename',
        'contact',
        'email',
        'terms_accepted',
        'status'
    ];

    protected $casts = [
        'terms_accepted' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    /**
     * The attributes that should be included in soft deletes.
     */
    protected $dates = ['deleted_at'];

    // Accessor for full name
    public function getFullNameAttribute()
    {
        $fullName = $this->firstname;
        
        if ($this->middlename) {
            $fullName .= ' ' . $this->middlename;
        }
        
        $fullName .= ' ' . $this->lastname;
        
        return $fullName;
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Status badge color helper
    public function getStatusBadgeColorAttribute()
    {
        return match($this->status) {
            'pending' => 'yellow',
            'approved' => 'green',
            'rejected' => 'red',
            default => 'gray'
        };
    }

    // Format Philippine contact numbers
    public function getFormattedContactAttribute()
    {
        $contact = preg_replace('/[^0-9]/', '', $this->contact);
        
        if (strlen($contact) === 11 && substr($contact, 0, 2) === '09') {
            return '+63 ' . substr($contact, 1, 3) . ' ' . substr($contact, 4, 3) . ' ' . substr($contact, 7, 4);
        }
        
        return $this->contact;
    }

    /**
     * Check if member is soft deleted.
     */
    public function isDeleted(): bool
    {
        return !is_null($this->deleted_at);
    }

    // Validation rules for registration form
    public static function getValidationRules()
    {
        return [
            'firstname' => 'required|string|max:255|regex:/^[a-zA-Z\s\'-]+$/',
            'lastname' => 'required|string|max:255|regex:/^[a-zA-Z\s\'-]+$/',
            'middlename' => 'nullable|string|max:255|regex:/^[a-zA-Z\s\'-]+$/',
            'contact' => 'required|string|max:20|regex:/^(\+?63|0)(9[0-9]{9})$/',
            'email' => 'required|email|max:255|unique:members,email',
            'terms' => 'required|accepted'
        ];
    }

    // Custom validation messages
    public static function getValidationMessages()
    {
        return [
            'firstname.required' => 'First name is required.',
            'firstname.regex' => 'First name must contain only letters, spaces, apostrophes, and hyphens.',
            'lastname.required' => 'Last name is required.',
            'lastname.regex' => 'Last name must contain only letters, spaces, apostrophes, and hyphens.',
            'middlename.regex' => 'Middle name must contain only letters, spaces, apostrophes, and hyphens.',
            'contact.required' => 'Contact number is required.',
            'contact.regex' => 'Please enter a valid Philippine mobile number (09XXXXXXXXX or +639XXXXXXXXX).',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'terms.required' => 'You must accept the terms and conditions.',
            'terms.accepted' => 'You must accept the terms and conditions to proceed.'
        ];
    }
}