<x-app-layout>
    <div class="min-h-screen bg-[#f3f3f3] flex items-center justify-center py-10 px-4">
        <div class="w-full max-w-2xl rounded-[36px] bg-white shadow-[0_18px_40px_rgba(0,0,0,0.10)] overflow-hidden border border-gray-100">

            <div class="h-4 bg-green-500"></div>

            <div class="px-8 py-10">

                <!-- SUCCESS ICON -->
                <div class="flex flex-col items-center mb-8">
                    <div class="w-24 h-24 rounded-full bg-green-100 flex items-center justify-center mb-5 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h1 class="text-4xl font-black text-green-500 uppercase tracking-tight">Payment Successful</h1>
                    <p class="mt-2 text-base text-slate-500">Your booking has been confirmed</p>
                    <div class="w-14 h-1 bg-green-500 mx-auto mt-4 rounded-full"></div>
                </div>

                <!-- BOOKING DETAILS -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden mb-5">

                    <div class="flex items-center gap-4 px-5 py-4 border-b border-gray-100">
                        <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-500 w-32 shrink-0">BOOKING ID</span>
                        <span class="font-bold text-slate-800">#{{ $booking->id }}</span>
                    </div>

                    <div class="flex items-center gap-4 px-5 py-4 border-b border-gray-100">
                        <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M3 3h12v13H3z"/>
                                <path d="M15 7h2a2 2 0 0 1 2 2v3a2 2 0 0 0 2 2"/>
                                <line x1="7" y1="16" x2="11" y2="16"/>
                                <line x1="9" y1="3" x2="9" y2="7"/>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-500 w-32 shrink-0">STATION</span>
                        <span class="font-bold text-slate-800">{{ $booking->station->name ?? 'N/A' }}</span>
                    </div>

                    <div class="flex items-center gap-4 px-5 py-4 border-b border-gray-100">
                        <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-500 w-32 shrink-0">ADDRESS</span>
                        <span class="font-bold text-slate-800">{{ $booking->station->address ?? 'N/A' }}</span>
                    </div>

                    <div class="flex items-center gap-4 px-5 py-4">
                        <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                                <line x1="1" y1="10" x2="23" y2="10"/>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-500 w-32 shrink-0">PAYMENT</span>
                        <span class="font-bold text-slate-800">
                            @if($paymentMethod === 'tng') TNG eWallet
                            @elseif($paymentMethod === 'fpx') FPX Online Banking
                            @elseif($paymentMethod === 'card') Credit / Debit Card
                            @else {{ $paymentMethod }}
                            @endif
                        </span>
                    </div>

                </div>

                <!-- TOTAL AMOUNT -->
                <div class="border border-green-200 rounded-2xl py-6 text-center bg-green-50 mb-7">
                    <p class="text-xs text-slate-500 uppercase tracking-widest mb-1">Amount Paid</p>
                    <p class="text-4xl font-bold text-green-500">RM {{ number_format($booking->amount_charged ?? 0, 2) }}</p>
                </div>

                <!-- BACK TO BOOKINGS BUTTON -->
                <a href="{{ url('/') }}"
                    class="w-full bg-green-500 hover:bg-green-600 active:bg-green-700 text-white text-xl font-bold py-5 rounded-2xl flex items-center justify-center gap-3 transition shadow-md">
                    Back to Home
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <!-- SECURE NOTE -->
                <div class="mt-5 flex items-center justify-center gap-2 text-xs text-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 4"/>
                    </svg>
                    Your payment information is secure and encrypted
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
