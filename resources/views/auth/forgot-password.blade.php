<x-guest-layout>
    <div class="w-full max-w-md rounded-[32px] bg-white shadow-[0_18px_40px_rgba(0,0,0,0.10)] overflow-hidden border border-gray-100">

        <div class="h-3 bg-[#89a57b]"></div>

        <div class="px-8 py-10">

            <!-- Logo & Title -->
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center gap-2 mb-4">
                    <img src="{{ asset('images/car-logo.png') }}" class="h-10 w-auto" alt="Logo">
                </a>
                <h1 class="text-3xl font-black text-[#664c35] tracking-tight">Forgot Password?</h1>
                <p class="text-sm text-gray-500 mt-2 leading-relaxed">No problem. Enter your email and we'll send you a reset link.</p>
                <div class="w-10 h-1 bg-[#89a57b] mx-auto mt-3 rounded-full"></div>
            </div>

            <!-- Status -->
            @if (session('status'))
                <div class="mb-5 flex items-center gap-2 text-sm text-[#4a7a3d] bg-[#eaf3e6] border border-[#89a57b] rounded-xl px-4 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-bold text-[#664c35] mb-1.5">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-[#faf8f5] text-gray-800 text-sm
                               focus:outline-none focus:border-[#89a57b] focus:ring-2 focus:ring-[#89a57b]/20 transition">
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-[#89a57b] hover:bg-[#7a9470] active:bg-[#6b8561] text-white font-bold py-3.5 rounded-xl transition shadow-sm text-base">
                    Send Reset Link
                </button>

                <!-- Back to Login -->
                <p class="text-center text-sm text-gray-500">
                    Remembered your password?
                    <a href="{{ route('login') }}" class="text-[#89a57b] hover:text-[#664c35] font-bold transition">Sign In</a>
                </p>

            </form>
        </div>
    </div>
</x-guest-layout>
