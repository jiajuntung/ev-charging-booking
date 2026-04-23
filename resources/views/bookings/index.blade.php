<x-app-layout>

    <div class="min-h-screen bg-[#efede6] py-10 px-4">
        <div class="max-w-7xl mx-auto">

            <!-- PAGE HEADER -->
            <div class="mb-8">
                <h1 class="text-3xl font-black text-[#664c35] tracking-tight">My Bookings</h1>
                <p class="text-sm text-[#89a57b] mt-1 font-medium">Track and manage all your charging sessions</p>
            </div>

            <!-- ALERTS -->
            @if(session('error'))
                <div class="mb-5 flex items-center gap-3 bg-red-50 border-l-4 border-red-400 text-red-700 p-4 rounded-2xl shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="mb-5 flex items-center gap-3 bg-[#eaf3e6] border-l-4 border-[#89a57b] text-[#4a7a3d] p-4 rounded-2xl shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- BOOKINGS CARD -->
            <div class="bg-white rounded-3xl shadow-md border border-[#e8e2d9] overflow-hidden">

                <!-- TABLE HEADER -->
                <div class="grid grid-cols-6 bg-[#89a57b] px-6 py-4 text-white text-xs font-bold uppercase tracking-widest">
                    <div class="col-span-2">Station</div>
                    <div>Booking Time</div>
                    <div>Status</div>
                    <div>kWh / Amount</div>
                    <div>Action</div>
                </div>

                <!-- ROWS -->
                @forelse(auth()->user()->bookings()->with('station')->latest('booking_time')->get() as $booking)
                    <div x-data="{ showCancelModal: false }" class="grid grid-cols-6 items-center px-6 py-5 border-b border-[#f0ece5] hover:bg-[#faf8f5] transition-colors">

                        <!-- Station -->
                        <div class="col-span-2">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-[#eaf3e6] flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M3 3h12v13H3z"/>
                                        <path d="M15 7h2a2 2 0 0 1 2 2v3a2 2 0 0 0 2 2"/>
                                        <line x1="7" y1="16" x2="11" y2="16"/>
                                        <line x1="9" y1="3" x2="9" y2="7"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-[#664c35] text-sm">{{ $booking->station->name ?? 'N/A' }}</p>
                                    <p class="text-xs text-gray-400">{{ $booking->station->address ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Time -->
                        <div class="text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($booking->booking_time)->format('d M Y') }}<br>
                            <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</span>
                        </div>

                        <!-- Status -->
                        <div>
                            @if($booking->status == 'completed')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400 inline-block"></span> Completed
                                </span>
                            @elseif($booking->status == 'charging')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-[#eaf3e6] text-[#4a7a3d]">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#89a57b] animate-ping inline-block"></span> Charging
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 inline-block"></span> Confirmed
                                </span>
                            @endif
                        </div>

                        <!-- kWh / Amount -->
                        <div>
                            @if($booking->status == 'completed' && $booking->kwh_charged)
                                <p class="text-sm font-bold text-[#89a57b]">{{ number_format($booking->kwh_charged, 3) }} kWh</p>
                                <p class="text-xs text-gray-500">RM {{ number_format($booking->amount_charged ?? 0, 2) }}</p>
                            @else
                                <span class="text-gray-300 text-sm">—</span>
                            @endif
                        </div>

                        <!-- Action -->
                        <div class="flex items-center gap-2">
                            @if($booking->status == 'confirmed')
                                <form action="{{ route('bookings.start', $booking) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-[#89a57b] hover:bg-[#7a9470] text-white px-4 py-2 rounded-xl text-xs font-bold transition shadow-sm">
                                        Start Charging
                                    </button>
                                </form>
                                <form id="cancel-form-{{ $booking->id }}" action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" @click="showCancelModal = true"
                                    class="bg-red-100 hover:bg-red-200 text-red-600 px-4 py-2 rounded-xl text-xs font-bold transition">
                                    Cancel
                                </button>

                                <!-- Cancel Booking Modal -->
                                <div x-show="showCancelModal"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0"
                                     x-transition:enter-end="opacity-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100"
                                     x-transition:leave-end="opacity-0"
                                     class="fixed inset-0 z-50 flex items-center justify-center px-4"
                                     style="display:none;">
                                    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="showCancelModal = false"></div>
                                    <div x-show="showCancelModal"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 scale-95"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-150"
                                         x-transition:leave-start="opacity-100 scale-100"
                                         x-transition:leave-end="opacity-0 scale-95"
                                         class="relative bg-white rounded-3xl shadow-2xl border border-[#e8e2d9] w-full max-w-sm overflow-hidden z-10">
                                        <div class="h-2 bg-[#89a57b]"></div>
                                        <div class="px-8 py-8">
                                            <div class="flex justify-center mb-5">
                                                <div class="w-16 h-16 rounded-full bg-[#eaf3e6] flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <h2 class="text-xl font-black text-[#664c35] text-center">Cancel Booking?</h2>
                                            <p class="text-sm text-gray-400 text-center mt-2">This will permanently cancel your booking at <span class="font-semibold text-[#664c35]">{{ $booking->station->name ?? '' }}</span>.</p>
                                            <div class="flex gap-3 mt-7">
                                                <button @click="showCancelModal = false"
                                                    class="flex-1 border border-[#e8e2d9] text-gray-600 hover:bg-[#faf8f5] font-bold py-3 rounded-xl transition text-sm">
                                                    Keep Booking
                                                </button>
                                                <button type="button" @click="document.getElementById('cancel-form-{{ $booking->id }}').submit()"
                                                    class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-xl transition shadow-sm text-sm">
                                                    Yes, Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @elseif($booking->status == 'charging')
                                <a href="{{ route('bookings.status', $booking) }}"
                                    class="bg-[#89a57b] hover:bg-[#7a9470] text-white px-4 py-2 rounded-xl text-xs font-bold transition shadow-sm flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-white animate-ping"></span> Live View
                                </a>

                            @else
                                <span class="text-xs text-gray-400 italic">Session Ended</span>
                            @endif
                        </div>

                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-20 text-center">
                        <div class="w-16 h-16 rounded-full bg-[#eaf3e6] flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                        </div>
                        <p class="text-[#664c35] font-bold text-lg">No bookings yet</p>
                        <p class="text-gray-400 text-sm mt-1">Find a charger and make your first booking</p>
                        <a href="{{ route('stations.index') }}"
                            class="mt-5 bg-[#89a57b] hover:bg-[#7a9470] text-white px-6 py-2.5 rounded-xl text-sm font-bold transition shadow-sm">
                            Find Chargers
                        </a>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

</x-app-layout>
