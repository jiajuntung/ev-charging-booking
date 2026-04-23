<x-guest-layout>
    <div class="w-full max-w-md rounded-[32px] bg-white shadow-[0_18px_40px_rgba(0,0,0,0.10)] overflow-hidden border border-gray-100">

        <div class="h-3 bg-[#89a57b]"></div>

        <div class="px-8 py-10">

            <!-- Logo & Title -->
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center gap-2 mb-4">
                    <img src="{{ asset('images/car-logo.png') }}" class="h-10 w-auto" alt="Logo">
                </a>
                <h1 class="text-3xl font-black text-[#664c35] tracking-tight">Create Account</h1>
                <p class="text-sm text-[#89a57b] mt-1 font-medium">Join us and start charging smarter</p>
                <div class="w-10 h-1 bg-[#89a57b] mx-auto mt-3 rounded-full"></div>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-bold text-[#664c35] mb-1.5">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-[#faf8f5] text-gray-800 text-sm
                               focus:outline-none focus:border-[#89a57b] focus:ring-2 focus:ring-[#89a57b]/20 transition">
                    @error('name')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-[#664c35] mb-1.5">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-[#faf8f5] text-gray-800 text-sm
                               focus:outline-none focus:border-[#89a57b] focus:ring-2 focus:ring-[#89a57b]/20 transition">
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div x-data="{ show: false }">
                    <label for="password" class="block text-sm font-bold text-[#664c35] mb-1.5">Password</label>
                    <div class="flex items-center rounded-xl border border-gray-200 bg-[#faf8f5] overflow-hidden focus-within:border-[#89a57b] focus-within:ring-2 focus-within:ring-[#89a57b]/20 transition">
                        <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="new-password"
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
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div x-data="{ show: false }">
                    <label for="password_confirmation" class="block text-sm font-bold text-[#664c35] mb-1.5">Confirm Password</label>
                    <div class="flex items-center rounded-xl border border-gray-200 bg-[#faf8f5] overflow-hidden focus-within:border-[#89a57b] focus-within:ring-2 focus-within:ring-[#89a57b]/20 transition">
                        <input id="password_confirmation" :type="show ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password"
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
                    @error('password_confirmation')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-[#89a57b] hover:bg-[#7a9470] active:bg-[#6b8561] text-white font-bold py-3.5 rounded-xl transition shadow-sm text-base">
                    Create Account
                </button>

                <!-- Login Link -->
                <p class="text-center text-sm text-gray-500">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-[#89a57b] hover:text-[#664c35] font-bold transition">Sign In</a>
                </p>

            </form>
        </div>
    </div>
</x-guest-layout>
