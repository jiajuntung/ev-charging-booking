<x-app-layout>
    <div class="py-12 bg-[#f8f9fa] min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                
                <div class="h-64 w-full bg-gray-200 relative">
                    <img src="{{ $station->image ? asset('storage/' . $station->image) : 'https://images.unsplash.com/photo-1593941707882-a5bba14938c7?q=80&w=800' }}" 
                         class="w-full h-full object-cover">
                    <div class="absolute bottom-4 left-6">
                         <span class="bg-white/90 backdrop-blur px-4 py-1 rounded-full text-[#5e8156] font-bold text-sm shadow-sm">
                            Slots Available: {{ $station->total_charging_points }}
                         </span>
                    </div>
                </div>

                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-3xl font-black text-gray-800 tracking-tight">{{ $station->name }}</h1>
                            <p class="text-gray-500 mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-location-dot text-[#89a57b]"></i> {{ $station->address }}
                            </p>
                        </div>
                        
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($station->address) }}" 
                           target="_blank"
                           class="flex items-center text-center gap-2 bg-white border-2 border-[#89a57b] text-[#89a57b] px-6 py-2 rounded-3xl font-bold hover:bg-[#89a57b] hover:text-white transition">
                            <i class="fa-solid fa-paper-plane"></i> NAGIVATIONS
                        </a>
                    </div>

                    <div class="mb-8">
                        <h3 class="font-bold text-gray-800 mb-2">Description :</h3>
                        <p class="text-gray-600 leading-relaxed">
                            This charging station provides up to 250Kwh high-speed DC charging compatible with most EVs. Located in a convenient area with shopping malls to enjoy while you wait.
                        </p>
                    </div>

                    <div class="bg-[#f0f4ee] p-6 rounded-3xl border border-[#dfeada]">
                        <h3 class="font-bold text-[#5e8156] mb-4 text-lg">Schedule Your Session</h3>
                        
                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="station_id" value="{{ $station->id }}">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Select Date & Time</label>
                                    <input type="datetime-local" name="booking_time" 
                                           class="w-full border-gray-200 rounded-xl shadow-sm focus:ring-[#89a57b] focus:border-[#89a57b]" 
                                           required>
                                </div>
                            </div>

                            <button type="submit" 
                                    class="w-full bg-[#89a57b] hover:bg-[#72996a] text-white font-black py-4 rounded-2xl transition shadow-lg text-sm uppercase tracking-wider">
                                Booking Now
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>