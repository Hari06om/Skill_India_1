<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Skill India</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])
</head>

<body class="bg-bg-deep text-[#F0F4FF] min-h-screen font-sans">
    @include('partials.navbar', ['showGuestLinks' => true])

    <main class="flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-[500px] animate-fade-in-up">
            <div class="glass-panel shadow-2xl rounded-2xl p-8 md:p-10 border border-white/5 relative overflow-hidden">
                <!-- Decorative gradient blur -->
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-accent-blue/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-accent-green/10 rounded-full blur-3xl pointer-events-none"></div>

                <h1 class="font-display font-extrabold text-2xl md:text-3xl text-center mb-2 tracking-tight text-[#F0F4FF]">Get Started</h1>
                <p class="text-slate-400 text-center mb-8 text-sm">Create your account in seconds</p>

                <div id="error-msg" class="bg-red-500/10 border border-red-500/20 text-red-400 p-3.5 rounded-xl mb-6 text-sm hidden"></div>

                <form id="register-form" onsubmit="handleRegister(event)" class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Full Name</label>
                            <input type="text" id="name" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] placeholder-slate-600 focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue transition duration-200 text-sm" placeholder="Your name" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Phone</label>
                            <input type="tel" id="phone" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] placeholder-slate-600 focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue transition duration-200 text-sm" placeholder="+91 XXXXX" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Email Address</label>
                        <input type="email" id="email" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] placeholder-slate-600 focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue transition duration-200 text-sm" placeholder="you@example.com" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Password</label>
                        <input type="password" id="password" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] placeholder-slate-600 focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue transition duration-200 text-sm" placeholder="••••••••" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">I am a...</label>
                            <select id="user_type" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue transition duration-200 text-sm cursor-pointer" required>
                                <option value="" class="bg-[#0D1120]">Select role</option>
                                <option value="job_seeker" class="bg-[#0D1120]">Job Seeker</option>
                                <option value="employer" class="bg-[#0D1120]">Employer</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Location</label>
                            <input type="text" id="location" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] placeholder-slate-600 focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue transition duration-200 text-sm" placeholder="Your city" required>
                        </div>
                    </div>

                    <div class="flex items-start gap-2.5 py-1 text-xs text-slate-400">
                        <input type="checkbox" id="agree" class="w-4 h-4 rounded border-white/5 bg-[#0D1120] text-accent-blue focus:ring-0 focus:ring-offset-0 cursor-pointer accent-accent-blue mt-0.5 flex-shrink-0" required>
                        <label class="cursor-pointer select-none leading-relaxed" for="agree">
                            I agree to the <a href="#" class="text-accent-blue hover:underline">Terms of Service</a> and <a href="#" class="text-accent-blue hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-accent-blue hover:bg-[#90cdf4] text-bg-deep font-bold py-3.5 rounded-xl shadow-lg hover:shadow-accent-blue/15 transition-all duration-200 cursor-pointer text-sm" id="submit-btn">
                        Create Account
                    </button>

                    <div class="hidden text-center text-slate-400 text-sm py-2" id="loading">
                        <div class="w-5 h-5 border-2 border-slate-600 border-t-accent-blue rounded-full animate-spin mx-auto mb-2"></div>
                        <div>Creating account...</div>
                    </div>
                </form>

                <p class="text-center text-slate-400 text-sm mt-6">
                    Already have an account? <a href="{{ route('login') }}" class="text-accent-blue hover:underline font-medium">Sign in here</a>
                </p>
            </div>
        </div>
    </main>

    <script>
        async function handleRegister(e) {
            e.preventDefault();
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const password = document.getElementById('password').value;
            const user_type = document.getElementById('user_type').value;
            const location = document.getElementById('location').value;
            const errorMsg = document.getElementById('error-msg');
            const submitBtn = document.getElementById('submit-btn');
            const loading = document.getElementById('loading');

            errorMsg.classList.add('hidden');
            submitBtn.classList.add('hidden');
            loading.classList.remove('hidden');

            try {
                const res = await fetch('/api/auth/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name,
                        email,
                        phone,
                        password,
                        user_type,
                        location
                    })
                });

                const data = await res.json();

                if (res.ok && data.token) {
                    localStorage.setItem('api_token', data.token);
                    localStorage.setItem('user_info', JSON.stringify(data.user));
                    window.location.href = '/dashboard';
                } else {
                    errorMsg.textContent = data.message || 'Registration failed. Please try again.';
                    errorMsg.classList.remove('hidden');
                    submitBtn.classList.remove('hidden');
                    loading.classList.add('hidden');
                }
            } catch (e) {
                errorMsg.textContent = 'Connection error. Please try again.';
                errorMsg.classList.remove('hidden');
                submitBtn.classList.remove('hidden');
                loading.classList.add('hidden');
            }
        }

        // Check if already logged in
        if (localStorage.getItem('api_token')) {
            window.location.href = '/dashboard';
        }
    </script>
</body>

</html>