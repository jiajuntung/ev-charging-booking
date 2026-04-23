<nav x-data="{ open: false, showLogoutModal: false }" class="bg-[#89a57b] shadow-md">
    <div class="px-[10%]">
        <div class="flex justify-between items-center h-20">

            <!-- LEFT: Logo + Brand -->
            <div class="flex items-center gap-3">
                <a href="{{ auth()->check() ? route('dashboard') : '/' }}" class="flex items-center gap-2.5">
                    <img src="{{ asset('images/chargex.png') }}" alt="ChargeX" class="h-[72px] w-[72px] object-cover rounded-full shrink-0">
                    <div class="hidden sm:block">
                        <span class="text-white font-black text-2xl tracking-tight leading-none">ChargeX</span>
                        <p class="text-white/60 text-xs font-medium tracking-widest uppercase leading-none mt-0.5">EV Charging</p>
                    </div>
                </a>
            </div>

            <!-- CENTER: Nav Links (desktop) -->
            <div class="hidden sm:flex items-center gap-3">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-2 px-6 py-3 rounded-xl text-base font-bold transition-all duration-150
                   {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Home
                </a>

                <a href="{{ route('stations.index') }}"
                   class="flex items-center gap-2 px-6 py-3 rounded-xl text-base font-bold transition-all duration-150
                   {{ request()->routeIs('stations.index') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h12v13H3z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7h2a2 2 0 012 2v3a2 2 0 002 2"/>
                        <line x1="7" y1="16" x2="11" y2="16"/>
                        <line x1="9" y1="3" x2="9" y2="7"/>
                    </svg>
                    Find Chargers
                </a>

                @auth
                <a href="{{ route('bookings.index') }}"
                   class="flex items-center gap-2 px-6 py-3 rounded-xl text-base font-bold transition-all duration-150
                   {{ request()->routeIs('bookings.index') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    My Bookings
                </a>

                @if(auth()->user()->is_admin)
                <a href="{{ route('stations.create') }}"
                   class="flex items-center gap-2 px-6 py-3 rounded-xl text-base font-bold transition-all duration-150
                   {{ request()->routeIs('stations.create') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Manage Stations
                </a>
                @endif
                @endauth
            </div>

            <!-- RIGHT: Auth buttons / User dropdown -->
            <div class="hidden sm:flex items-center">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2.5 bg-white/15 hover:bg-white/25 border border-white/20 text-white px-4 py-2.5 rounded-xl text-base font-bold transition-all duration-150">
                                <div class="w-7 h-7 rounded-full bg-white/30 flex items-center justify-center text-xs font-black text-white shrink-0">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="max-w-[100px] truncate">{{ Auth::user()->name }}</span>
                                <svg class="w-3.5 h-3.5 opacity-70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <!-- User info header in dropdown -->
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-xs text-gray-400 font-medium">Signed in as</p>
                                <p class="text-sm font-bold text-[#664c35] truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <x-dropdown-link :href="route('profile.edit')">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Profile
                                </div>
                            </x-dropdown-link>
                            <button @click="showLogoutModal = true"
                                class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Log Out
                            </button>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}" class="text-white/90 hover:text-white font-bold text-sm px-4 py-2 rounded-xl hover:bg-white/10 transition">Log In</a>
                        <a href="{{ route('register') }}" class="bg-white text-[#89a57b] hover:bg-[#f5f5f5] px-5 py-2 rounded-xl text-sm font-black shadow-sm transition">Sign Up</a>
                    </div>
                @endauth
            </div>

            <!-- Mobile hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-xl text-white hover:bg-white/10 focus:outline-none transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-[#7a9470] border-t border-white/10">
        <div class="px-4 pt-3 pb-4 space-y-1">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-bold text-white/90 hover:bg-white/10 transition {{ request()->routeIs('dashboard') ? 'bg-white/20' : '' }}">
                Home
            </a>
            <a href="{{ route('stations.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-bold text-white/90 hover:bg-white/10 transition {{ request()->routeIs('stations.index') ? 'bg-white/20' : '' }}">
                Find Chargers
            </a>
            @auth
            <a href="{{ route('bookings.index') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-bold text-white/90 hover:bg-white/10 transition {{ request()->routeIs('bookings.index') ? 'bg-white/20' : '' }}">
                My Bookings
            </a>
            @if(auth()->user()->is_admin)
            <a href="{{ route('stations.create') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-xl text-sm font-bold text-white/90 hover:bg-white/10 transition {{ request()->routeIs('stations.create') ? 'bg-white/20' : '' }}">
                Manage Stations
            </a>
            @endif
            @endauth
        </div>
        @auth
        <div class="px-4 pt-3 pb-4 border-t border-white/10">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-full bg-white/30 flex items-center justify-center text-sm font-black text-white">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-white">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-white/60">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-xl text-sm font-bold text-white/90 hover:bg-white/10 transition">Profile</a>
            <button @click="showLogoutModal = true" class="w-full text-left px-3 py-2 rounded-xl text-sm font-bold text-white/90 hover:bg-white/10 transition">Log Out</button>
        </div>
        @else
        <div class="px-4 pt-3 pb-4 border-t border-white/10 flex gap-2">
            <a href="{{ route('login') }}" class="flex-1 text-center py-2 rounded-xl text-sm font-bold text-white border border-white/30 hover:bg-white/10 transition">Log In</a>
            <a href="{{ route('register') }}" class="flex-1 text-center py-2 rounded-xl text-sm font-black bg-white text-[#89a57b] hover:bg-[#f5f5f5] transition">Sign Up</a>
        </div>
        @endauth
    </div>

    <!-- LOGOUT CONFIRMATION MODAL -->
    @auth
    <div x-show="showLogoutModal"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center px-4"
         style="display: none;">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="showLogoutModal = false"></div>
        <div x-show="showLogoutModal"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="relative bg-white rounded-3xl shadow-2xl border border-[#e8e2d9] w-full max-w-sm overflow-hidden z-10">
            <div class="h-2 bg-[#89a57b]"></div>
            <div class="px-8 py-8">
                <div class="flex justify-center mb-5">
                    <div class="w-16 h-16 rounded-full bg-[#eaf3e6] flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                </div>
                <h2 class="text-xl font-black text-[#664c35] text-center">Sign Out?</h2>
                <p class="text-sm text-gray-400 text-center mt-2">Are you sure you want to log out of your account?</p>
                <div class="flex gap-3 mt-7">
                    <button @click="showLogoutModal = false"
                        class="flex-1 border border-[#e8e2d9] text-gray-600 hover:bg-[#faf8f5] font-bold py-3 rounded-xl transition text-sm">
                        Cancel
                    </button>
                    <form method="POST" action="{{ route('logout') }}" class="flex-1">
                        @csrf
                        <button type="submit"
                            class="w-full bg-[#89a57b] hover:bg-[#7a9470] text-white font-bold py-3 rounded-xl transition shadow-sm text-sm">
                            Yes, Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth
</nav>
