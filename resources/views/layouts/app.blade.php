<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-[#3d2e1e] text-white mt-0">
                <div class="max-w-7xl mx-auto px-6 py-12">

                    <!-- Top grid -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-10 border-b border-white/10">

                        <!-- Brand -->
                        <div class="col-span-1 md:col-span-1">
                            <h2 class="text-xl font-black text-white mb-2">ChargeX</h2>
                            <p class="text-sm text-white/50 leading-relaxed">Smart EV charging solutions across Malaysia. Powering a greener future.</p>
                            <!-- Social -->
                            <div class="flex gap-3 mt-5">
                                <!-- Instagram -->
                                <a href="https://www.instagram.com/kokwenkai/" target="_blank" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#89a57b] flex items-center justify-center transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" stroke="none"/>
                                    </svg>
                                </a>
                                <!-- Facebook -->
                                <a href="https://www.facebook.com/wenkai.kok.1" target="_blank" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#89a57b] flex items-center justify-center transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                                    </svg>
                                </a>
                                <!-- LinkedIn -->
                                <a href="https://my.linkedin.com/in/wen-kai-kok-11a236313" target="_blank" class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#89a57b] flex items-center justify-center transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Quick Links -->
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-widest text-[#89a57b] mb-4">Quick Links</h3>
                            <ul class="space-y-2 text-sm text-white/60">
                                <li><a href="{{ url('/') }}" class="hover:text-white transition">Home</a></li>
                                <li><a href="{{ route('stations.index') }}" class="hover:text-white transition">Find Chargers</a></li>
                                @auth
                                <li><a href="{{ route('bookings.index') }}" class="hover:text-white transition">My Bookings</a></li>
                                <li><a href="{{ route('profile.edit') }}" class="hover:text-white transition">My Profile</a></li>
                                @endauth
                            </ul>
                        </div>

                        <!-- Legal -->
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-widest text-[#89a57b] mb-4">Legal</h3>
                            <ul class="space-y-2 text-sm text-white/60">
                                <li><a href="{{ route('privacy-policy') }}" class="hover:text-white transition">Privacy Policy</a></li>
                                <li><a href="{{ route('terms') }}" class="hover:text-white transition">Terms & Conditions</a></li>
                                <li><a href="{{ route('about') }}" class="hover:text-white transition">About Us</a></li>
                            </ul>
                        </div>

                        <!-- Contact -->
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-widest text-[#89a57b] mb-4">Contact Us</h3>
                            <ul class="space-y-3 text-sm text-white/60">
                                <li class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#89a57b] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                                    </svg>
                                    support@chargex.com.my
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#89a57b] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a19.79 19.79 0 01-3.07-8.68A2 2 0 012 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 8.92a16 16 0 006.16 6.16l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
                                    </svg>
                                    +60 12-319 7994
                                </li>
                            </ul>
                        </div>

                    </div>

                    <!-- Bottom bar -->
                    <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-white/40">
                        <p>© {{ date('Y') }} ChargeX Sdn Bhd. All rights reserved.</p>
                        <p>Built for a greener Malaysia 🌿</p>
                    </div>

                </div>
            </footer>

        </div>
    </body>
</html>
