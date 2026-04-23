<section x-data="{ showDeleteModal: false }" class="space-y-5">
    <p class="text-sm text-gray-400">
        Once your account is deleted, all data will be permanently removed. This action cannot be undone.
    </p>

    <button @click="showDeleteModal = true"
        class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 font-bold px-6 py-2.5 rounded-xl transition text-sm">
        Delete My Account
    </button>

    <!-- Delete Modal -->
    <div x-show="showDeleteModal"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center px-4"
         style="display:none;">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="showDeleteModal = false"></div>
        <div x-show="showDeleteModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="relative bg-white rounded-3xl shadow-2xl border border-[#e8e2d9] w-full max-w-sm overflow-hidden z-10">
            <div class="h-2 bg-red-500"></div>
            <div class="px-8 py-8">
                <div class="flex justify-center mb-5">
                    <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                        </svg>
                    </div>
                </div>
                <h2 class="text-xl font-black text-[#664c35] text-center">Delete Account?</h2>
                <p class="text-sm text-gray-400 text-center mt-2">All your bookings and data will be permanently deleted. Enter your password to confirm.</p>

                <form method="post" action="{{ route('profile.destroy') }}" class="mt-6 space-y-4">
                    @csrf
                    @method('delete')
                    <div>
                        <input name="password" type="password" placeholder="Enter your password"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-[#faf8f5] text-gray-800 text-sm
                                   focus:outline-none focus:border-red-400 focus:ring-2 focus:ring-red-200 transition">
                        @error('password', 'userDeletion')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex gap-3">
                        <button type="button" @click="showDeleteModal = false"
                            class="flex-1 border border-[#e8e2d9] text-gray-600 hover:bg-[#faf8f5] font-bold py-3 rounded-xl transition text-sm">
                            Cancel
                        </button>
                        <button type="submit"
                            class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-xl transition shadow-sm text-sm">
                            Yes, Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
