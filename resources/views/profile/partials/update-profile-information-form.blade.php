<section>
    <p class="text-sm text-gray-400 mb-6">Update your name and email address.</p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-bold text-[#664c35] mb-1.5">Full Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-[#faf8f5] text-gray-800 text-sm
                       focus:outline-none focus:border-[#89a57b] focus:ring-2 focus:ring-[#89a57b]/20 transition">
            @error('name')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-bold text-[#664c35] mb-1.5">Email Address</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-[#faf8f5] text-gray-800 text-sm
                       focus:outline-none focus:border-[#89a57b] focus:ring-2 focus:ring-[#89a57b]/20 transition">
            @error('email')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 p-3 bg-amber-50 border border-amber-200 rounded-xl">
                    <p class="text-sm text-amber-700">
                        Your email is unverified.
                        <button form="send-verification" class="font-bold underline hover:text-amber-900 transition">
                            Resend verification email
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1 text-sm text-[#4a7a3d] font-medium">Verification link sent!</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                class="bg-[#89a57b] hover:bg-[#7a9470] text-white font-bold px-6 py-2.5 rounded-xl transition shadow-sm text-sm">
                Save Changes
            </button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-[#4a7a3d] font-medium">
                    ✓ Saved successfully
                </p>
            @endif
        </div>
    </form>
</section>
