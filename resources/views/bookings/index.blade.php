<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-x1 text-gray-800 leading-tight">My Bookings</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                        @if($booking->status != 'completed' && $booking->status != 'charging')
                                            <form action="{{ route('bookings.start', $booking) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition shadow-sm">
                                                    Start Charging
                                                </button>
                                            </form>
                                        @elseif($booking->status == 'charging')
                                            <a href="{{ route('bookings.status', $booking) }}"
                                                class="bg-green-500 text-white px-3 py-1 rounded text-sm inline-block hover:bg-green-600 shadow-sm">
                                                View Status ⚡
                                            </a>
                                        @else
                                            <span class="text-gray-400 text-xs italic">Session Ended</span>
                                        @endif
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