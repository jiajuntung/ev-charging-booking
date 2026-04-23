<x-app-layout>

    <div class="min-h-screen bg-[#efede6] py-10 px-4">
        <div class="max-w-7xl mx-auto">

            <!-- PAGE HEADER -->
            <div class="mb-8">
                <h1 class="text-3xl font-black text-[#664c35] tracking-tight">Find Chargers</h1>
                <p class="text-sm text-[#89a57b] mt-1 font-medium">Browse available EV charging stations near you</p>
            </div>

            <!-- ALERTS -->
            @if(session('success'))
                <div class="mb-5 flex items-center gap-3 bg-[#eaf3e6] border-l-4 border-[#89a57b] text-[#4a7a3d] p-4 rounded-2xl shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- SEARCH BAR -->
            <form method="GET" action="{{ route('stations.index') }}" class="mb-6">
                <div class="bg-white rounded-2xl border border-[#e8e2d9] shadow-sm p-4 flex flex-col sm:flex-row gap-3 items-stretch sm:items-center">

                    <!-- Location search -->
                    <div class="flex items-center gap-2 flex-1 bg-[#faf8f5] rounded-xl px-4 py-2.5 border border-[#e8e2d9]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#89a57b] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search by station name or location..."
                            class="flex-1 bg-transparent text-sm text-gray-700 placeholder-gray-400 focus:outline-none"
                            style="border:none;outline:none;box-shadow:none;">
                    </div>

                    <!-- Time slot search -->
                    <div class="flex items-center gap-2 bg-[#faf8f5] rounded-xl px-4 py-2.5 border border-[#e8e2d9] sm:w-64">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#89a57b] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                        <input type="datetime-local" name="time" value="{{ request('time') }}"
                            class="flex-1 bg-transparent text-sm text-gray-700 focus:outline-none"
                            style="border:none;outline:none;box-shadow:none;">
                    </div>

                    <!-- Search button -->
                    <button type="submit"
                        class="bg-[#89a57b] hover:bg-[#7a9470] text-white font-bold px-6 py-2.5 rounded-xl text-sm transition shadow-sm shrink-0">
                        Search
                    </button>

                    @if(request('search') || request('time'))
                        <a href="{{ route('stations.index') }}"
                            class="text-sm text-gray-400 hover:text-[#664c35] font-medium px-2 py-2.5 transition shrink-0">
                            Clear
                        </a>
                    @endif
                </div>

                <!-- Active filter tags -->
                @if(request('search') || request('time'))
                    <div class="flex flex-wrap gap-2 mt-3">
                        @if(request('search'))
                            <span class="inline-flex items-center gap-1.5 bg-[#eaf3e6] text-[#4a7a3d] text-xs font-bold px-3 py-1.5 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                "{{ request('search') }}"
                            </span>
                        @endif
                        @if(request('time'))
                            <span class="inline-flex items-center gap-1.5 bg-[#eaf3e6] text-[#4a7a3d] text-xs font-bold px-3 py-1.5 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                Available at {{ \Carbon\Carbon::parse(request('time'))->format('d M Y, h:i A') }}
                            </span>
                        @endif
                        <span class="text-xs text-gray-400 self-center">— {{ $stations->count() }} station(s) found</span>
                    </div>
                @endif
            </form>

            <!-- STATIONS GRID -->
            <div class="bg-white rounded-3xl shadow-md border border-[#e8e2d9] overflow-hidden">

                <!-- CARD HEADER BAR -->
                <div class="bg-[#89a57b] px-6 py-4 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M3 3h12v13H3z"/>
                            <path d="M15 7h2a2 2 0 0 1 2 2v3a2 2 0 0 0 2 2"/>
                            <line x1="7" y1="16" x2="11" y2="16"/>
                            <line x1="9" y1="3" x2="9" y2="7"/>
                        </svg>
                    </div>
                    <span class="text-white text-xs font-bold uppercase tracking-widest">EV Charging Stations</span>
                </div>

                <!-- GRID -->
                <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-5">
                    @forelse($stations as $station)
                        <div class="flex bg-white rounded-2xl border {{ $station->is_available ? 'border-[#e8e2d9] hover:shadow-md hover:border-[#89a57b]' : 'border-gray-200 opacity-60' }} overflow-hidden transition-all duration-200 h-44">

                            <!-- Station Image -->
                            <div class="w-1/3 bg-[#e8e2d9] shrink-0">
                                <img src="{{ $station->image ? asset('storage/' . $station->image) : 'https://images.unsplash.com/photo-1593941707882-a5bba14938c7?w=400' }}"
                                    class="w-full h-full object-cover" alt="Station">
                            </div>

                            <!-- Station Info -->
                            <div class="p-5 flex flex-col justify-between w-full">
                                <div>
                                    <h3 class="text-base font-bold text-[#664c35] line-clamp-1">{{ $station->name }}</h3>
                                    <div class="flex items-start gap-1.5 mt-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#89a57b] mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/>
                                            <circle cx="12" cy="10" r="3"/>
                                        </svg>
                                        <p class="text-xs text-gray-500 line-clamp-2">{{ $station->address }}</p>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-2">
                                        @if($station->is_available)
                                            @php $avail = $station->availableSlots(); @endphp
                                            <span class="text-xs font-bold px-3 py-1 rounded-full {{ $avail > 0 ? 'bg-[#eaf3e6] text-[#89a57b]' : 'bg-red-50 text-red-400' }}">
                                                {{ $avail }}/{{ $station->total_charging_points }} Available
                                            </span>
                                        @else
                                            <span class="bg-red-50 text-red-400 text-xs font-bold px-2 py-1 rounded-full">Unavailable</span>
                                        @endif
                                    </div>
                                    @if($station->is_available)
                                        <a href="{{ route('stations.showBook', $station->id) }}"
                                            class="bg-[#89a57b] hover:bg-[#7a9470] text-white text-xs font-bold px-4 py-2 rounded-xl transition shadow-sm">
                                            View & Book
                                        </a>
                                    @else
                                        <span class="bg-gray-100 text-gray-400 text-xs font-bold px-4 py-2 rounded-xl cursor-not-allowed">
                                            Unavailable
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    @empty
                        <div class="col-span-full flex flex-col items-center justify-center py-20 text-center">
                            <div class="w-16 h-16 rounded-full bg-[#eaf3e6] flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path d="M3 3h12v13H3z"/>
                                    <path d="M15 7h2a2 2 0 0 1 2 2v3a2 2 0 0 0 2 2"/>
                                </svg>
                            </div>
                            <p class="text-[#664c35] font-bold text-lg">No stations found</p>
                            <p class="text-gray-400 text-sm mt-1">
                                @if(request('search') || request('time'))
                                    Try adjusting your search or clear the filters
                                @else
                                    Check back later for available charging stations
                                @endif
                            </p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
