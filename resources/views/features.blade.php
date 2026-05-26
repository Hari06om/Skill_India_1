<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Features - Skill India</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])
</head>

<body class="bg-bg-deep text-[#F0F4FF] font-sans scroll-smooth">
    @include('partials.navbar', ['showGuestLinks' => true])

    <main class="max-w-[1200px] mx-auto px-6 py-16 md:py-20">
        <section class="text-center mb-14">
            <p class="text-xs uppercase tracking-[0.3em] text-accent-blue font-bold mb-3">Features</p>
            <h1 class="font-display font-extrabold text-3xl md:text-5xl mb-4">Everything you need to grow your career</h1>
            <p class="text-slate-400 max-w-2xl mx-auto text-sm md:text-base">Explore the tools and experiences that make job discovery, skill building, and professional growth simpler.</p>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <div class="glass-panel rounded-2xl p-8 border border-white/5 hover:border-accent-blue/20 transition duration-300">
                <div class="text-3xl mb-4">🔍</div>
                <h2 class="font-display font-semibold text-xl text-[#F0F4FF] mb-2">Advanced Job Search</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Search verified listings with smart filters for location, role type, and experience level.</p>
            </div>
            <div class="glass-panel rounded-2xl p-8 border border-white/5 hover:border-accent-blue/20 transition duration-300">
                <div class="text-3xl mb-4">📚</div>
                <h2 class="font-display font-semibold text-xl text-[#F0F4FF] mb-2">Expert Coaches</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Book tailored coaching sessions for resume reviews, interview prep, and career guidance.</p>
            </div>
            <div class="glass-panel rounded-2xl p-8 border border-white/5 hover:border-accent-blue/20 transition duration-300">
                <div class="text-3xl mb-4">✨</div>
                <h2 class="font-display font-semibold text-xl text-[#F0F4FF] mb-2">Skill Development</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Build high-demand skills with personalized recommendations and practical mentoring.</p>
            </div>
            <div class="glass-panel rounded-2xl p-8 border border-white/5 hover:border-accent-blue/20 transition duration-300">
                <div class="text-3xl mb-4">🎯</div>
                <h2 class="font-display font-semibold text-xl text-[#F0F4FF] mb-2">Smart Matching</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Get matched to opportunities that align with your strengths, skills, and goals.</p>
            </div>
            <div class="glass-panel rounded-2xl p-8 border border-white/5 hover:border-accent-blue/20 transition duration-300">
                <div class="text-3xl mb-4">🚀</div>
                <h2 class="font-display font-semibold text-xl text-[#F0F4FF] mb-2">Profile Builder</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Create a polished professional profile that makes you stand out to employers.</p>
            </div>
            <div class="glass-panel rounded-2xl p-8 border border-white/5 hover:border-accent-blue/20 transition duration-300">
                <div class="text-3xl mb-4">💼</div>
                <h2 class="font-display font-semibold text-xl text-[#F0F4FF] mb-2">Application Tracking</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Track every application status in one place and stay on top of your opportunities.</p>
            </div>
            <div class="glass-panel rounded-2xl p-8 border border-white/5 hover:border-accent-blue/20 transition duration-300">
                <div class="text-3xl mb-4">🧠</div>
                <h2 class="font-display font-semibold text-xl text-[#F0F4FF] mb-2">AI Career Insights</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Get personalized suggestions for upskilling paths, career growth, and opportunities aligned with your profile.</p>
            </div>
            <div class="glass-panel rounded-2xl p-8 border border-white/5 hover:border-accent-blue/20 transition duration-300">
                <div class="text-3xl mb-4">📄</div>
                <h2 class="font-display font-semibold text-xl text-[#F0F4FF] mb-2">Resume & Portfolio Support</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Improve your resume and showcase projects with guided tools and mentor feedback.</p>
            </div>
            <div class="glass-panel rounded-2xl p-8 border border-white/5 hover:border-accent-blue/20 transition duration-300">
                <div class="text-3xl mb-4">🎤</div>
                <h2 class="font-display font-semibold text-xl text-[#F0F4FF] mb-2">Interview Preparation</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Practice commonly asked questions and build confidence with expert-led interview guidance.</p>
            </div>
            <div class="glass-panel rounded-2xl p-8 border border-white/5 hover:border-accent-blue/20 transition duration-300">
                <div class="text-3xl mb-4">🌐</div>
                <h2 class="font-display font-semibold text-xl text-[#F0F4FF] mb-2">Industry Network Access</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Connect with mentors, employers, and training partners across emerging job sectors.</p>
            </div>
            <div class="glass-panel rounded-2xl p-8 border border-white/5 hover:border-accent-blue/20 transition duration-300">
                <div class="text-3xl mb-4">📊</div>
                <h2 class="font-display font-semibold text-xl text-[#F0F4FF] mb-2">Progress Dashboard</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Track applications, course progress, and milestones so you always know where you stand.</p>
            </div>
            <div class="glass-panel rounded-2xl p-8 border border-white/5 hover:border-accent-blue/20 transition duration-300">
                <div class="text-3xl mb-4">🏆</div>
                <h2 class="font-display font-semibold text-xl text-[#F0F4FF] mb-2">Certification Guidance</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Discover the right certifications and training pathways for your target role and industry.</p>
            </div>
        </section>
    </main>
</body>

</html>