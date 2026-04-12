<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Station
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow border">
                <form action="{{ route('stations.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-center">
                    @csrf
                    <input type="text" name="name" placeholder="Name" class="border p-2 rounded w-full" required>
                    <input type="text" name="address" placeholder="Address" class="border p-2 rounded w-full" required>
                    <input type="number" name="total_charging_points" placeholder="Slots" class="border p-2 rounded w-full" required min="1">
                    <input type="file" name="image" accept="image/*" class="border p-2 rounded w-full text-sm">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded font-bold hover:bg-blue-700 w-full h-full">Add Station</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>