<x-app-layout>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Top Banner --}}
    <div x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="bg-[#dfeada] px-4 py-3">
        <div class="px-[10%] flex items-center justify-between">
            @auth
            <p class="text-[#4a7a3d] text-sm font-semibold">
                👋 Welcome back, {{ auth()->user()->name }}!
            </p>
            <div class="flex items-center gap-3">
                <a href="{{ route('bookings.index') }}" class="text-xs bg-[#89a57b] text-white font-bold px-4 py-1.5 rounded-full hover:bg-[#7a9470] transition">
                    My Bookings
                </a>
                <button @click="show = false" class="text-[#4a7a3d] hover:text-[#3a6a2d] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            @else
            <p class="text-[#4a7a3d] text-sm font-semibold">
                👋 Sign in to start booking your EV charging session!
            </p>
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="text-xs bg-[#89a57b] text-white font-bold px-4 py-1.5 rounded-full hover:bg-[#7a9470] transition">
                    Sign In
                </a>
                <button @click="show = false" class="text-[#4a7a3d] hover:text-[#3a6a2d] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            @endauth
        </div>
    </div>

    {{-- HERO SECTION --}}
    <div class="relative w-full overflow-hidden" style="height: 620px;">

        {{-- Full background photo --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/charging-bg-2.png') }}" class="w-full h-full object-cover" alt="">
            {{-- Gradient overlay: strong on left for text legibility, fades out right --}}
            <div class="absolute inset-0 bg-gradient-to-r from-white/90 via-white/50 to-white/10"></div>
        </div>

        {{-- Left headline --}}
        <div class="absolute left-[10%] top-1/2 -translate-y-1/2 z-20 max-w-2xl">
            <p class="text-base font-extrabold text-[#3a7a35] uppercase tracking-[0.18em] mb-4">Smart EV Platform</p>
            <h1 class="text-6xl font-black text-gray-900 leading-tight tracking-tight">
                Smart EV<br>Charging Solutions
            </h1>
            {{-- Green underline accent --}}
            <div class="w-24 h-2 bg-[#3a7a35] rounded-full mt-6 mb-6"></div>
            <p class="text-gray-500 font-medium text-lg">Join thousands of drivers today.</p>
            <div class="mt-8">
                <a href="{{ route('stations.index') }}"
                    class="inline-flex items-center gap-2 bg-[#3a7a35] hover:bg-[#2d6229] text-white text-lg font-bold px-10 py-5 rounded-xl transition shadow-md">
                    Find Chargers
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Summary card — right --}}
        <div class="absolute right-[10%] top-1/2 -translate-y-1/2 z-20 w-[520px]">
            <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl border border-[#e8e2d9] px-8 py-10">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-black text-gray-800 text-2xl">My Charging Summary</h3>
                    <span class="text-sm bg-[#eaf3e6] text-[#3a7a35] font-bold px-4 py-1.5 rounded-full">{{ \Carbon\Carbon::now()->format('F Y') }}</span>
                </div>

                <div class="flex flex-row gap-3 {{ !auth()->check() ? 'opacity-40 select-none pointer-events-none' : '' }}">
                    <div class="flex-1 border border-[#e8e2d9] rounded-2xl p-4 bg-[#faf8f5] flex items-center gap-3">
                        <div class="bg-[#3a7a35] text-white w-14 h-14 flex items-center justify-center rounded-full shrink-0">
                            <i class="fa-solid fa-bolt text-sm"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wide whitespace-nowrap">Total Charged</p>
                            <p class="text-2xl font-black text-gray-800 whitespace-nowrap">
                                @auth{{ number_format($monthlyKwh, 2) }}@else--@endauth
                                <span class="text-xs text-[#3a7a35] font-bold">kWh</span>
                            </p>
                        </div>
                    </div>
                    <div class="flex-1 border border-[#e8e2d9] rounded-2xl p-4 bg-[#faf8f5] flex items-center gap-3">
                        <div class="bg-[#3a7a35] text-white w-14 h-14 flex items-center justify-center rounded-full shrink-0">
                            <i class="fa-solid fa-money-bill text-sm"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wide whitespace-nowrap">Total Cost</p>
                            <p class="text-2xl font-black text-gray-800 whitespace-nowrap">
                                RM <span class="text-[#3a7a35]">@auth{{ number_format($monthlyCost, 2) }}@else--@endauth</span>
                            </p>
                        </div>
                    </div>
                </div>

                @guest
                <a href="{{ route('login') }}" class="block text-center text-sm text-[#3a7a35] hover:text-[#2d6229] mt-4 font-bold transition">Sign in to view your summary</a>
                @endguest
            </div>
        </div>

    </div>

    {{-- POPULAR LOCATIONS --}}
    <div class="bg-[#efede6] w-full py-12 px-4">
        <div class="max-w-7xl mx-auto">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-black text-[#664c35]">Popular Charging Locations</h2>
                    <p class="text-sm text-[#89a57b] font-medium mt-0.5">Trusted stations across Malaysia</p>
                </div>
                <a href="{{ route('stations.index') }}"
                    class="text-xs font-bold text-[#89a57b] border border-[#89a57b] px-4 py-2 rounded-xl hover:bg-[#89a57b] hover:text-white transition">
                    View All →
                </a>
            </div>

            <div class="flex overflow-x-auto gap-5 pb-4 no-scrollbar">
                <style>
                    .no-scrollbar::-webkit-scrollbar { display: none; }
                    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
                </style>

                @foreach($popularStations as $station)
                    <div class="flex-none w-[300px] bg-white rounded-3xl border border-[#e8e2d9] shadow-sm overflow-hidden hover:shadow-md hover:border-[#89a57b] transition-all duration-200">
                        <div class="h-36 bg-[#e8e2d9] overflow-hidden">
                            <img src="{{ $station->image ? asset('storage/' . $station->image) : 'https://images.unsplash.com/photo-1593941707882-a5bba14938c7?q=80&w=400' }}"
                                class="w-full h-full object-cover" alt="{{ $station->name }}">
                        </div>
                        <div class="p-4 flex flex-col gap-3">
                            <div>
                                <h4 class="font-bold text-[#664c35] text-sm line-clamp-1">{{ $station->name }}</h4>
                                <div class="flex items-start gap-1 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-[#89a57b] mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                                    </svg>
                                    <p class="text-xs text-gray-400 line-clamp-1">{{ $station->address }}</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="bg-[#eaf3e6] text-[#89a57b] text-xs font-bold px-3 py-1 rounded-full">
                                    {{ $station->total_charging_points }} Slots
                                </span>
                                @auth
                                <a href="{{ route('stations.showBook', $station->id) }}"
                                    class="bg-[#89a57b] hover:bg-[#7a9470] text-white text-xs font-bold px-4 py-2 rounded-xl transition shadow-sm">
                                    Book Now
                                </a>
                                @else
                                <a href="{{ route('login') }}"
                                    class="bg-[#89a57b] hover:bg-[#7a9470] text-white text-xs font-bold px-4 py-2 rounded-xl transition shadow-sm">
                                    Book Now
                                </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

</x-app-layout>
