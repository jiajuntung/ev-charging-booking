<x-app-layout>
    <div class="min-h-screen bg-[#f3f3f3] flex items-center justify-center py-10 px-4">
        <div class="w-full max-w-2xl rounded-[36px] bg-white shadow-[0_18px_40px_rgba(0,0,0,0.10)] overflow-hidden border border-gray-100">

            <div class="h-4 bg-green-500"></div>

            <div class="px-8 py-10">

                <!-- TITLE -->
                <div class="text-center mb-8">
                    <h1 class="text-5xl font-black text-green-500 uppercase tracking-tight">
                        PAYMENT
                    </h1>
                    <p class="mt-2 text-base text-slate-500">
                        Please review your booking details
                    </p>
                    <div class="w-14 h-1 bg-green-500 mx-auto mt-4 rounded-full"></div>
                </div>

                <!-- BOOKING DETAILS -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden mb-5">

                    <!-- Booking ID -->
                    <div class="flex items-center gap-4 px-5 py-4 border-b border-gray-100">
                        <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-500 w-28 shrink-0">BOOKING ID</span>
                        <span class="font-bold text-slate-800">#{{ $booking->id }}</span>
                    </div>

                    <!-- Station -->
                    <div class="flex items-center gap-4 px-5 py-4 border-b border-gray-100">
                        <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M3 3h12v13H3z"/>
                                <path d="M15 7h2a2 2 0 0 1 2 2v3a2 2 0 0 0 2 2"/>
                                <line x1="7" y1="16" x2="11" y2="16"/>
                                <line x1="9" y1="3" x2="9" y2="7"/>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-500 w-28 shrink-0">STATION</span>
                        <span class="font-bold text-slate-800">{{ $booking->station->name ?? 'N/A' }}</span>
                    </div>

                    <!-- Address -->
                    <div class="flex items-center gap-4 px-5 py-4">
                        <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-500 w-28 shrink-0">ADDRESS</span>
                        <span class="font-bold text-slate-800">{{ $booking->station->address ?? 'N/A' }}</span>
                    </div>

                </div>

                <!-- TOTAL AMOUNT -->
                <div class="border border-green-200 rounded-2xl py-6 text-center bg-green-50 mb-6">
                    <p class="text-xs text-slate-500 uppercase tracking-widest mb-1">Total Amount</p>
                    <p class="text-4xl font-bold text-green-500">RM {{ number_format($booking->amount_charged ?? 0, 2) }}</p>
                </div>

                <!-- PAYMENT FORM -->
                <form method="POST" action="{{ route('payment.pay', $booking->id) }}">
                    @csrf

                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-3">Select Payment Method</p>

                    <div class="space-y-3" id="payment-options">

                        <!-- TNG eWallet -->
                        <label id="label-tng"
                            class="payment-label flex items-center justify-between rounded-2xl px-5 py-4 cursor-pointer transition-all duration-200
                                   border-2 border-green-500 bg-green-50 shadow-sm"
                            data-value="tng">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="payment_method" value="tng" checked
                                    class="accent-green-500 w-5 h-5 shrink-0 payment-radio">
                                <div class="w-12 h-12 flex items-center justify-center border rounded-xl overflow-hidden shrink-0 bg-white">
                                    <img src="{{ asset('images/tng.png') }}" alt="TNG eWallet" class="w-full h-full object-contain">
                                </div>
                                <div>
                                    <p class="method-title font-bold text-sm text-green-600">TNG eWallet</p>
                                    <p class="text-xs text-slate-500">Pay securely with your eWallet</p>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-green-600 border border-green-400 rounded-md px-2 py-1 shrink-0 ml-2">RECOMMENDED</span>
                        </label>

                        <!-- FPX Online Banking -->
                        <label id="label-fpx"
                            class="payment-label flex items-center justify-between rounded-2xl px-5 py-4 cursor-pointer transition-all duration-200
                                   border border-gray-200 bg-white"
                            data-value="fpx">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="payment_method" value="fpx"
                                    class="accent-green-500 w-5 h-5 shrink-0 payment-radio">
                                <div class="w-12 h-12 flex items-center justify-center border rounded-xl overflow-hidden shrink-0 bg-white">
                                    <img src="{{ asset('images/fpx.png') }}" alt="FPX" class="w-full h-full object-contain">
                                </div>
                                <div>
                                    <p class="method-title font-bold text-sm text-slate-800">FPX Online Banking</p>
                                    <p class="text-xs text-slate-500">Pay via your preferred bank</p>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="chevron w-5 h-5 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </label>

                        <!-- Credit / Debit Card -->
                        <label id="label-card"
                            class="payment-label flex items-center justify-between rounded-2xl px-5 py-4 cursor-pointer transition-all duration-200
                                   border border-gray-200 bg-white"
                            data-value="card">
                            <div class="flex items-center gap-4">
                                <input type="radio" name="payment_method" value="card"
                                    class="accent-green-500 w-5 h-5 shrink-0 payment-radio">
                                <div class="w-12 h-12 flex items-center justify-center border rounded-xl overflow-hidden shrink-0 bg-white">
                                    <img src="{{ asset('images/card.png') }}" alt="Card" class="w-full h-full object-contain">
                                </div>
                                <div>
                                    <p class="method-title font-bold text-sm text-slate-800">Credit / Debit Card</p>
                                    <p class="text-xs text-slate-500">Pay using Visa or Mastercard</p>
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="chevron w-5 h-5 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </label>

                    </div>

                    <!-- PAY NOW BUTTON -->
                    <button type="submit"
                        class="mt-7 w-full bg-red-500 hover:bg-red-600 active:bg-red-700 text-white text-xl font-bold py-5 rounded-2xl flex items-center justify-center gap-3 transition shadow-md">
                        PAY NOW
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                </form>

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

    <script>
        const radios = document.querySelectorAll('.payment-radio');
        const labels = document.querySelectorAll('.payment-label');

        function updateSelection(selectedValue) {
            labels.forEach(label => {
                const value = label.dataset.value;
                const title = label.querySelector('.method-title');
                const isSelected = value === selectedValue;

                if (isSelected) {
                    label.classList.remove('border', 'border-gray-200', 'bg-white');
                    label.classList.add('border-2', 'border-green-500', 'bg-green-50', 'shadow-sm');
                    if (title) {
                        title.classList.remove('text-slate-800');
                        title.classList.add('text-green-600');
                    }
                } else {
                    label.classList.remove('border-2', 'border-green-500', 'bg-green-50', 'shadow-sm');
                    label.classList.add('border', 'border-gray-200', 'bg-white');
                    if (title) {
                        title.classList.remove('text-green-600');
                        title.classList.add('text-slate-800');
                    }
                }
            });
        }

        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                updateSelection(radio.value);
            });
        });
    </script>
</x-app-layout>
