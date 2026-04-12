<x-app-layout>
    <x-slot name="header">
        @if(session('success'))
            <div class="-mt-6 -mx-4 sm:-mx-6 lg:-mx-8 mb-6 bg-[#dfeada] p-4 shadow-sm animate-pulse">
                <div class="flex justify-between items-center">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <head>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        </head>

        <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
            <i class="fa-solid fa-charging-station text-black"></i>
            EV Charging Stations
        </h2>
    </x-slot>


    <div class="bg-[#e3e1d3] py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">



            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @forelse($stations as $station)
                    <div
                        class="flex bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition h-48">

                        <div class="w-1/3 bg-gray-200 shrink-0">
                            <img src="{{ $station->image ? asset('storage/' . $station->image) : 'https://images.unsplash.com/photo-1593941707882-a5bba14938c7?w=400' }}"
                                class="w-full h-full object-cover" alt="Station">
                        </div>

                        <div class="p-5 flex flex-col justify-between w-full">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800 line-clamp-1">{{ $station->name }}</h3>
                                <p class="text-sm text-gray-500 mt-1 line-clamp-2">Location : {{ $station->address }}</p>
                            </div>

                            <div class="flex justify-between items-end mt-4">
                                <span
                                    class="bg-[#e9eedf] text-[#5e8156] text-xs font-bold px-3 py-1 rounded-full whitespace-nowrap h-fit">
                                    Slots: {{ $station->total_charging_points }}
                                </span>

                                <a href="{{ route('stations.showBook', $station->id) }}"
                                    class="w-auto px-4 bg-[#89a57b] hover:bg-[#72996a] text-white text-center font-bold py-2 rounded-3xl transition text-sm shadow-sm">
                                    View Details & Book
                                </a>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full p-8 text-center text-gray-500 bg-white rounded-xl border">
                        No stations found. Add one above!
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>