<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-x1 text-gray-800 leading-tight">My Bookings</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 shadow-sm">
                    <div class="flex items-center">
                        <i class="fa-solid fa-circle-exclamation mr-2"></i>
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            @if(session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-sm">
                    <div class="flex items-center">
                        <i class="fa-solid fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-blue-50 border-b">
                        <tr>
                            <th class="p-4 font-bold">Stations</th>
                            <th class="p-4 font-bold">Time</th>
                            <th class="p-4 font-bold">Status</th>
                            <th class="p-4 font-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(auth()->user()->bookings as $booking)
                                <tr class="border-b">
                                    <td class="p-4 text-sm">{{ $booking->station->name }}</td>

                                    <td class="p-4 text-sm">{{ $booking->booking_time }}</td>

                                    <td class="p-4">
                                        <span
                                            class="px-2 py-1 rounded text-xs font-bold 
                            {{ $booking->status == 'completed' ? 'bg-gray-100 text-gray-500' : '' }}
                            {{ $booking->status == 'charging' ? 'bg-green-100 text-green-700' : '' }}
                            {{ ($booking->status != 'completed' && $booking->status != 'charging') ? 'bg-blue-100 text-blue-700' : '' }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>

                                    <td class="p-4">
                                        <div class="flex items-center gap-2">
                                            @if($booking->status == 'confirmed')
                                                <form action="{{ route('bookings.start', $booking) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition shadow-sm">
                                                        Start Charging
                                                    </button>
                                                </form>

                                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition shadow-sm">
                                                        Cancel
                                                    </button>
                                                </form>

                                            @elseif($booking->status == 'charging')
                                                <a href="{{ route('bookings.status', $booking) }}" class="bg-green-500 text-white px-3 py-1 rounded text-sm inline-block hover:bg-green-600 shadow-sm">
                                                    View Status ⚡
                                                </a>

                                            @else
                                                <span class="text-gray-400 text-xs italic">Session Ended</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-400">No bookings yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>