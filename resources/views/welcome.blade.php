<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - Skill India Job Search & Coaching Platform</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])
</head>

<body class="bg-bg-deep text-[#F0F4FF] font-sans scroll-smooth">
    @include('partials.navbar', ['showGuestLinks' => true])

    <!-- Hero Section -->
    <section class="max-w-[1200px] mx-auto px-6 py-20 md:py-32 text-center relative">
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-accent-blue/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/3 left-1/3 w-60 h-60 bg-accent-green/5 rounded-full blur-3xl pointer-events-none"></div>

        <h1 class="font-display font-extrabold text-4xl md:text-6xl tracking-tight mb-6 max-w-4xl mx-auto leading-[1.1] animate-fade-in-up">
            Find Your Next <span class="bg-gradient-to-r from-accent-blue via-[#A0C4FF] to-accent-green bg-clip-text text-transparent">Opportunity</span>
        </h1>
        <p class="text-slate-400 text-base md:text-lg mb-10 max-w-2xl mx-auto font-light leading-relaxed animate-fade-in-up">
            Discover verified jobs, learn in-demand industry skills, and accelerate your career growth with expert coaching on India's premier job search platform.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-24 animate-fade-in-up">
            <a href="{{ route('login') }}" class="w-full sm:w-auto bg-accent-blue hover:bg-[#90cdf4] text-bg-deep font-bold px-8 py-4 rounded-xl shadow-lg hover:shadow-accent-blue/15 transition-all duration-200 text-sm">
                Explore Active Jobs
            </a>
            <a href="{{ route('register') }}" class="w-full sm:w-auto bg-[#161D2E] hover:bg-[#1C2540] text-[#F0F4FF] border border-white/5 hover:border-white/10 font-medium px-8 py-4 rounded-xl transition duration-200 text-sm">
                Book a Skills Coach
            </a>
        </div>
    </section>

    <!-- Highlights Section -->
    <section class="max-w-[1200px] mx-auto px-6 pb-24">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('features') }}" class="glass-panel rounded-2xl p-8 border border-white/5 hover:border-accent-blue/20 transition duration-300 block">
                <p class="text-xs uppercase tracking-[0.3em] text-accent-blue font-bold mb-3">Explore</p>
                <h2 class="font-display font-bold text-2xl md:text-3xl text-[#F0F4FF] mb-3">See all features</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Browse the full toolkit designed to help you discover opportunities, build skills, and track progress.</p>
            </a>
            <a href="{{ route('coaches') }}" class="glass-panel rounded-2xl p-8 border border-white/5 hover:border-accent-blue/20 transition duration-300 block">
                <p class="text-xs uppercase tracking-[0.3em] text-accent-blue font-bold mb-3">Meet the mentors</p>
                <h2 class="font-display font-bold text-2xl md:text-3xl text-[#F0F4FF] mb-3">Visit the coaches page</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Meet the expert coaches behind the platform and learn how they can support your next move.</p>
            </a>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="max-w-[1200px] mx-auto px-6 py-24 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="glass-panel rounded-2xl p-8 text-center border border-white/5">
            <div class="font-display font-extrabold text-4xl text-accent-blue mb-2">5,000+</div>
            <div class="text-slate-400 text-sm">Active Job Listings</div>
        </div>
        <div class="glass-panel rounded-2xl p-8 text-center border border-white/5">
            <div class="font-display font-extrabold text-4xl text-accent-blue mb-2">50K+</div>
            <div class="text-slate-400 text-sm">Registered Seekers</div>
        </div>
        <div class="glass-panel rounded-2xl p-8 text-center border border-white/5">
            <div class="font-display font-extrabold text-4xl text-accent-blue mb-2">2,500+</div>
            <div class="text-slate-400 text-sm">Placements Completed</div>
        </div>
        <div class="glass-panel rounded-2xl p-8 text-center border border-white/5">
            <div class="font-display font-extrabold text-4xl text-accent-blue mb-2">98%</div>
            <div class="text-slate-400 text-sm">Satisfaction Rate</div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#0D1120] border-t border-white/5 py-12 text-center text-slate-500 text-sm">
        <div class="max-w-[1200px] mx-auto px-6">
            <p>&copy; 2026 Skill India Platform. Empowering India's future workforce.</p>
        </div>
    </footer>
</body>

</html>