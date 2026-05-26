@php
$showGuestLinks = $showGuestLinks ?? false;
$showUserBadge = $showUserBadge ?? false;
$showLogoutButton = $showLogoutButton ?? false;
$displayName = $displayName ?? 'Loading...';
@endphp

<header class="h-[72px] border-b border-white/5 flex items-center justify-between px-6 md:px-12 bg-bg-deep/75 backdrop-blur-xl sticky top-0 z-50">
    <a href="{{ route('home') }}" class="flex items-center gap-2.5 text-decoration-none group">
        <div class="w-9 h-9 bg-gradient-to-br from-accent-blue to-accent-green rounded-lg flex items-center justify-center font-bold text-bg-deep text-sm transition-transform group-hover:scale-105">
            SI
        </div>
        <span class="font-display font-extrabold text-lg text-[#F0F4FF]">Skill India</span>
    </a>

    <div class="flex items-center gap-4">
        <nav class="flex items-center gap-6 md:gap-8">
            <a href="{{ route('features') }}" class="text-slate-400 hover:text-accent-blue text-sm transition duration-150">Features</a>
            <a href="{{ route('coaches') }}" class="text-slate-400 hover:text-accent-blue text-sm transition duration-150">Coaches</a>
        </nav>

        @if($showGuestLinks)
        <div class="flex items-center gap-3">
            <a href="{{ route('login') }}" class="text-slate-300 border border-white/10 hover:border-accent-blue/30 px-4 py-2 rounded-xl text-sm transition duration-200">Login</a>
            <a href="{{ route('register') }}" class="bg-accent-blue hover:bg-[#90cdf4] text-bg-deep font-bold px-4 py-2 md:px-5 md:py-2.5 rounded-xl text-sm transition duration-200 shadow-md hover:shadow-accent-blue/10">Get Started</a>
        </div>
        @endif

        @if($showUserBadge)
        <div class="flex items-center gap-2.5 bg-bg-card border border-white/5 rounded-full px-4.5 py-2">
            <div class="w-2 h-2 rounded-full bg-accent-green animate-pulse"></div>
            <span class="text-xs font-semibold text-slate-200" id="user-display-name">{{ $displayName }}</span>
        </div>
        @endif

        @if($showLogoutButton)
        <button class="border border-white/10 hover:border-red-400/30 hover:text-red-400 px-4 py-2 rounded-xl text-sm transition cursor-pointer" id="logout-btn">Logout</button>
        @endif
    </div>
</header>