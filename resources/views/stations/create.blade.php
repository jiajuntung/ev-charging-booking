<x-app-layout>
<div class="min-h-screen bg-[#efede6] py-10 px-4">
    <div class="max-w-5xl mx-auto space-y-8">

        <!-- Page Header -->
        <div>
            <h1 class="text-3xl font-black text-[#664c35] tracking-tight">Station Management</h1>
            <p class="text-sm text-[#89a57b] mt-1 font-medium">Add, delete, or manage availability of charging stations</p>
            <div class="w-16 h-1 bg-[#89a57b] rounded-full mt-3"></div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="flex items-center gap-3 bg-[#eaf3e6] border-l-4 border-[#89a57b] text-[#4a7a3d] p-4 rounded-2xl shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="flex items-start gap-3 bg-red-50 border-l-4 border-red-400 text-red-700 p-4 rounded-2xl shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <ul class="text-sm space-y-1">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <!-- ── ADD NEW STATION CARD ── -->
        <div class="bg-white rounded-3xl shadow-md border border-[#e8e2d9] overflow-hidden">
            <div class="h-2 bg-[#89a57b]"></div>
            <div class="px-8 py-8">
                <h2 class="text-lg font-black text-[#664c35] mb-6 flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full bg-[#eaf3e6] flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    </div>
                    Add New Station
                </h2>

                <form action="{{ route('stations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-bold text-[#664c35] mb-1.5">Station Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                placeholder="e.g. Sunway Pyramid Charging Station"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-[#faf8f5] text-gray-800 text-sm focus:outline-none focus:border-[#89a57b] focus:ring-2 focus:ring-[#89a57b]/20 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#664c35] mb-1.5">Total Charging Slots</label>
                            <input type="number" name="total_charging_points" value="{{ old('total_charging_points') }}" required min="1"
                                placeholder="e.g. 10"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-[#faf8f5] text-gray-800 text-sm focus:outline-none focus:border-[#89a57b] focus:ring-2 focus:ring-[#89a57b]/20 transition">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#664c35] mb-1.5">Address</label>
                        <textarea name="address" rows="2" required
                            placeholder="e.g. No 3, Jalan PJS 11/15, Bandar Sunway, Selangor"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-[#faf8f5] text-gray-800 text-sm focus:outline-none focus:border-[#89a57b] focus:ring-2 focus:ring-[#89a57b]/20 transition resize-none">{{ old('address') }}</textarea>
                    </div>
                    <div x-data="{ preview: null }">
                        <label class="block text-sm font-bold text-[#664c35] mb-1.5">Station Image <span class="text-gray-400 font-normal">(optional)</span></label>
                        <div class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-[#faf8f5]">
                            <input type="file" name="image" accept="image/*"
                                class="w-full text-gray-500 text-sm file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#eaf3e6] file:text-[#4a7a3d] hover:file:bg-[#d5eacf] file:cursor-pointer"
                                @change="const f = $event.target.files[0]; if(f) { const r = new FileReader(); r.onload = e => preview = e.target.result; r.readAsDataURL(f); } else { preview = null; }">
                        </div>
                        <div x-show="preview" class="mt-3">
                            <img :src="preview" class="h-40 w-full object-cover rounded-xl border border-[#e8e2d9]">
                        </div>
                    </div>
                    <div class="flex justify-end pt-1">
                        <button type="submit"
                            class="bg-[#89a57b] hover:bg-[#7a9470] text-white font-bold px-8 py-3 rounded-xl transition shadow-sm text-sm">
                            Add Station
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ── MANAGE STATIONS CARD ── -->
        <div x-data="{
                modal: null,
                station: {},
                editAddress: '',
                editSlots: '',
                open(s) {
                    this.station = s;
                    this.editAddress = s.address;
                    this.editSlots = s.slots;
                    this.modal = 'main';
                }
             }" class="bg-white rounded-3xl shadow-md border border-[#e8e2d9] overflow-hidden">
            <div class="h-2 bg-[#664c35]"></div>
            <div class="px-8 py-8">
                <h2 class="text-lg font-black text-[#664c35] mb-6 flex items-center gap-2">
                    <div class="w-7 h-7 rounded-full bg-amber-50 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/>
                        </svg>
                    </div>
                    Manage Existing Stations
                </h2>

                @php $allStations = \App\Models\Station::all(); @endphp

                @if($allStations->isEmpty())
                    <p class="text-gray-400 text-sm text-center py-8">No stations yet. Add your first station above.</p>
                @else
                    <!-- Table Header -->
                    <div class="grid grid-cols-12 bg-[#faf8f5] rounded-xl px-4 py-3 text-xs font-bold text-[#664c35] uppercase tracking-widest mb-2 border border-[#e8e2d9]">
                        <div class="col-span-5">Station</div>
                        <div class="col-span-3">Address</div>
                        <div class="col-span-2 text-center">Slots</div>
                        <div class="col-span-1 text-center">Status</div>
                        <div class="col-span-1 text-center">Action</div>
                    </div>

                    <!-- Rows -->
                    @foreach($allStations as $station)
                        <div class="grid grid-cols-12 items-center px-4 py-4 border-b border-[#f0ece5] hover:bg-[#faf8f5] transition-colors last:border-0">

                            <div class="col-span-5 flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-[#eaf3e6] flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M3 3h12v13H3z"/><path d="M15 7h2a2 2 0 0 1 2 2v3a2 2 0 0 0 2 2"/><line x1="7" y1="16" x2="11" y2="16"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-[#664c35] line-clamp-2">{{ $station->name }}</span>
                            </div>

                            <div class="col-span-3 text-xs text-gray-400 line-clamp-2 pr-3">{{ $station->address }}</div>

                            <div class="col-span-2 text-center">
                                <span class="bg-[#eaf3e6] text-[#89a57b] text-xs font-bold px-3 py-1 rounded-full">
                                    {{ $station->total_charging_points }} Slots
                                </span>
                            </div>

                            <div class="col-span-1 text-center">
                                @if($station->is_available)
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-bold bg-[#eaf3e6] text-[#4a7a3d]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#89a57b] inline-block"></span> On
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-bold bg-red-50 text-red-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-400 inline-block"></span> Off
                                    </span>
                                @endif
                            </div>

                            <!-- Single Modify button -->
                            <div class="col-span-1 text-center">
                                <button type="button"
                                    @click="open({
                                        id: {{ $station->id }},
                                        name: '{{ addslashes($station->name) }}',
                                        address: '{{ addslashes($station->address) }}',
                                        slots: {{ $station->total_charging_points }},
                                        available: {{ $station->is_available ? 'true' : 'false' }},
                                        toggleUrl: '{{ route('stations.toggle', $station) }}',
                                        deleteUrl: '{{ route('stations.destroy', $station) }}',
                                        updateUrl: '{{ route('stations.update', $station) }}'
                                    })"
                                    class="bg-[#89a57b] hover:bg-[#7a9470] text-white px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                    Modify
                                </button>
                            </div>

                        </div>
                    @endforeach
                @endif
            </div>

            <!-- ── UNIFIED MODIFY MODAL ── -->
            <!-- Main options modal -->
            <div x-show="modal === 'main'"
                 x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 flex items-center justify-center px-4" style="display:none;">
                <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="modal = null"></div>
                <div x-show="modal === 'main'"
                     x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                     class="relative bg-white rounded-3xl shadow-2xl border border-[#e8e2d9] w-full max-w-sm overflow-hidden z-10">
                    <div class="h-2 bg-[#89a57b]"></div>
                    <div class="px-8 py-8">
                        <h2 class="text-xl font-black text-[#664c35] text-center mb-1" x-text="station.name"></h2>
                        <p class="text-xs text-gray-400 text-center mb-7">Choose an action for this station</p>

                        <div class="space-y-3">
                            <!-- Disable / Enable -->
                            <form :action="station.toggleUrl" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="w-full flex items-center gap-4 bg-[#faf8f5] hover:bg-amber-50 border border-[#e8e2d9] hover:border-amber-200 rounded-2xl px-5 py-4 transition text-left">
                                    <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-[#664c35]" x-text="station.available ? 'Disable Station' : 'Enable Station'"></p>
                                        <p class="text-xs text-gray-400" x-text="station.available ? 'Mark this station as unavailable to users' : 'Make this station available for booking'"></p>
                                    </div>
                                </button>
                            </form>

                            <!-- Edit details -->
                            <button type="button" @click="modal = 'edit'"
                                class="w-full flex items-center gap-4 bg-[#faf8f5] hover:bg-[#eaf3e6] border border-[#e8e2d9] hover:border-[#89a57b] rounded-2xl px-5 py-4 transition text-left">
                                <div class="w-10 h-10 rounded-full bg-[#eaf3e6] flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-[#664c35]">Edit Details</p>
                                    <p class="text-xs text-gray-400">Update address or number of charging slots</p>
                                </div>
                            </button>

                            <!-- Delete -->
                            <button type="button" @click="modal = 'delete'"
                                class="w-full flex items-center gap-4 bg-[#faf8f5] hover:bg-red-50 border border-[#e8e2d9] hover:border-red-200 rounded-2xl px-5 py-4 transition text-left">
                                <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-red-500">Delete Station</p>
                                    <p class="text-xs text-gray-400">Permanently remove this station</p>
                                </div>
                            </button>
                        </div>

                        <button @click="modal = null" class="w-full mt-5 text-sm text-gray-400 hover:text-gray-600 py-2 transition">Cancel</button>
                    </div>
                </div>
            </div>

            <!-- Edit details modal -->
            <div x-show="modal === 'edit'"
                 x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 flex items-center justify-center px-4" style="display:none;">
                <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="modal = null"></div>
                <div x-show="modal === 'edit'"
                     x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                     class="relative bg-white rounded-3xl shadow-2xl border border-[#e8e2d9] w-full max-w-sm overflow-hidden z-10">
                    <div class="h-2 bg-[#89a57b]"></div>
                    <div class="px-8 py-8">
                        <button @click="modal = 'main'" class="flex items-center gap-1.5 text-xs text-[#89a57b] font-medium mb-4 hover:text-[#664c35] transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                            Back
                        </button>
                        <h2 class="text-xl font-black text-[#664c35] mb-1">Edit Details</h2>
                        <p class="text-xs text-gray-400 mb-6" x-text="station.name"></p>

                        <form :action="station.updateUrl" method="POST" class="space-y-4">
                            @csrf @method('PATCH')
                            <div>
                                <label class="block text-sm font-bold text-[#664c35] mb-1.5">Address</label>
                                <textarea name="address" rows="3" x-model="editAddress" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-[#faf8f5] text-gray-800 text-sm focus:outline-none focus:border-[#89a57b] focus:ring-2 focus:ring-[#89a57b]/20 transition resize-none"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#664c35] mb-1.5">Total Charging Slots</label>
                                <input type="number" name="total_charging_points" x-model="editSlots" min="1" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-[#faf8f5] text-gray-800 text-sm focus:outline-none focus:border-[#89a57b] focus:ring-2 focus:ring-[#89a57b]/20 transition">
                            </div>
                            <div class="flex gap-3 pt-1">
                                <button type="button" @click="modal = 'main'"
                                    class="flex-1 border border-[#e8e2d9] text-gray-600 hover:bg-[#faf8f5] font-bold py-3 rounded-xl transition text-sm">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="flex-1 bg-[#89a57b] hover:bg-[#7a9470] text-white font-bold py-3 rounded-xl transition shadow-sm text-sm">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete confirm modal -->
            <div x-show="modal === 'delete'"
                 x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 flex items-center justify-center px-4" style="display:none;">
                <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="modal = null"></div>
                <div x-show="modal === 'delete'"
                     x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                     class="relative bg-white rounded-3xl shadow-2xl border border-[#e8e2d9] w-full max-w-sm overflow-hidden z-10">
                    <div class="h-2 bg-red-500"></div>
                    <div class="px-8 py-8">
                        <button @click="modal = 'main'" class="flex items-center gap-1.5 text-xs text-[#89a57b] font-medium mb-4 hover:text-[#664c35] transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                            Back
                        </button>
                        <div class="flex justify-center mb-5">
                            <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                                </svg>
                            </div>
                        </div>
                        <h2 class="text-xl font-black text-[#664c35] text-center">Delete Station?</h2>
                        <p class="text-sm text-gray-400 text-center mt-2">
                            This will permanently delete <span class="font-semibold text-[#664c35]" x-text="station.name"></span> and all its records.
                        </p>
                        <div class="flex gap-3 mt-7">
                            <button @click="modal = 'main'"
                                class="flex-1 border border-[#e8e2d9] text-gray-600 hover:bg-[#faf8f5] font-bold py-3 rounded-xl transition text-sm">
                                Cancel
                            </button>
                            <form :action="station.deleteUrl" method="POST" class="flex-1">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-xl transition shadow-sm text-sm">
                                    Yes, Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
</x-app-layout>
