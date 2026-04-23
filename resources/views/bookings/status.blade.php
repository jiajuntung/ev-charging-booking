<x-app-layout>
    <div class="min-h-screen bg-[#f3f3f3] flex items-center justify-center py-10 px-4">
        <div class="w-full max-w-2xl rounded-[36px] bg-white shadow-[0_18px_40px_rgba(0,0,0,0.10)] overflow-hidden border border-gray-100">

            <div class="h-4 bg-green-500"></div>

            <div class="px-8 py-10">

                <!-- TITLE -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center gap-2 mb-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-green-500 animate-ping inline-block"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-green-500 absolute"></span>
                    </div>
                    <h1 class="text-4xl font-black text-green-500 uppercase tracking-tight">Live Charging</h1>
                    <p class="mt-2 text-base text-slate-500">Station: {{ $booking->station->name }}</p>
                    <div class="w-14 h-1 bg-green-500 mx-auto mt-4 rounded-full"></div>
                </div>

                <!-- KWH GAUGE -->
                <div class="flex justify-center mb-8">
                    <div class="relative w-52 h-52">
                        <!-- Outer ring -->
                        <svg class="absolute inset-0 w-full h-full -rotate-90" viewBox="0 0 200 200">
                            <circle cx="100" cy="100" r="88" fill="none" stroke="#e5e7eb" stroke-width="10"/>
                            <circle id="progress-ring" cx="100" cy="100" r="88" fill="none"
                                stroke="#22c55e" stroke-width="10"
                                stroke-dasharray="553"
                                stroke-dashoffset="553"
                                stroke-linecap="round"
                                style="transition: stroke-dashoffset 0.8s ease"/>
                        </svg>
                        <!-- Inner circle -->
                        <div class="absolute inset-4 rounded-full bg-green-50 border-2 border-green-100 flex flex-col items-center justify-center shadow-inner">
                            <span id="kwh-display" class="text-4xl font-mono font-bold text-slate-800">0.000</span>
                            <span class="text-xs font-bold text-green-500 uppercase tracking-widest mt-1">kWh</span>
                        </div>
                    </div>
                </div>

                <!-- STATS ROW -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <!-- Estimated Cost -->
                    <div class="border border-green-200 rounded-2xl py-5 text-center bg-green-50">
                        <p class="text-xs text-slate-500 uppercase tracking-widest mb-1">Estimated Cost</p>
                        <p class="text-2xl font-bold text-green-600">RM <span id="cost-display">0.00</span></p>
                    </div>
                    <!-- Duration -->
                    <div class="border border-gray-200 rounded-2xl py-5 text-center bg-gray-50">
                        <p class="text-xs text-slate-500 uppercase tracking-widest mb-1">Duration</p>
                        <p class="text-2xl font-bold text-slate-700"><span id="duration-display">0:00</span></p>
                    </div>
                </div>

                <!-- STOP FORM -->
                <div x-data="{ showStopModal: false }">
                    <form id="stop-form" action="{{ route('bookings.stop', $booking) }}" method="POST">
                        @csrf
                        <input type="hidden" name="kwh_charged" id="kwh-input" value="0">
                        <input type="hidden" name="amount_charged" id="amount-input" value="0">
                    </form>

                    <button type="button" @click="showStopModal = true"
                        class="w-full bg-red-500 hover:bg-red-600 active:bg-red-700 text-white text-xl font-bold py-5 rounded-2xl flex items-center justify-center gap-3 transition shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <rect x="6" y="6" width="12" height="12" rx="2"/>
                        </svg>
                        STOP CHARGING
                    </button>

                    <!-- Stop Charging Modal -->
                    <div x-show="showStopModal"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="fixed inset-0 z-50 flex items-center justify-center px-4"
                         style="display:none;">
                        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="showStopModal = false"></div>
                        <div x-show="showStopModal"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="relative bg-white rounded-3xl shadow-2xl border border-[#e8e2d9] w-full max-w-sm overflow-hidden z-10">
                            <div class="h-2 bg-red-500"></div>
                            <div class="px-8 py-8">
                                <div class="flex justify-center mb-5">
                                    <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <rect x="6" y="6" width="12" height="12" rx="2"/>
                                        </svg>
                                    </div>
                                </div>
                                <h2 class="text-xl font-black text-[#664c35] text-center">Stop Charging?</h2>
                                <p class="text-sm text-gray-400 text-center mt-2">Your kWh usage and cost will be recorded and you'll be directed to payment.</p>
                                <div class="flex gap-3 mt-7">
                                    <button @click="showStopModal = false"
                                        class="flex-1 border border-[#e8e2d9] text-gray-600 hover:bg-[#faf8f5] font-bold py-3 rounded-xl transition text-sm">
                                        Continue Charging
                                    </button>
                                    <button type="button" @click="document.getElementById('stop-form').submit()"
                                        class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-xl transition shadow-sm text-sm">
                                        Yes, Stop
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECURE NOTE -->
                <div class="mt-5 flex items-center justify-center gap-2 text-xs text-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 4"/>
                    </svg>
                    Session is active and being tracked
                </div>

            </div>
        </div>
    </div>

    <script>
        const RATE_PER_KWH = 10; // RM 10 per kWh
        const KWH_PER_SECOND = 0.05;
        const MAX_KWH = 100;
        const RING_CIRCUMFERENCE = 553;

        let kwh = 0;
        let seconds = 0;

        const kwhDisplay = document.getElementById('kwh-display');
        const costDisplay = document.getElementById('cost-display');
        const durationDisplay = document.getElementById('duration-display');
        const progressRing = document.getElementById('progress-ring');
        const kwhInput = document.getElementById('kwh-input');
        const amountInput = document.getElementById('amount-input');

        setInterval(() => {
            kwh += KWH_PER_SECOND;
            seconds++;

            const cost = kwh * RATE_PER_KWH;
            const mins = Math.floor(seconds / 60);
            const secs = seconds % 60;

            kwhDisplay.textContent = kwh.toFixed(3);
            costDisplay.textContent = cost.toFixed(2);
            durationDisplay.textContent = `${mins}:${String(secs).padStart(2, '0')}`;

            // Update ring progress (cap at MAX_KWH)
            const progress = Math.min(kwh / MAX_KWH, 1);
            progressRing.style.strokeDashoffset = RING_CIRCUMFERENCE * (1 - progress);

            // Keep hidden inputs in sync
            kwhInput.value = kwh.toFixed(3);
            amountInput.value = cost.toFixed(2);
        }, 1000);

    </script>
</x-app-layout>
