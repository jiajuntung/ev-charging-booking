<x-app-layout>
    @php
        $activeBooking = auth()->user()->bookings()->where('status', 'charging')->first();
    @endphp

    {{-- 1. Booking Alert Section --}}
    @if($activeBooking)
        <div class="bg-[#dfeada] p-4 shadow-sm animate-pulse">
            <div class="flex justify-between items-center">
                <p class="text-[#707a51] font-bold">
                    ⚠️ You have an active charging session!
                </p>
                <a href="{{ route('bookings.status', $activeBooking) }}"
                    class="bg-[#89a57b] text-white px-4 py-2 rounded-full text-sm font-bold">
                    Go to Status >
                </a>
            </div>
        </div>
    @endif

    {{-- 2. Dashboard Summary Section --}}

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>

    <div class="relative w-full h-[380px] bg-white overflow-hidden border-b border-gray-100">

        <div class="absolute inset-0 z-0 opacity-[0.1] mix-blend-multiply">
            <img src="{{ asset('images/charging-bg.png') }}" class="w-full h-full object-cover"
                alt="Background Texture">
        </div>

        <div
            class="absolute -left-20 top-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-[#89a57b]/10 rounded-full blur-3xl">
        </div>
        <div class="absolute right-0 top-0 w-80 h-80 bg-[#89a57b]/5 rounded-full blur-3xl"></div>

        <img src="{{ asset('images/car.png') }}"
            class="absolute left-64 top-1/2 -translate-y-1/2 w-1/2 h-auto object-contain z-10 drop-shadow-[0_20px_30px_rgba(0,0,0,0.1)]"
            alt="EV Charging">

        <div class="absolute inset-0 bg-gradient-to-r "></div>

        <div class="absolute left-7 top-[19%] -translate-y-1/2 text-left z-20">
            <h1 class="text-3xl font-black text-gray-800 tracking-tighter">
                Welcome back,<br />
                {{ auth()->user()->name }}!
            </h1>
            <p class="text-gray-400 mt-2 font-medium">Your EV is ready for the next journey.</p>
        </div>

        <div class="max-w-7xl mx-auto relative h-full w-full">
            <div
                class="absolute right-4 lg:right-8 top-1/2 -translate-y-1/2 bg-white/95 backdrop-blur-sm p-6 rounded-2xl shadow-xl border border-gray-100 z-30 w-auto max-w-xl">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-gray-800 text-xl">My Charging Summary</h3>
                    <span class="text-xs bg-gray-100 border px-3 py-1 rounded-full text-gray-600">This Month</span>
                </div>

                <div class="flex flex-row gap-4">
                    <div
                        class="flex-1 border border-gray-100 rounded-3xl p-4 bg-white shadow-sm flex items-center gap-4">
                        <div
                            class="bg-[#89a57b] text-white w-12 h-12 flex items-center justify-center rounded-full shadow-sm shrink-0">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-500 font-bold uppercase">Total Charged (kWh)</p>
                            <p class="text-xl font-black text-[#89a57b]">{{ number_format($totalKwh, 1) }} <span
                                    class="text-sm text-gray-600">kWh</span></p>
                        </div>
                    </div>

                    <div
                        class="flex-1 border border-gray-100 rounded-3xl p-4 bg-white shadow-sm flex items-center gap-4">
                        <div
                            class="bg-[#89a57b] text-white w-12 h-12 flex items-center justify-center rounded-full shadow-sm shrink-0">
                            <i class="fa-solid fa-money-bill"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-500 font-bold uppercase">Total Charge Cost</p>
                            <p class="text-xl font-black text-[#89a57b]">RM {{ number_format($totalCost, 2) }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- 3. Popular Locations Section --}}
    <div class="bg-[#efede6] w-full py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-12">
            <h2 class="text-2xl font-black text-[#664c35] mb-6">Popular Charging Locations in Selangor</h2>

            <div class="flex overflow-x-auto gap-10 pb-4 snap-x no-scrollbar">
                <style>
                    .no-scrollbar::-webkit-scrollbar {
                        display: none;
                    }

                    .no-scrollbar {
                        -ms-overflow-style: none;
                        scrollbar-width: none;
                    }
                </style>

                @foreach($popularStations as $station)
                    <div
                        class="flex-none w-[320px] bg-white rounded-3xl border border-gray-100 shadow-md overflow-hidden snap-start">

                        <div class="h-36 bg-gray-200 relative bg-cover bg-center"
                            style="background-image: url('https://images.unsplash.com/photo-1593941707882-a5bba14938c7?q=80&w=400');">
                            <span
                                class="absolute top-3 left-3 bg-[#e9eedf] text-[#5e8156] text-xs font-bold px-2 py-1 rounded-full shadow-sm">
                                Available Slots: {{ $station->total_charging_points }}
                            </span>
                        </div>

                        <div class="p-4 flex flex-col justify-between h-36">
                            <h4 class="font-bold text-gray-800 text-sm line-clamp-2">
                                {{ $station->name }} - {{ $station->address }}
                            </h4>

                            <form action="{{ route('bookings.store') }}" method="POST" class="mt-2">
                                @csrf
                                <input type="hidden" name="station_id" value="{{ $station->id }}">
                                <input type="hidden" name="booking_time"
                                    value="{{ now()->addHour()->format('Y-m-d\TH:i') }}">
                                <a href="{{ route('stations.showBook', $station->id) }}"
                                    class="w-full px-4 bg-[#89a57b] hover:bg-[#72996a] text-white font-bold py-2.5 rounded-3xl transition text-sm shadow-sm">
                                    BOOK NOW
                                </a>
                            </form>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>