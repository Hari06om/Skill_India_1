<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coaches - Skill India</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])
</head>

<body class="bg-bg-deep text-[#F0F4FF] font-sans scroll-smooth">
    @include('partials.navbar', ['showGuestLinks' => true])

    <main class="max-w-[1200px] mx-auto px-6 py-16 md:py-20">
        <section class="text-center mb-14">
            <p class="text-xs uppercase tracking-[0.3em] text-accent-blue font-bold mb-3">Coaches</p>
            <h1 class="font-display font-extrabold text-3xl md:text-5xl mb-4">Meet your next mentor</h1>
            <p class="text-slate-400 max-w-2xl mx-auto text-sm md:text-base">Connect with experienced professionals who can guide you through interviews, skill gaps, and career planning.</p>
        </section>

        <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
            <div class="glass-panel rounded-2xl p-6 border border-white/5 text-center">
                <div class="w-14 h-14 bg-gradient-to-br from-accent-blue to-accent-green rounded-full flex items-center justify-center font-bold text-bg-deep text-lg mx-auto mb-4">AM</div>
                <div class="font-display font-semibold text-lg text-white mb-1">Amit Mehta</div>
                <div class="text-sm text-accent-blue mb-2">Full Stack Dev</div>
                <p class="text-slate-400 text-sm leading-relaxed">Guides learners through modern web development, career transitions, and portfolio strategy.</p>
                <div class="mt-4 text-sm text-slate-300">⭐ 4.9 Rating</div>
            </div>
            <div class="glass-panel rounded-2xl p-6 border border-white/5 text-center">
                <div class="w-14 h-14 bg-gradient-to-br from-accent-blue to-accent-green rounded-full flex items-center justify-center font-bold text-bg-deep text-lg mx-auto mb-4">PN</div>
                <div class="font-display font-semibold text-lg text-white mb-1">Priya Nair</div>
                <div class="text-sm text-accent-blue mb-2">AWS Cloud</div>
                <p class="text-slate-400 text-sm leading-relaxed">Helps build cloud fundamentals, system design thinking, and practical DevOps skills.</p>
                <div class="mt-4 text-sm text-slate-300">⭐ 4.8 Rating</div>
            </div>
            <div class="glass-panel rounded-2xl p-6 border border-white/5 text-center">
                <div class="w-14 h-14 bg-gradient-to-br from-accent-blue to-accent-green rounded-full flex items-center justify-center font-bold text-bg-deep text-lg mx-auto mb-4">RK</div>
                <div class="font-display font-semibold text-lg text-white mb-1">Ramesh Kumar</div>
                <div class="text-sm text-accent-blue mb-2">Welding Expert</div>
                <p class="text-slate-400 text-sm leading-relaxed">Specializes in vocational training, hands-on industry skills, and certification preparation.</p>
                <div class="mt-4 text-sm text-slate-300">⭐ 4.7 Rating</div>
            </div>
            <div class="glass-panel rounded-2xl p-6 border border-white/5 text-center">
                <div class="w-14 h-14 bg-gradient-to-br from-accent-blue to-accent-green rounded-full flex items-center justify-center font-bold text-bg-deep text-lg mx-auto mb-4">SP</div>
                <div class="font-display font-semibold text-lg text-white mb-1">Sneha Patil</div>
                <div class="text-sm text-accent-blue mb-2">Soft Skills</div>
                <p class="text-slate-400 text-sm leading-relaxed">Supports communication, confidence building, and interview readiness for professional growth.</p>
                <div class="mt-4 text-sm text-slate-300">⭐ 4.9 Rating</div>
            </div>
            <div class="glass-panel rounded-2xl p-6 border border-white/5 text-center">
                <div class="w-14 h-14 bg-gradient-to-br from-accent-blue to-accent-green rounded-full flex items-center justify-center font-bold text-bg-deep text-lg mx-auto mb-4">VS</div>
                <div class="font-display font-semibold text-lg text-white mb-1">Vijay Sharma</div>
                <div class="text-sm text-accent-blue mb-2">AI & ML Specialist</div>
                <p class="text-slate-400 text-sm leading-relaxed">Offers deep technical coaching in AI, machine learning, and practical project development.</p>
                <div class="mt-4 text-sm text-slate-300">⭐ 5.0 Rating</div>
            </div>
        </section>
    </main>
</body>

</html>