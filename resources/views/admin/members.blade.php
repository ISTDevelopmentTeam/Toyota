<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toyota x AAP - Member Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'toyota-red': '#eb0a1e',
                        'toyota-dark': '#1a1a1a',
                        'premium-gold': '#ffd700',
                        'premium-orange': '#ff8c00'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen">
    <div x-data="memberManager()" class="min-h-screen">
        <!-- Mobile-Optimized Header -->
        <header class="bg-toyota-dark shadow-2xl border-b border-yellow-500/30 sticky top-0 z-40">
            <div class="container mx-auto px-4 sm:px-6 py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2 sm:space-x-4">
                        <div class="bg-gradient-to-r from-premium-gold to-premium-orange p-1.5 sm:p-2 rounded-lg transform rotate-45">
                            <div class="w-4 h-4 sm:w-6 sm:h-6 bg-toyota-dark rounded transform -rotate-45 flex items-center justify-center">
                                <span class="text-premium-gold text-xs font-bold">T</span>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-lg sm:text-2xl font-bold bg-gradient-to-r from-premium-gold to-premium-orange bg-clip-text text-transparent">
                                <span class="hidden sm:inline">PREMIUM AUTOMOTIVE PARTNERSHIP</span>
                                <span class="sm:hidden">PAP ADMIN</span>
                            </h1>
                            <p class="text-gray-400 text-xs sm:text-sm">
                                <span class="hidden sm:inline">Toyota x AAP Member Management</span>
                                <span class="sm:hidden">Member Management</span>
                            </p>
                        </div>
                    </div>
                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="sm:hidden text-white p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        <div class="container mx-auto px-4 sm:px-6 py-4 sm:py-8">
            <!-- Mobile-Responsive Statistics Dashboard -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 mb-6 sm:mb-8">
                <div class="bg-gradient-to-br from-blue-500/20 to-blue-600/10 backdrop-blur-sm border border-blue-500/30 rounded-xl sm:rounded-2xl p-3 sm:p-6 hover:border-blue-400/50 transition-all duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex-1">
                            <h3 class="text-blue-300 text-xs sm:text-sm font-medium mb-1 sm:mb-2">Total Members</h3>
                            <p class="text-xl sm:text-3xl font-bold text-white" x-text="stats.total_members || 0"></p>
                            <p class="text-blue-200 text-xs mt-1 hidden sm:block">Registered users</p>
                        </div>
                        <div class="w-8 h-8 sm:w-12 sm:h-12 bg-blue-500/20 rounded-full flex items-center justify-center mt-2 sm:mt-0">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-yellow-500/20 to-yellow-600/10 backdrop-blur-sm border border-yellow-500/30 rounded-xl sm:rounded-2xl p-3 sm:p-6 hover:border-yellow-400/50 transition-all duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex-1">
                            <h3 class="text-yellow-300 text-xs sm:text-sm font-medium mb-1 sm:mb-2">Pending</h3>
                            <p class="text-xl sm:text-3xl font-bold text-white" x-text="stats.pending_members || 0"></p>
                            <p class="text-yellow-200 text-xs mt-1 hidden sm:block">Awaiting approval</p>
                        </div>
                        <div class="w-8 h-8 sm:w-12 sm:h-12 bg-yellow-500/20 rounded-full flex items-center justify-center mt-2 sm:mt-0">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-500/20 to-green-600/10 backdrop-blur-sm border border-green-500/30 rounded-xl sm:rounded-2xl p-3 sm:p-6 hover:border-green-400/50 transition-all duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex-1">
                            <h3 class="text-green-300 text-xs sm:text-sm font-medium mb-1 sm:mb-2">Approved</h3>
                            <p class="text-xl sm:text-3xl font-bold text-white" x-text="stats.approved_members || 0"></p>
                            <p class="text-green-200 text-xs mt-1 hidden sm:block">Active members</p>
                        </div>
                        <div class="w-8 h-8 sm:w-12 sm:h-12 bg-green-500/20 rounded-full flex items-center justify-center mt-2 sm:mt-0">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-red-500/20 to-red-600/10 backdrop-blur-sm border border-red-500/30 rounded-xl sm:rounded-2xl p-3 sm:p-6 hover:border-red-400/50 transition-all duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex-1">
                            <h3 class="text-red-300 text-xs sm:text-sm font-medium mb-1 sm:mb-2">Archived</h3>
                            <p class="text-xl sm:text-3xl font-bold text-white" x-text="stats.archived_members || 0"></p>
                            <p class="text-red-200 text-xs mt-1 hidden sm:block">Inactive members</p>
                        </div>
                        <div class="w-8 h-8 sm:w-12 sm:h-12 bg-red-500/20 rounded-full flex items-center justify-center mt-2 sm:mt-0">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile-Responsive Controls Panel -->
            <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl sm:rounded-2xl p-4 sm:p-6 mb-6 sm:mb-8">
                <!-- Mobile Collapsible Filters -->
                <div class="sm:hidden mb-4">
                    <button @click="filtersOpen = !filtersOpen" 
                            class="w-full flex items-center justify-between bg-gray-700/50 rounded-lg p-3 text-white font-medium">
                        <span>Filters & Search</span>
                        <svg class="w-5 h-5 transform transition-transform" :class="filtersOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>

                <div :class="filtersOpen ? 'block' : 'hidden sm:block'">
                    <!-- View Toggle - Always Visible on Desktop -->
                    <div class="flex bg-gray-700/50 rounded-xl p-1 mb-4 sm:mb-0">
                        <button @click="currentView = 'active'; fetchMembers()" 
                                :class="currentView === 'active' ? 'bg-gradient-to-r from-premium-gold to-premium-orange text-toyota-dark' : 'text-gray-300 hover:text-white'"
                                class="flex-1 px-3 sm:px-6 py-2 rounded-lg font-medium transition-all duration-300 text-sm sm:text-base">
                            <span class="hidden sm:inline">Active Members</span>
                            <span class="sm:hidden">Active</span>
                        </button>
                        <button @click="currentView = 'archived'; fetchMembers()" 
                                :class="currentView === 'archived' ? 'bg-gradient-to-r from-premium-gold to-premium-orange text-toyota-dark' : 'text-gray-300 hover:text-white'"
                                class="flex-1 px-3 sm:px-6 py-2 rounded-lg font-medium transition-all duration-300 text-sm sm:text-base">
                            <span class="hidden sm:inline">Archived Members</span>
                            <span class="sm:hidden">Archived</span>
                        </button>
                    </div>

                    <!-- Mobile Stacked Filters -->
                    <div class="sm:hidden space-y-3 mt-4">
                        <select x-model="statusFilter" @change="fetchMembers()" 
                                class="w-full bg-gray-700/70 border border-gray-600/50 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-premium-gold/50 focus:border-premium-gold/50">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>

                        <select x-model="searchCriteria" 
                                class="w-full bg-gray-700/70 border border-gray-600/50 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-premium-gold/50 focus:border-premium-gold/50">
                            <option value="all">Search All Fields</option>
                            <option value="firstname">First Name</option>
                            <option value="lastname">Last Name</option>
                            <option value="email">Email</option>
                            <option value="contact">Contact</option>
                        </select>

                        <div class="relative">
                            <input type="text" x-model="searchQuery" @input="debounceSearch()" 
                                   :placeholder="getSearchPlaceholder()"
                                   class="w-full bg-gray-700/70 border border-gray-600/50 text-white rounded-xl pl-10 pr-4 py-3 focus:ring-2 focus:ring-premium-gold/50 focus:border-premium-gold/50">
                            <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Desktop Horizontal Filters -->
                    <div class="hidden sm:flex sm:flex-wrap gap-4 items-center justify-end mt-4">
                        <select x-model="statusFilter" @change="fetchMembers()" 
                                class="bg-gray-700/70 border border-gray-600/50 text-white rounded-xl px-4 py-2 focus:ring-2 focus:ring-premium-gold/50 focus:border-premium-gold/50">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>

                        <select x-model="searchCriteria" 
                                class="bg-gray-700/70 border border-gray-600/50 text-white rounded-xl px-4 py-2 focus:ring-2 focus:ring-premium-gold/50 focus:border-premium-gold/50">
                            <option value="all">Search All Fields</option>
                            <option value="firstname">First Name</option>
                            <option value="lastname">Last Name</option>
                            <option value="email">Email</option>
                            <option value="contact">Contact</option>
                        </select>

                        <div class="relative">
                            <input type="text" x-model="searchQuery" @input="debounceSearch()" 
                                   :placeholder="getSearchPlaceholder()"
                                   class="bg-gray-700/70 border border-gray-600/50 text-white rounded-xl pl-10 pr-4 py-2 w-80 focus:ring-2 focus:ring-premium-gold/50 focus:border-premium-gold/50">
                            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading State -->
            <div x-show="loading" class="text-center py-16">
                <div class="inline-block animate-spin rounded-full h-8 w-8 sm:h-12 sm:w-12 border-t-2 border-b-2 border-premium-gold"></div>
                <p class="mt-4 text-gray-400 text-sm sm:text-base">Loading members...</p>
            </div>

            <!-- Mobile-Responsive Members Display -->
            <div x-show="!loading" class="bg-gray-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl sm:rounded-2xl overflow-hidden">
                <!-- Desktop Table View -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gradient-to-r from-gray-900/80 to-gray-800/80">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Member</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Contact Info</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Registration Date</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700/50">
                            <template x-for="member in members" :key="member.id">
                                <tr class="hover:bg-gray-700/30 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-br from-premium-gold to-premium-orange rounded-full flex items-center justify-center mr-3">
                                                <span class="text-toyota-dark font-semibold text-sm" x-text="(member.firstname?.charAt(0) || '') + (member.lastname?.charAt(0) || '')"></span>
                                            </div>
                                            <div>
                                                <div class="text-white font-medium" x-text="member.firstname + ' ' + (member.middlename || '') + ' ' + member.lastname"></div>
                                                <div class="text-gray-400 text-sm" x-text="'ID: ' + member.id"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-white" x-text="member.email"></div>
                                        <div class="text-gray-400 text-sm" x-text="member.contact"></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span :class="getStatusClass(member.status)" class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full">
                                            <span class="w-2 h-2 mr-2 rounded-full" :class="getStatusDotClass(member.status)"></span>
                                            <span x-text="member.status.toUpperCase()"></span>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-white text-sm" x-text="new Date(member.created_at).toLocaleDateString('en-US', {year: 'numeric', month: 'short', day: 'numeric'})"></div>
                                        <div x-show="member.deleted_at" class="text-red-400 text-xs">
                                            Archived: <span x-text="new Date(member.deleted_at).toLocaleDateString('en-US', {month: 'short', day: 'numeric'})"></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <template x-if="!member.deleted_at">
                                            <div class="flex space-x-2">
                                                <template x-if="member.status === 'pending'">
                                                    <div class="flex space-x-2">
                                                        <button @click="updateStatus(member.id, 'approved')" 
                                                                class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-3 py-1 rounded-lg text-xs font-medium transition-all duration-300 transform hover:scale-105">
                                                            ✓ Approve
                                                        </button>
                                                        <button @click="updateStatus(member.id, 'rejected')" 
                                                                class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-3 py-1 rounded-lg text-xs font-medium transition-all duration-300 transform hover:scale-105">
                                                            ✗ Reject
                                                        </button>
                                                    </div>
                                                </template>
                                                
                                                <template x-if="member.status !== 'pending'">
                                                    <button @click="updateStatus(member.id, 'pending')" 
                                                            class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-3 py-1 rounded-lg text-xs font-medium transition-all duration-300 transform hover:scale-105">
                                                        ⟳ Set Pending
                                                    </button>
                                                </template>

                                                <button @click="archiveMember(member.id)" 
                                                        class="bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white px-3 py-1 rounded-lg text-xs font-medium transition-all duration-300 transform hover:scale-105">
                                                    📁 Archive
                                                </button>
                                            </div>
                                        </template>

                                        <template x-if="member.deleted_at">
                                            <div class="flex space-x-2">
                                                <button @click="restoreMember(member.id)" 
                                                        class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-3 py-1 rounded-lg text-xs font-medium transition-all duration-300 transform hover:scale-105">
                                                    ↻ Restore
                                                </button>
                                                <button @click="permanentDelete(member.id)" 
                                                        class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-3 py-1 rounded-lg text-xs font-medium transition-all duration-300 transform hover:scale-105">
                                                    🗑 Delete Forever
                                                </button>
                                            </div>
                                        </template>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="lg:hidden">
                    <template x-for="member in members" :key="member.id">
                        <div class="p-4 border-b border-gray-700/50 last:border-b-0">
                            <!-- Member Header -->
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-premium-gold to-premium-orange rounded-full flex items-center justify-center">
                                        <span class="text-toyota-dark font-semibold text-sm" x-text="(member.firstname?.charAt(0) || '') + (member.lastname?.charAt(0) || '')"></span>
                                    </div>
                                    <div>
                                        <div class="text-white font-medium text-base" x-text="member.firstname + ' ' + (member.middlename || '') + ' ' + member.lastname"></div>
                                        <div class="text-gray-400 text-sm" x-text="'ID: ' + member.id"></div>
                                    </div>
                                </div>
                                <span :class="getStatusClass(member.status)" class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full">
                                    <span class="w-2 h-2 mr-1 rounded-full" :class="getStatusDotClass(member.status)"></span>
                                    <span x-text="member.status.toUpperCase()"></span>
                                </span>
                            </div>

                            <!-- Contact Info -->
                            <div class="space-y-2 mb-3">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                    <span class="text-white text-sm" x-text="member.email"></span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span class="text-gray-300 text-sm" x-text="member.contact"></span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM3 21h18M5 21V10a1 1 0 011-1h12a1 1 0 011 1v11"></path>
                                    </svg>
                                    <span class="text-gray-300 text-sm" x-text="new Date(member.created_at).toLocaleDateString('en-US', {year: 'numeric', month: 'short', day: 'numeric'})"></span>
                                </div>
                                <div x-show="member.deleted_at" class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    <span class="text-red-400 text-sm">
                                        Archived: <span x-text="new Date(member.deleted_at).toLocaleDateString('en-US', {month: 'short', day: 'numeric'})"></span>
                                    </span>
                                </div>
                            </div>

                            <!-- Mobile Actions -->
                            <div class="mt-4">
                                <template x-if="!member.deleted_at">
                                    <div class="grid grid-cols-2 gap-2">
                                        <template x-if="member.status === 'pending'">
                                            <div class="col-span-2 grid grid-cols-2 gap-2">
                                                <button @click="updateStatus(member.id, 'approved')" 
                                                        class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300">
                                                    ✓ Approve
                                                </button>
                                                <button @click="updateStatus(member.id, 'rejected')" 
                                                        class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300">
                                                    ✗ Reject
                                                </button>
                                            </div>
                                        </template>
                                        
                                        <template x-if="member.status !== 'pending'">
                                            <button @click="updateStatus(member.id, 'pending')" 
                                                    class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300">
                                                ⟳ Set Pending
                                            </button>
                                        </template>

                                        <button @click="archiveMember(member.id)" 
                                                class="bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300">
                                            Archive
                                        </button>
                                    </div>
                                </template>

                                <template x-if="member.deleted_at">
                                    <div class="grid grid-cols-2 gap-2">
                                        <button @click="restoreMember(member.id)" 
                                                class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300">
                                            ↻ Restore
                                        </button>
                                        <button @click="permanentDelete(member.id)" 
                                                class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300">
                                            Delete Forever
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>

                <div x-show="members.length === 0" class="text-center py-12 sm:py-16">
                    <div class="text-4xl sm:text-6xl text-gray-600 mb-4">📋</div>
                    <p class="text-gray-400 text-base sm:text-lg">No members found</p>
                    <p class="text-gray-500 text-sm mt-2">Try adjusting your search criteria</p>
                </div>

                <!-- Mobile-Responsive Pagination -->
                <div x-show="pagination.total > pagination.per_page" class="bg-gradient-to-r from-gray-900/80 to-gray-800/80 p-4 sm:px-6 sm:py-4 border-t border-gray-700/50">
                    <!-- Mobile Pagination -->
                    <div class="sm:hidden">
                        <div class="text-center text-sm text-gray-400 mb-3">
                            <span class="text-white font-medium" x-text="pagination.from || 0"></span> - 
                            <span class="text-white font-medium" x-text="pagination.to || 0"></span> of 
                            <span class="text-white font-medium" x-text="pagination.total || 0"></span>
                        </div>
                        <div class="flex justify-center space-x-2">
                            <button @click="changePage(pagination.current_page - 1)" 
                                    :disabled="pagination.current_page <= 1"
                                    :class="pagination.current_page <= 1 ? 'cursor-not-allowed opacity-30' : 'hover:bg-gray-600/50'"
                                    class="px-4 py-2 border border-gray-600 rounded-lg bg-gray-700/50 text-white text-sm transition-all duration-200">
                                ← Prev
                            </button>
                            
                            <span class="px-4 py-2 bg-gradient-to-r from-premium-gold to-premium-orange text-toyota-dark rounded-lg text-sm font-medium">
                                <span x-text="pagination.current_page"></span> / <span x-text="pagination.last_page"></span>
                            </span>
                            
                            <button @click="changePage(pagination.current_page + 1)" 
                                    :disabled="pagination.current_page >= pagination.last_page"
                                    :class="pagination.current_page >= pagination.last_page ? 'cursor-not-allowed opacity-30' : 'hover:bg-gray-600/50'"
                                    class="px-4 py-2 border border-gray-600 rounded-lg bg-gray-700/50 text-white text-sm transition-all duration-200">
                                Next →
                            </button>
                        </div>
                    </div>

                    <!-- Desktop Pagination -->
                    <div class="hidden sm:flex items-center justify-between">
                        <div class="text-sm text-gray-400">
                            Showing <span class="text-white font-medium" x-text="pagination.from || 0"></span> to 
                            <span class="text-white font-medium" x-text="pagination.to || 0"></span> of 
                            <span class="text-white font-medium" x-text="pagination.total || 0"></span> results
                        </div>
                        <div class="flex items-center space-x-2">
                            <button @click="changePage(pagination.current_page - 1)" 
                                    :disabled="pagination.current_page <= 1"
                                    :class="pagination.current_page <= 1 ? 'cursor-not-allowed opacity-30' : 'hover:bg-gray-600/50'"
                                    class="px-4 py-2 border border-gray-600 rounded-lg bg-gray-700/50 text-white text-sm transition-all duration-200">
                                ← Previous
                            </button>
                            
                            <template x-for="page in getPageNumbers()" :key="page">
                                <button @click="changePage(page)" 
                                        :class="page === pagination.current_page ? 'bg-gradient-to-r from-premium-gold to-premium-orange text-toyota-dark' : 'bg-gray-700/50 text-white hover:bg-gray-600/50'"
                                        class="px-3 py-2 border border-gray-600 rounded-lg text-sm transition-all duration-200 transform hover:scale-105"
                                        x-text="page">
                                </button>
                            </template>
                            
                            <button @click="changePage(pagination.current_page + 1)" 
                                    :disabled="pagination.current_page >= pagination.last_page"
                                    :class="pagination.current_page >= pagination.last_page ? 'cursor-not-allowed opacity-30' : 'hover:bg-gray-600/50'"
                                    class="px-4 py-2 border border-gray-600 rounded-lg bg-gray-700/50 text-white text-sm transition-all duration-200">
                                Next →
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile-Responsive Alert Messages -->
        <div x-show="alert.show" x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
             x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-100 transform"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             :class="alert.type === 'success' ? 'bg-gradient-to-r from-green-500/90 to-green-600/90 border-green-400' : 'bg-gradient-to-r from-red-500/90 to-red-600/90 border-red-400'"
             class="fixed top-4 right-4 left-4 sm:left-auto max-w-md border-l-4 p-4 rounded-xl shadow-2xl backdrop-blur-sm z-50">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <template x-if="alert.type === 'success'">
                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </template>
                    <template x-if="alert.type === 'error'">
                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </template>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium text-white" x-text="alert.message"></p>
                </div>
                <div class="ml-4 flex-shrink-0">
                    <button @click="alert.show = false" class="text-white hover:text-gray-200 transition-colors duration-200">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile-Responsive Confirmation Modal -->
        <div x-show="confirmModal.show" x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div x-show="confirmModal.show"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="bg-gray-800/95 backdrop-blur-sm border border-gray-700/50 rounded-2xl p-4 sm:p-6 max-w-md w-full shadow-2xl">
                
                <!-- Modal Header -->
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center mr-3"
                         :class="confirmModal.type === 'danger' ? 'bg-red-500/20' : 'bg-yellow-500/20'">
                        <template x-if="confirmModal.type === 'danger'">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </template>
                        <template x-if="confirmModal.type !== 'danger'">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </template>
                    </div>
                    <h3 class="text-base sm:text-lg font-semibold text-white" x-text="confirmModal.title"></h3>
                </div>

                <!-- Modal Body -->
                <div class="mb-6">
                    <p class="text-gray-300 text-sm sm:text-base" x-text="confirmModal.message"></p>
                    <template x-if="confirmModal.type === 'danger'">
                        <p class="text-red-400 text-sm mt-2 font-medium">This action cannot be undone!</p>
                    </template>
                </div>

                <!-- Modal Actions -->
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3 sm:justify-end">
                    <button @click="confirmModal.show = false; confirmModal.onCancel && confirmModal.onCancel()"
                            class="order-2 sm:order-1 px-4 py-3 sm:py-2 bg-gray-600/50 hover:bg-gray-600 text-white rounded-lg transition-all duration-200 font-medium text-sm sm:text-base">
                        Cancel
                    </button>
                    <button @click="confirmModal.show = false; confirmModal.onConfirm && confirmModal.onConfirm()"
                            :class="confirmModal.type === 'danger' ? 'bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700' : 'bg-gradient-to-r from-premium-gold to-premium-orange hover:from-premium-orange hover:to-premium-gold'"
                            class="order-1 sm:order-2 px-4 py-3 sm:py-2 text-white rounded-lg transition-all duration-200 font-medium transform hover:scale-105 text-sm sm:text-base"
                            x-text="confirmModal.confirmText">
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function memberManager() {
            return {
                members: [],
                stats: {},
                loading: true,
                currentView: 'active',
                statusFilter: '',
                searchQuery: '',
                searchCriteria: 'all',
                searchTimeout: null,
                pagination: {},
                filtersOpen: false, // For mobile filter toggle
                mobileMenuOpen: false, // For mobile menu toggle
                alert: {
                    show: false,
                    type: 'success',
                    message: ''
                },
                confirmModal: {
                    show: false,
                    title: '',
                    message: '',
                    confirmText: 'Confirm',
                    type: 'warning',
                    onConfirm: null,
                    onCancel: null
                },

                init() {
                    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    this.fetchStats();
                    this.fetchMembers();
                },

                async fetchStats() {
                    try {
                        const response = await axios.get('/admin/members/statistics');
                        this.stats = response.data.data;
                    } catch (error) {
                        console.error('Error fetching stats:', error);
                    }
                },

                async fetchMembers(page = 1) {
                    this.loading = true;
                    try {
                        const params = new URLSearchParams({
                            page: page,
                            per_page: 15
                        });

                        if (this.currentView === 'archived') {
                            params.append('only_deleted', 'true');
                        }

                        if (this.statusFilter) {
                            params.append('status', this.statusFilter);
                        }

                        if (this.searchQuery) {
                            params.append('search', this.searchQuery);
                            params.append('filter', this.searchCriteria);
                        }

                        const response = await axios.get(`/admin/members?${params}`);
                        this.members = response.data.data.data;
                        this.pagination = {
                            current_page: response.data.data.current_page,
                            last_page: response.data.data.last_page,
                            per_page: response.data.data.per_page,
                            total: response.data.data.total,
                            from: response.data.data.from,
                            to: response.data.data.to
                        };
                    } catch (error) {
                        console.error('Error fetching members:', error);
                        this.showAlert('Error fetching members data', 'error');
                    } finally {
                        this.loading = false;
                    }
                },

                debounceSearch() {
                    clearTimeout(this.searchTimeout);
                    this.searchTimeout = setTimeout(() => {
                        this.fetchMembers();
                    }, 500);
                },

                getSearchPlaceholder() {
                    const placeholders = {
                        'all': 'Search all fields...',
                        'firstname': 'Search by first name...',
                        'lastname': 'Search by last name...',
                        'email': 'Search by email...',
                        'contact': 'Search by contact number...'
                    };
                    return placeholders[this.searchCriteria] || 'Search members...';
                },

                async updateStatus(memberId, status) {
                    try {
                        const response = await axios.patch(`/admin/members/${memberId}/status`, {
                            status: status
                        });
                        
                        if (response.data.success) {
                            this.showAlert(`Member status updated to ${status}`, 'success');
                            this.fetchMembers();
                            this.fetchStats();
                        }
                    } catch (error) {
                        console.error('Error updating status:', error);
                        this.showAlert('Error updating member status', 'error');
                    }
                },

                async archiveMember(memberId) {
                    this.showConfirmModal({
                        title: 'Archive Member',
                        message: 'Are you sure you want to archive this member? This action can be undone later.',
                        confirmText: 'Archive',
                        type: 'warning',
                        onConfirm: async () => {
                            try {
                                const response = await axios.delete(`/admin/members/${memberId}`);
                                
                                if (response.data.success) {
                                    this.showAlert('Member archived successfully', 'success');
                                    this.fetchMembers();
                                    this.fetchStats();
                                }
                            } catch (error) {
                                console.error('Error archiving member:', error);
                                this.showAlert('Error archiving member', 'error');
                            }
                        }
                    });
                },

                async restoreMember(memberId) {
                    try {
                        const response = await axios.post(`/admin/members/${memberId}/restore`);
                        
                        if (response.data.success) {
                            this.showAlert('Member restored successfully', 'success');
                            this.fetchMembers();
                            this.fetchStats();
                        }
                    } catch (error) {
                        console.error('Error restoring member:', error);
                        this.showAlert('Error restoring member', 'error');
                    }
                },

                async permanentDelete(memberId) {
                    this.showConfirmModal({
                        title: 'Permanently Delete Member',
                        message: 'Are you sure you want to permanently delete this member? All their data will be lost forever.',
                        confirmText: 'Delete Forever',
                        type: 'danger',
                        onConfirm: async () => {
                            try {
                                const response = await axios.delete(`/admin/members/${memberId}/force`);
                                
                                if (response.data.success) {
                                    this.showAlert('Member permanently deleted', 'success');
                                    this.fetchMembers();
                                    this.fetchStats();
                                }
                            } catch (error) {
                                console.error('Error deleting member:', error);
                                this.showAlert('Error deleting member', 'error');
                            }
                        }
                    });
                },

                changePage(page) {
                    if (page >= 1 && page <= this.pagination.last_page) {
                        this.fetchMembers(page);
                    }
                },

                getPageNumbers() {
                    const pages = [];
                    const start = Math.max(1, this.pagination.current_page - 2);
                    const end = Math.min(this.pagination.last_page, this.pagination.current_page + 2);
                    
                    for (let i = start; i <= end; i++) {
                        pages.push(i);
                    }
                    
                    return pages;
                },

                getStatusClass(status) {
                    switch (status) {
                        case 'approved': return 'bg-green-500/20 text-green-300 border border-green-500/30';
                        case 'rejected': return 'bg-red-500/20 text-red-300 border border-red-500/30';
                        case 'pending': return 'bg-yellow-500/20 text-yellow-300 border border-yellow-500/30';
                        default: return 'bg-gray-500/20 text-gray-300 border border-gray-500/30';
                    }
                },

                getStatusDotClass(status) {
                    switch (status) {
                        case 'approved': return 'bg-green-400';
                        case 'rejected': return 'bg-red-400';
                        case 'pending': return 'bg-yellow-400';
                        default: return 'bg-gray-400';
                    }
                },

                showAlert(message, type = 'success') {
                    this.alert = {
                        show: true,
                        type: type,
                        message: message
                    };

                    setTimeout(() => {
                        this.alert.show = false;
                    }, 5000);
                },

                showConfirmModal(options) {
                    this.confirmModal = {
                        show: true,
                        title: options.title || 'Confirm Action',
                        message: options.message || 'Are you sure you want to proceed?',
                        confirmText: options.confirmText || 'Confirm',
                        type: options.type || 'warning',
                        onConfirm: options.onConfirm || null,
                        onCancel: options.onCancel || null
                    };
                }
            }
        }
    </script>
</body>
</html>