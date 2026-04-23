<x-app-layout>
    <div class="min-h-screen bg-[#efede6] py-10 px-4">
        <div class="max-w-3xl mx-auto space-y-6">

            <!-- Page Header -->
            <div class="mb-2">
                <h1 class="text-3xl font-black text-[#664c35] tracking-tight">My Profile</h1>
                <p class="text-sm text-[#89a57b] mt-1 font-medium">Manage your account settings</p>
            </div>

            <!-- Profile Information -->
            <div class="bg-white rounded-3xl shadow-md border border-[#e8e2d9] overflow-hidden">
                <div class="bg-[#89a57b] px-6 py-4 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span class="text-white text-xs font-bold uppercase tracking-widest">Profile Information</span>
                </div>
                <div class="px-8 py-8">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-white rounded-3xl shadow-md border border-[#e8e2d9] overflow-hidden">
                <div class="bg-[#89a57b] px-6 py-4 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </div>
                    <span class="text-white text-xs font-bold uppercase tracking-widest">Update Password</span>
                </div>
                <div class="px-8 py-8">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-white rounded-3xl shadow-md border border-red-100 overflow-hidden">
                <div class="bg-red-500 px-6 py-4 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                        </svg>
                    </div>
                    <span class="text-white text-xs font-bold uppercase tracking-widest">Delete Account</span>
                </div>
                <div class="px-8 py-8">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
