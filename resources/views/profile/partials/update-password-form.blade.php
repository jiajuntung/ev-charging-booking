<section>
    <p class="text-sm text-gray-400 mb-6">Use a long, random password to keep your account secure.</p>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div x-data="{ show: false }">
            <label for="update_password_current_password" class="block text-sm font-bold text-[#664c35] mb-1.5">Current Password</label>
            <div class="flex items-center rounded-xl border border-gray-200 bg-[#faf8f5] overflow-hidden focus-within:border-[#89a57b] focus-within:ring-2 focus-within:ring-[#89a57b]/20 transition">
                <input id="update_password_current_password" name="current_password" :type="show ? 'text' : 'password'" autocomplete="current-password"
                    class="flex-1 px-4 py-3 bg-[#faf8f5] text-gray-800 text-sm" style="border:none;outline:none;box-shadow:none;">
                <button type="button" @click="show = !show" class="px-3 bg-[#faf8f5] text-gray-400 hover:text-[#89a57b] transition shrink-0">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>
            @error('current_password', 'updatePassword')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password -->
        <div x-data="{ show: false }">
            <label for="update_password_password" class="block text-sm font-bold text-[#664c35] mb-1.5">New Password</label>
            <div class="flex items-center rounded-xl border border-gray-200 bg-[#faf8f5] overflow-hidden focus-within:border-[#89a57b] focus-within:ring-2 focus-within:ring-[#89a57b]/20 transition">
                <input id="update_password_password" name="password" :type="show ? 'text' : 'password'" autocomplete="new-password"
                    class="flex-1 px-4 py-3 bg-[#faf8f5] text-gray-800 text-sm" style="border:none;outline:none;box-shadow:none;">
                <button type="button" @click="show = !show" class="px-3 bg-[#faf8f5] text-gray-400 hover:text-[#89a57b] transition shrink-0">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>
            @error('password', 'updatePassword')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div x-data="{ show: false }">
            <label for="update_password_password_confirmation" class="block text-sm font-bold text-[#664c35] mb-1.5">Confirm New Password</label>
            <div class="flex items-center rounded-xl border border-gray-200 bg-[#faf8f5] overflow-hidden focus-within:border-[#89a57b] focus-within:ring-2 focus-within:ring-[#89a57b]/20 transition">
                <input id="update_password_password_confirmation" name="password_confirmation" :type="show ? 'text' : 'password'" autocomplete="new-password"
                    class="flex-1 px-4 py-3 bg-[#faf8f5] text-gray-800 text-sm" style="border:none;outline:none;box-shadow:none;">
                <button type="button" @click="show = !show" class="px-3 bg-[#faf8f5] text-gray-400 hover:text-[#89a57b] transition shrink-0">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>
            @error('password_confirmation', 'updatePassword')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                class="bg-[#89a57b] hover:bg-[#7a9470] text-white font-bold px-6 py-2.5 rounded-xl transition shadow-sm text-sm">
                Update Password
            </button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-[#4a7a3d] font-medium">
                    ✓ Password updated
                </p>
            @endif
        </div>
    </form>
</section>
