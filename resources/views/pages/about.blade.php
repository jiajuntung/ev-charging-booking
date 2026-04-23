<x-app-layout>
<div class="min-h-screen bg-[#efede6] py-12 px-4">
    <div class="max-w-5xl mx-auto">

        <!-- Header -->
        <div class="mb-8">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm text-[#89a57b] hover:text-[#664c35] font-medium transition mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Home
            </a>
            <h1 class="text-4xl font-black text-[#664c35] tracking-tight">About Us</h1>
            <p class="text-sm text-[#89a57b] font-medium mt-1">Driving Malaysia's EV future, one charge at a time</p>
            <div class="w-16 h-1 bg-[#89a57b] rounded-full mt-3"></div>
        </div>

        <!-- Hero Card -->
        <div class="bg-white rounded-3xl shadow-md border border-[#e8e2d9] overflow-hidden mb-6">
            <div class="h-2 bg-[#89a57b]"></div>
            <div class="px-10 py-12 text-center">
                <div class="w-20 h-20 rounded-full bg-[#eaf3e6] flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path d="M3 3h12v13H3z"/><path d="M15 7h2a2 2 0 0 1 2 2v3a2 2 0 0 0 2 2"/><line x1="7" y1="16" x2="11" y2="16"/><line x1="9" y1="3" x2="9" y2="7"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-[#664c35] mb-4">ChargeX Sdn Bhd</h2>
                <p class="text-gray-500 max-w-2xl mx-auto leading-relaxed">We are Malaysia's leading smart EV charging booking platform — connecting EV drivers to reliable, accessible charging stations across the country. Our mission is to make electric vehicle ownership seamless, affordable, and sustainable.</p>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-3xl border border-[#e8e2d9] shadow-sm p-8 text-center">
                <p class="text-4xl font-black text-[#89a57b]">50+</p>
                <p class="text-sm text-gray-500 mt-1 font-medium">Charging Stations</p>
            </div>
            <div class="bg-white rounded-3xl border border-[#e8e2d9] shadow-sm p-8 text-center">
                <p class="text-4xl font-black text-[#89a57b]">1,200+</p>
                <p class="text-sm text-gray-500 mt-1 font-medium">Happy EV Drivers</p>
            </div>
            <div class="bg-white rounded-3xl border border-[#e8e2d9] shadow-sm p-8 text-center">
                <p class="text-4xl font-black text-[#89a57b]">5</p>
                <p class="text-sm text-gray-500 mt-1 font-medium">States Covered</p>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 items-stretch">
            <div class="bg-white rounded-3xl border border-[#e8e2d9] shadow-sm overflow-hidden flex flex-col">
                <div class="h-2 bg-[#89a57b]"></div>
                <div class="p-8 flex flex-col flex-1">
                    <div class="w-12 h-12 rounded-full bg-[#eaf3e6] flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-[#664c35] mb-3">Our Mission</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">To accelerate the adoption of electric vehicles in Malaysia by providing a smart, reliable, and user-friendly EV charging ecosystem that empowers drivers to charge with confidence.</p>
                </div>
            </div>
            <div class="bg-white rounded-3xl border border-[#e8e2d9] shadow-sm overflow-hidden flex flex-col">
                <div class="h-2 bg-[#89a57b]"></div>
                <div class="p-8 flex flex-col flex-1">
                    <div class="w-12 h-12 rounded-full bg-[#eaf3e6] flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-[#664c35] mb-3">Our Vision</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">A Malaysia where every EV driver has access to a charging point within reach — contributing to a greener, cleaner, and more sustainable nation for future generations.</p>
                </div>
            </div>
        </div>

        <!-- Values -->
        <div class="bg-white rounded-3xl shadow-md border border-[#e8e2d9] overflow-hidden mb-6">
            <div class="h-2 bg-[#89a57b]"></div>
            <div class="px-10 py-10">
                <h3 class="text-xl font-black text-[#664c35] mb-6">Our Core Values</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-[#faf8f5] rounded-2xl p-6 border border-[#e8e2d9]">
                        <div class="w-10 h-10 rounded-full bg-[#eaf3e6] flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="font-black text-[#664c35] text-sm mb-2">Reliability</p>
                        <p class="text-xs text-gray-400 leading-relaxed">Our stations are maintained to the highest standards so you can always count on a smooth charge.</p>
                    </div>
                    <div class="bg-[#faf8f5] rounded-2xl p-6 border border-[#e8e2d9]">
                        <div class="w-10 h-10 rounded-full bg-[#eaf3e6] flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </div>
                        <p class="font-black text-[#664c35] text-sm mb-2">Transparency</p>
                        <p class="text-xs text-gray-400 leading-relaxed">Clear pricing, honest billing, and no hidden fees — ever.</p>
                    </div>
                    <div class="bg-[#faf8f5] rounded-2xl p-6 border border-[#e8e2d9]">
                        <div class="w-10 h-10 rounded-full bg-[#eaf3e6] flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/>
                            </svg>
                        </div>
                        <p class="font-black text-[#664c35] text-sm mb-2">Sustainability</p>
                        <p class="text-xs text-gray-400 leading-relaxed">Every charge through ChargeX contributes to reducing Malaysia's carbon footprint.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact -->
        <div class="bg-white rounded-3xl shadow-md border border-[#e8e2d9] overflow-hidden">
            <div class="h-2 bg-[#89a57b]"></div>
            <div class="px-10 py-10">
                <h3 class="text-xl font-black text-[#664c35] mb-6">Get In Touch</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="bg-[#faf8f5] rounded-2xl p-5 border border-[#e8e2d9] flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-[#eaf3e6] flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Email</p>
                            <p class="text-sm font-bold text-[#664c35]">support@chargex.com.my</p>
                        </div>
                    </div>
                    <div class="bg-[#faf8f5] rounded-2xl p-5 border border-[#e8e2d9] flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-[#eaf3e6] flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a19.79 19.79 0 01-3.07-8.68A2 2 0 012 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 8.92a16 16 0 006.16 6.16l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Phone</p>
                            <p class="text-sm font-bold text-[#664c35]">+60 12-319 7994</p>
                        </div>
                    </div>
                    <div class="bg-[#faf8f5] rounded-2xl p-5 border border-[#e8e2d9] flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-[#eaf3e6] flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#89a57b]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Address</p>
                            <p class="text-sm font-bold text-[#664c35]">Kuala Lumpur, Malaysia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</x-app-layout>
