<x-app-layout>
    <div class="py-12">
        <div class="max-w-md mx-auto bg-gray-900 rounded-3xl p-8 shadow-2xl border-t-8 border-green-500 text-center">
            <h2 class="text-green-500 text-xl font-black uppercase tracking-widest mb-2">Live Charging</h2>
            <p class="text-gray-400 text-sm mb-8">Station: {{ $booking->station->name }}</p>

            <div class="relative flex justify-center items-center mb-8">
                <div class="absolute w-40 h-40 border-4 border-green-500 rounded-full animate-ping opacity-20"></div>
                <div class="w-36 h-36 border-4 border-green-500 rounded-full flex flex-col justify-center items-center bg-gray-800 shadow-inner">
                    <span id="kwh-display" class="text-4xl font-mono text-white">0.000</span>
                    <span class="text-xs text-green-500 font-bold uppercase">kWh</span>
                </div>
            </div>

            <div class="bg-gray-800 rounded-xl p-4 mb-8">
                <p class="text-gray-400 text-xs uppercase font-bold">Estimated Cost</p>
                <p class="text-2xl text-yellow-400 font-mono">RM <span id="cost-display">0.00</span></p>
            </div>

            <form action="{{ route('bookings.stop', $booking) }}" method="POST">
                @csrf
                <button type="submit" onclick="return confirm('End session?')" 
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-black py-4 rounded-2xl shadow-lg transition duration-300">
                    STOP CHARGING
                </button>
            </form>
        </div>
    </div>

    <script>
        let kwh = 0.000;
        let cost = 0.00;
        setInterval(() => {
            kwh += 0.05; // Simulate speed/
            cost += 0.5;  // RM 0.50 per second/
            document.getElementById('kwh-display').innerText = kwh.toFixed(3);
            document.getElementById('cost-display').innerText = cost.toFixed(2);
        }, 1000);
    </script>
</x-app-layout>