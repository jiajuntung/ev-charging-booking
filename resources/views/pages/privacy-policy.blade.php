<x-app-layout>
<div class="min-h-screen bg-[#efede6] py-12 px-4">
    <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="mb-8">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm text-[#89a57b] hover:text-[#664c35] font-medium transition mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Home
            </a>
            <h1 class="text-4xl font-black text-[#664c35] tracking-tight">Privacy Policy</h1>
            <p class="text-sm text-[#89a57b] font-medium mt-1">Last updated: April 2025</p>
            <div class="w-16 h-1 bg-[#89a57b] rounded-full mt-3"></div>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-3xl shadow-md border border-[#e8e2d9] overflow-hidden">

            <!-- Green top bar -->
            <div class="h-2 bg-[#89a57b]"></div>

            <div class="px-10 py-10 space-y-8 text-gray-700 text-sm leading-relaxed">

                <section>
                    <h2 class="text-lg font-black text-[#664c35] mb-3">1. Introduction</h2>
                    <p>ChargeX Sdn Bhd ("we", "us", or "our") is committed to protecting your personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our EV charging booking platform.</p>
                </section>

                <div class="border-t border-[#f0ece5]"></div>

                <section>
                    <h2 class="text-lg font-black text-[#664c35] mb-3">2. Information We Collect</h2>
                    <p class="mb-3">We may collect the following types of information:</p>
                    <ul class="space-y-2 pl-4">
                        <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#89a57b] mt-1.5 shrink-0"></span><span><strong class="text-[#664c35]">Personal Information:</strong> Name, email address, and password when you register.</span></li>
                        <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#89a57b] mt-1.5 shrink-0"></span><span><strong class="text-[#664c35]">Usage Data:</strong> Charging session details, booking history, kWh consumed, and payment records.</span></li>
                        <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#89a57b] mt-1.5 shrink-0"></span><span><strong class="text-[#664c35]">Device Data:</strong> IP address, browser type, and access times for security purposes.</span></li>
                    </ul>
                </section>

                <div class="border-t border-[#f0ece5]"></div>

                <section>
                    <h2 class="text-lg font-black text-[#664c35] mb-3">3. How We Use Your Information</h2>
                    <ul class="space-y-2 pl-4">
                        <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#89a57b] mt-1.5 shrink-0"></span><span>To provide and manage your EV charging bookings.</span></li>
                        <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#89a57b] mt-1.5 shrink-0"></span><span>To process payments and send receipts.</span></li>
                        <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#89a57b] mt-1.5 shrink-0"></span><span>To send account-related notifications and password reset emails.</span></li>
                        <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#89a57b] mt-1.5 shrink-0"></span><span>To improve our services and user experience.</span></li>
                    </ul>
                </section>

                <div class="border-t border-[#f0ece5]"></div>

                <section>
                    <h2 class="text-lg font-black text-[#664c35] mb-3">4. Data Sharing</h2>
                    <p>We do not sell or rent your personal data to third parties. We may share data with trusted service providers (e.g., payment processors) solely to operate our platform, under strict confidentiality agreements.</p>
                </section>

                <div class="border-t border-[#f0ece5]"></div>

                <section>
                    <h2 class="text-lg font-black text-[#664c35] mb-3">5. Data Security</h2>
                    <p>We implement industry-standard security measures including encrypted connections (HTTPS), hashed passwords, and regular security audits. However, no method of transmission over the Internet is 100% secure.</p>
                </section>

                <div class="border-t border-[#f0ece5]"></div>

                <section>
                    <h2 class="text-lg font-black text-[#664c35] mb-3">6. Your Rights</h2>
                    <p>You have the right to access, correct, or delete your personal data at any time via your Profile settings. For further requests, contact us at <span class="text-[#89a57b] font-medium">support@chargex.com.my</span>.</p>
                </section>

                <div class="border-t border-[#f0ece5]"></div>

                <section>
                    <h2 class="text-lg font-black text-[#664c35] mb-3">7. Contact Us</h2>
                    <p>If you have questions about this Privacy Policy, please contact:</p>
                    <div class="mt-3 bg-[#faf8f5] rounded-2xl p-5 border border-[#e8e2d9]">
                        <p class="font-bold text-[#664c35]">ChargeX Sdn Bhd</p>
                        <p class="text-gray-500 mt-1">Email: support@chargex.com.my</p>
                        <p class="text-gray-500">Phone: +60 12-319 7994</p>
                    </div>
                </section>

            </div>
        </div>

    </div>
</div>
</x-app-layout>
