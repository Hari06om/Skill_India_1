<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Skill India Job Search</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])
</head>

<body class="bg-bg-deep text-[#F0F4FF] min-h-screen flex flex-col font-sans">
    <!-- Session Loader -->
    <div id="loader" class="fixed inset-0 bg-bg-deep z-[9999] flex flex-col items-center justify-center gap-4 transition-opacity duration-300">
        <div class="w-12 h-12 border-4 border-white/5 border-t-accent-blue rounded-full animate-spin"></div>
        <p class="text-slate-400 text-sm">Verifying session...</p>
    </div>

    @include('partials.navbar', ['showUserBadge' => true, 'showLogoutButton' => true, 'displayName' => 'Loading...'])

    <!-- Main Container -->
    <main class="max-w-[1200px] mx-auto px-6 py-10 w-full flex-grow flex flex-col animate-fade-in-up">
        <div class="mb-8">
            <h1 class="font-display font-extrabold text-3xl md:text-4xl text-[#F0F4FF] mb-2">Namaste, <span id="welcome-name">User</span>!</h1>
            <p class="text-slate-400 font-light text-sm md:text-base" id="user-role-badge">Loading dashboard details...</p>
        </div>

        <!-- Navigation Tabs -->
        <div class="tabs-nav border-b border-white/5 pb-px mb-8 flex items-center gap-2 overflow-x-auto whitespace-nowrap">
            <button class="tab-btn border-b-2 border-transparent px-4 py-3 text-sm font-medium transition cursor-pointer" data-tab="dashboard">Dashboard</button>
            <button class="tab-btn border-b-2 border-transparent px-4 py-3 text-sm font-medium transition cursor-pointer" data-tab="jobs">Job Openings</button>
            <button class="tab-btn border-b-2 border-transparent px-4 py-3 text-sm font-medium transition cursor-pointer" data-tab="trainers">Skills Coaches</button>
        </div>

        <!-- STATS GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8" id="stats-grid-container"></div>

        <!-- TAB CONTENT AREA -->

        <!-- 1. General Dashboard (Job Seeker / Employer dynamic list) -->
        <div id="dashboard-tab" class="tab-content hidden">
            <div class="glass-panel rounded-2xl p-6 md:p-8 border border-white/5 shadow-xl">
                <div class="flex items-center justify-between border-b border-white/5 pb-4 mb-6">
                    <h2 class="font-display font-bold text-xl text-white" id="dashboard-list-title">My Coaching Sessions</h2>
                </div>
                <div id="dashboard-content">
                    <div class="text-center text-slate-500 py-10">Loading statistics...</div>
                </div>
            </div>
        </div>

        <!-- 2. Job Openings Tab (Job Seeker view) -->
        <div id="jobs-tab" class="tab-content hidden">
            <div class="glass-panel rounded-2xl p-6 md:p-8 border border-white/5 shadow-xl">
                <div class="flex items-center justify-between border-b border-white/5 pb-4 mb-6">
                    <h2 class="font-display font-bold text-xl text-white">Discover Job Opportunities</h2>
                </div>

                <!-- Filter Section -->
                <div class="bg-bg-deep/40 border border-white/5 rounded-xl p-5 mb-6 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <input type="text" id="job-keyword" class="bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] placeholder-slate-600 focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue transition duration-200 text-sm" placeholder="Search job title or desc...">
                        <select id="job-location" class="bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue transition duration-200 text-sm cursor-pointer">
                            <option value="">All Locations</option>
                            <option value="bangalore">Bangalore</option>
                            <option value="mumbai">Mumbai</option>
                            <option value="delhi">Delhi</option>
                            <option value="pune">Pune</option>
                            <option value="hyderabad">Hyderabad</option>
                            <option value="remote">Remote</option>
                        </select>
                        <select id="job-type" class="bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue transition duration-200 text-sm cursor-pointer">
                            <option value="">All Job Types</option>
                            <option value="full-time">Full-Time</option>
                            <option value="part-time">Part-Time</option>
                            <option value="contract">Contract</option>
                            <option value="freelance">Freelance</option>
                        </select>
                        <select id="job-experience" class="bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue transition duration-200 text-sm cursor-pointer">
                            <option value="">All Experience Levels</option>
                            <option value="entry">Entry Level</option>
                            <option value="mid">Mid Level</option>
                            <option value="senior">Senior Level</option>
                        </select>
                    </div>
                    <button class="border border-white/10 hover:border-white/20 text-[#F0F4FF] text-xs font-semibold py-2.5 px-4 rounded-xl transition cursor-pointer" onclick="resetJobFilters()">Reset Filters</button>
                </div>

                <!-- Job Postings List -->
                <div id="jobs-list" class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="text-slate-500 text-center py-12 col-span-full">Loading jobs...</div>
                </div>

                <!-- Job Pagination controls -->
                <div id="jobs-pagination"></div>
            </div>
        </div>

        <!-- 3. Skills Coaches Tab (Job Seeker view) -->
        <div id="trainers-tab" class="tab-content hidden">
            <div class="glass-panel rounded-2xl p-6 md:p-8 border border-white/5 shadow-xl">
                <div class="flex items-center justify-between border-b border-white/5 pb-4 mb-6">
                    <h2 class="font-display font-bold text-xl text-white">Expert Career Coaches</h2>
                </div>
                <div id="trainers-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    <div class="text-slate-500 text-center py-12 col-span-full">Loading trainers...</div>
                </div>
            </div>
        </div>

        <!-- 4. My Profile Tab (Job Seeker profile settings) -->
        <div id="profile-tab" class="tab-content hidden">
            <div class="glass-panel rounded-2xl p-6 md:p-8 border border-white/5 shadow-xl">
                <div class="border-b border-white/5 pb-4 mb-6">
                    <h2 class="font-display font-bold text-xl text-white">Manage Professional Profile</h2>
                    <p class="text-xs text-slate-400 mt-1">Update your professional details to let potential employers find you.</p>
                </div>
                <form onsubmit="saveProfile(event)" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Professional Headline</label>
                            <input type="text" id="prof-headline" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue text-sm" placeholder="e.g. Senior Backend Engineer specializing in cloud API design">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Current Job Title</label>
                            <input type="text" id="prof-title" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue text-sm" placeholder="e.g. Software Engineer">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Professional Biography (Bio)</label>
                        <textarea id="prof-bio" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue text-sm min-h-[100px]" placeholder="Tell employers about your experience, achievements, and career goals..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Years of Experience</label>
                            <input type="number" id="prof-exp" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue text-sm" min="0" value="0">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Location</label>
                            <input type="text" id="prof-loc" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue text-sm" placeholder="e.g. Bangalore">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Skills (comma-separated)</label>
                            <input type="text" id="prof-skills" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue text-sm" placeholder="e.g. Laravel, React, Docker">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Portfolio Website URL</label>
                            <input type="url" id="prof-portfolio" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue text-sm" placeholder="https://">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">LinkedIn URL</label>
                            <input type="url" id="prof-linkedin" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue text-sm" placeholder="https://">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">GitHub URL</label>
                            <input type="url" id="prof-github" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue text-sm" placeholder="https://">
                        </div>
                    </div>

                    <button type="submit" class="bg-accent-blue hover:bg-[#90cdf4] text-bg-deep font-bold px-6 py-3 rounded-xl transition duration-200 cursor-pointer text-sm shadow-md">Save Professional Profile</button>
                </form>
            </div>
        </div>

        <!-- 5. My Listings Tab (Employer job manager) -->
        <div id="employer-listings-tab" class="tab-content hidden">
            <div class="glass-panel rounded-2xl p-6 md:p-8 border border-white/5 shadow-xl">
                <div class="flex items-center justify-between border-b border-white/5 pb-4 mb-6">
                    <h2 class="font-display font-bold text-xl text-white">My Job Listings</h2>
                    <button class="bg-accent-blue hover:bg-[#90cdf4] text-bg-deep font-bold text-xs px-4 py-2.5 rounded-xl cursor-pointer transition shadow-md" onclick="openPostJobModal()">Post a Job</button>
                </div>
                <div id="employer-listings-list" class="space-y-4">
                    <div class="text-slate-500 text-center py-12">Loading job listings...</div>
                </div>
            </div>
        </div>

        <!-- 6. Candidates Tab (Employer application review) -->
        <div id="candidates-tab" class="tab-content hidden">
            <div class="glass-panel rounded-2xl p-6 md:p-8 border border-white/5 shadow-xl">
                <div class="flex items-center justify-between border-b border-white/5 pb-4 mb-6">
                    <h2 class="font-display font-bold text-xl text-white">Received Applications</h2>
                </div>
                <div id="candidates-list" class="space-y-5">
                    <div class="text-slate-500 text-center py-12">Loading candidates...</div>
                </div>
            </div>
        </div>

        <!-- 7. Company Settings Tab (Employer settings) -->
        <div id="company-profile-tab" class="tab-content hidden">
            <div class="glass-panel rounded-2xl p-6 md:p-8 border border-white/5 shadow-xl">
                <div class="border-b border-white/5 pb-4 mb-6">
                    <h2 class="font-display font-bold text-xl text-white">Company Profile Settings</h2>
                    <p class="text-xs text-slate-400 mt-1">Configure the company information shown on your job postings.</p>
                </div>
                <form onsubmit="saveCompanyProfile(event)" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Company Name</label>
                            <input type="text" id="comp-name" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue text-sm" placeholder="e.g. Acme Tech Corporation" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Company Head Office Location</label>
                            <input type="text" id="comp-loc" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue text-sm" placeholder="e.g. Bangalore, India" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Company Biography (Description)</label>
                        <textarea id="comp-bio" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue text-sm min-h-[120px]" placeholder="Introduce your company, values, tech stack, and workplace environment..."></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Contact Number</label>
                        <input type="tel" id="comp-phone" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] focus:outline-none focus:border-accent-blue text-sm placeholder-slate-600" placeholder="+91 XXXXX">
                    </div>

                    <button type="submit" class="bg-accent-blue hover:bg-[#90cdf4] text-bg-deep font-bold px-6 py-3 rounded-xl transition duration-200 cursor-pointer text-sm shadow-md">Save Company Profile</button>
                </form>
            </div>
        </div>

    </main>

    <!-- Native HTML5 Dialog Overlays -->

    <!-- Job Details Modal -->
    <dialog id="job-modal" class="glass-panel text-[#F0F4FF] rounded-2xl border border-white/5 max-w-lg w-full p-8 shadow-2xl">
        <div class="flex justify-between items-center border-b border-white/5 pb-4 mb-6">
            <h2 class="font-display font-bold text-xl text-[#F0F4FF]" id="job-title">Job Details</h2>
            <button class="text-slate-400 hover:text-white text-xl cursor-pointer" onclick="closeModal('job-modal')">×</button>
        </div>
        <div id="job-details" class="space-y-4"></div>
    </dialog>

    <!-- Book Appointment Modal -->
    <dialog id="appointment-modal" class="glass-panel text-[#F0F4FF] rounded-2xl border border-white/5 max-w-lg w-full p-8 shadow-2xl">
        <div class="flex justify-between items-center border-b border-white/5 pb-4 mb-6">
            <h2 class="font-display font-bold text-xl text-[#F0F4FF]">Book Coaching Session</h2>
            <button class="text-slate-400 hover:text-white text-xl cursor-pointer" onclick="closeModal('appointment-modal')">×</button>
        </div>
        <form id="appt-form" onsubmit="submitBooking(event)" class="space-y-5">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Coach</label>
                <input type="text" id="appt-trainer" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-slate-400 text-sm focus:outline-none" readonly>
                <input type="hidden" id="appt-trainer-id">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Date & Time</label>
                <input type="datetime-local" id="appt-datetime" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] text-sm focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue" required>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Learning Goals</label>
                <textarea id="appt-goals" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] text-sm focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue min-h-[100px] resize-y" placeholder="What do you want to learn in this session?" required></textarea>
            </div>
            <button type="submit" class="w-full bg-accent-blue hover:bg-[#90cdf4] text-bg-deep font-bold py-3.5 rounded-xl transition duration-200 cursor-pointer text-sm shadow-md hover:shadow-accent-blue/10">Confirm Booking</button>
        </form>
    </dialog>

    <!-- Apply Job Modal -->
    <dialog id="apply-modal" class="glass-panel text-[#F0F4FF] rounded-2xl border border-white/5 max-w-lg w-full p-8 shadow-2xl">
        <div class="flex justify-between items-center border-b border-white/5 pb-4 mb-6">
            <h2 class="font-display font-bold text-xl text-[#F0F4FF]">Apply for Job</h2>
            <button class="text-slate-400 hover:text-white text-xl cursor-pointer" onclick="closeModal('apply-modal')">×</button>
        </div>
        <form id="apply-form" onsubmit="submitApplication(event)" class="space-y-5">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Job Title</label>
                <input type="text" id="apply-job-title" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-slate-400 text-sm focus:outline-none" readonly>
                <input type="hidden" id="apply-job-id">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Cover Letter</label>
                <textarea id="apply-letter" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-3 text-[#F0F4FF] text-sm focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue min-h-[120px] resize-y" placeholder="Briefly describe why you are a good fit for this role..." required></textarea>
            </div>
            <button type="submit" class="w-full bg-accent-blue hover:bg-[#90cdf4] text-bg-deep font-bold py-3.5 rounded-xl transition duration-200 cursor-pointer text-sm shadow-md hover:shadow-accent-blue/10">Submit Application</button>
        </form>
    </dialog>

    <!-- Post / Edit Job Modal (Employer only) -->
    <dialog id="post-job-modal" class="glass-panel text-[#F0F4FF] rounded-2xl border border-white/5 max-w-lg w-full p-8 shadow-2xl">
        <div class="flex justify-between items-center border-b border-white/5 pb-4 mb-6">
            <h2 class="font-display font-bold text-xl text-[#F0F4FF]" id="post-job-modal-title">Post a New Job</h2>
            <button class="text-slate-400 hover:text-white text-xl cursor-pointer" onclick="closeModal('post-job-modal')">×</button>
        </div>
        <form id="post-job-form" onsubmit="submitJob(event)" class="space-y-4">
            <input type="hidden" id="post-job-id">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Job Title</label>
                <input type="text" id="post-job-title" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-2.5 text-[#F0F4FF] text-sm focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue" placeholder="e.g. Senior Laravel Engineer" required>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Description</label>
                <textarea id="post-job-desc" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-2.5 text-[#F0F4FF] text-sm focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue min-h-[80px]" placeholder="Job duties, requirements..." required></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Location</label>
                    <input type="text" id="post-job-loc" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-2.5 text-[#F0F4FF] text-sm focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue" placeholder="e.g. Bangalore, Remote" required>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Job Type</label>
                    <select id="post-job-type" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-2.5 text-[#F0F4FF] text-sm focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue" required>
                        <option value="full-time">Full-Time</option>
                        <option value="part-time">Part-Time</option>
                        <option value="contract">Contract</option>
                        <option value="freelance">Freelance</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Salary Range</label>
                    <input type="text" id="post-job-salary" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-2.5 text-[#F0F4FF] text-sm focus:outline-none focus:border-accent-blue focus:ring-1 focus:ring-accent-blue" placeholder="e.g. ₹6,00,000 - ₹9,00,000">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Experience Level</label>
                    <select id="post-job-exp" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-2.5 text-[#F0F4FF] text-sm focus:outline-none focus:border-accent-blue" required>
                        <option value="entry">Entry</option>
                        <option value="mid">Mid</option>
                        <option value="senior">Senior</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Skills (comma-separated)</label>
                    <input type="text" id="post-job-skills" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-2.5 text-[#F0F4FF] text-sm focus:outline-none focus:border-accent-blue" placeholder="PHP, Laravel, Git">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Positions</label>
                    <input type="number" id="post-job-positions" class="w-full bg-[#0D1120] border border-white/5 rounded-xl px-4 py-2.5 text-[#F0F4FF] text-sm focus:outline-none focus:border-accent-blue" value="1" min="1">
                </div>
            </div>
            <button type="submit" class="w-full bg-accent-blue hover:bg-[#90cdf4] text-bg-deep font-bold py-3 rounded-xl transition duration-200 cursor-pointer text-sm shadow-md hover:shadow-accent-blue/10">Save Listing</button>
        </form>
    </dialog>

    <!-- Floating Toast Container -->
    <div id="toast-container" class="fixed bottom-6 right-6 z-50 flex flex-col gap-3"></div>

    <script>
        const TOKEN = localStorage.getItem('api_token');
        const API = '/api';
        let currentUser = null;
        let currentJobPage = 1;
        let totalJobPages = 1;

        // Toast feedback notifier
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `p-4 rounded-xl shadow-xl flex items-center justify-between text-sm glass-panel border border-white/5 animate-toast ${
                type === 'success' ? 'text-accent-green' : 'text-red-400'
            }`;
            toast.innerHTML = `
                <span class="font-medium mr-4">${message}</span>
                <button class="hover:text-white cursor-pointer text-base" onclick="this.parentElement.remove()">×</button>
            `;
            container.appendChild(toast);
            setTimeout(() => {
                toast.remove();
            }, 4000);
        }

        // Native Dialog controllers
        function openModal(id) {
            const modal = document.getElementById(id);
            if (modal && typeof modal.showModal === 'function') {
                modal.showModal();
            } else if (modal) {
                modal.classList.add('active'); // fallback
            }
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal && typeof modal.close === 'function') {
                modal.close();
            } else if (modal) {
                modal.classList.remove('active'); // fallback
            }
        }

        document.addEventListener('DOMContentLoaded', async () => {
            const loader = document.getElementById('loader');
            if (!TOKEN) {
                window.location.href = '/login';
                return;
            }

            try {
                const res = await fetch(`${API}/auth/profile`, {
                    headers: {
                        'Authorization': `Bearer ${TOKEN}`
                    }
                });
                if (res.ok) {
                    const user = await res.json();
                    setupDashboard(user);
                    loader.style.opacity = '0';
                    setTimeout(() => loader.style.display = 'none', 400);
                } else {
                    localStorage.removeItem('api_token');
                    window.location.href = '/login';
                }
            } catch (e) {
                loader.innerHTML = `<div style="text-align: center; color: #FC8181;"><h3 class="font-display font-bold text-lg mb-2">Connection Error</h3><button onclick="window.location.reload()" class="bg-accent-blue hover:bg-[#90cdf4] text-bg-deep font-bold px-4 py-2 rounded-xl text-sm transition">Retry</button></div>`;
            }
        });

        document.getElementById('logout-btn').addEventListener('click', async () => {
            try {
                await fetch(`${API}/auth/logout`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${TOKEN}`
                    }
                });
            } catch (e) {}
            localStorage.removeItem('api_token');
            localStorage.removeItem('user_info');
            window.location.href = '/login';
        });

        // Set up the dynamic layout and navigation tabs based on user role
        function setupDashboard(user) {
            currentUser = user;
            document.getElementById('user-display-name').textContent = user.company_name || user.name;
            document.getElementById('welcome-name').textContent = user.name;

            const navContainer = document.querySelector('.tabs-nav');
            if (user.user_type === 'job_seeker') {
                document.getElementById('user-role-badge').textContent = 'Job Seeker • Find opportunities and book coaches';

                navContainer.innerHTML = `
                    <button class="tab-btn active text-accent-blue border-accent-blue border-b-2" data-tab="dashboard">Dashboard</button>
                    <button class="tab-btn text-slate-400 hover:text-slate-200" data-tab="jobs">Job Openings</button>
                    <button class="tab-btn text-slate-400 hover:text-slate-200" data-tab="trainers">Skills Coaches</button>
                    <button class="tab-btn text-slate-400 hover:text-slate-200" data-tab="profile">My Profile</button>
                `;

                document.getElementById('stats-grid-container').innerHTML = `
                    <div class="glass-panel rounded-2xl p-6 border border-white/5 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-1.5 h-full bg-accent-blue"></div>
                        <div class="text-[10px] uppercase font-bold tracking-wider text-slate-400 mb-2">My Applications</div>
                        <div class="font-display font-extrabold text-3xl" id="app-count">0</div>
                    </div>
                    <div class="glass-panel rounded-2xl p-6 border border-white/5 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-1.5 h-full bg-accent-green"></div>
                        <div class="text-[10px] uppercase font-bold tracking-wider text-slate-400 mb-2">Coached Hours</div>
                        <div class="font-display font-extrabold text-3xl">0</div>
                    </div>
                    <div class="glass-panel rounded-2xl p-6 border border-white/5 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-1.5 h-full bg-accent-blue"></div>
                        <div class="text-[10px] uppercase font-bold tracking-wider text-slate-400 mb-2">Active Bookings</div>
                        <div class="font-display font-extrabold text-3xl" id="book-count">0</div>
                    </div>
                `;

                document.getElementById('dashboard-list-title').textContent = 'My Coaching Sessions';

                loadDashData();
            } else if (user.user_type === 'employer') {
                document.getElementById('user-role-badge').textContent = 'Employer • Post jobs and manage candidate applications';

                navContainer.innerHTML = `
                    <button class="tab-btn active text-accent-blue border-accent-blue border-b-2" data-tab="dashboard">Dashboard</button>
                    <button class="tab-btn text-slate-400 hover:text-slate-200" data-tab="employer-listings">My Job Listings</button>
                    <button class="tab-btn text-slate-400 hover:text-slate-200" data-tab="candidates">Candidates</button>
                    <button class="tab-btn text-slate-400 hover:text-slate-200" data-tab="company-profile">Company Profile</button>
                `;

                document.getElementById('stats-grid-container').innerHTML = `
                    <div class="glass-panel rounded-2xl p-6 border border-white/5 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-1.5 h-full bg-accent-blue"></div>
                        <div class="text-[10px] uppercase font-bold tracking-wider text-slate-400 mb-2">Jobs Posted</div>
                        <div class="font-display font-extrabold text-3xl" id="posted-jobs-count">0</div>
                    </div>
                    <div class="glass-panel rounded-2xl p-6 border border-white/5 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-1.5 h-full bg-accent-green"></div>
                        <div class="text-[10px] uppercase font-bold tracking-wider text-slate-400 mb-2">Applications Received</div>
                        <div class="font-display font-extrabold text-3xl" id="received-apps-count">0</div>
                    </div>
                `;

                document.getElementById('dashboard-list-title').textContent = 'Recent Candidate Submissions';

                loadEmployerDashData();
            }

            // Setup tab switching triggers
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.tab-btn').forEach(b => {
                        b.className = 'tab-btn border-b-2 border-transparent px-4 py-3 text-sm font-medium transition cursor-pointer text-slate-400 hover:text-slate-200';
                    });
                    document.querySelectorAll('.tab-content').forEach(t => t.classList.add('hidden'));

                    this.className = 'tab-btn border-b-2 border-accent-blue px-4 py-3 text-sm font-medium transition cursor-pointer text-accent-blue';

                    const tabName = this.getAttribute('data-tab');
                    document.getElementById(tabName + '-tab').classList.remove('hidden');

                    if (tabName === 'jobs') loadJobs();
                    else if (tabName === 'trainers') loadTrainers();
                    else if (tabName === 'profile') loadProfileForm();
                    else if (tabName === 'employer-listings') loadEmployerListings();
                    else if (tabName === 'candidates') loadCandidates();
                    else if (tabName === 'company-profile') loadCompanyProfileForm();
                    else if (tabName === 'dashboard') {
                        if (currentUser.user_type === 'employer') loadEmployerDashData();
                        else loadDashData();
                    }
                });
            });

            // Set dashboard active initial state
            document.getElementById('dashboard-tab').classList.remove('hidden');
        }

        // ================= JOB SEEKER ACTIONS =================

        async function loadDashData() {
            try {
                const [apps, apts] = await Promise.all([
                    fetch(`${API}/applications`, {
                        headers: {
                            'Authorization': `Bearer ${TOKEN}`
                        }
                    }),
                    fetch(`${API}/appointments`, {
                        headers: {
                            'Authorization': `Bearer ${TOKEN}`
                        }
                    })
                ]);

                if (apps.ok) {
                    const data = await apps.json();
                    // Fix: data.data is a paginated object, actual counts in data.data.total
                    document.getElementById('app-count').textContent = data.data.total || 0;
                }

                if (apts.ok) {
                    const data = await apts.json();
                    const list = data.data || [];
                    document.getElementById('book-count').textContent = list.length;

                    let html = list.length ? '<div class="space-y-4">' : '<div class="empty-state"><div class="empty-icon">📅</div><h3 class="empty-title">No Coaching Bookings</h3><p class="empty-desc">Find and book an expert coach under the Skills Coaches tab.</p></div>';
                    list.forEach(a => {
                        const d = new Date(a.scheduled_at).toLocaleDateString();
                        const time = new Date(a.scheduled_at).toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        html += `
                            <div class="glass-panel rounded-xl p-5 border border-white/5 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div>
                                    <div class="font-semibold text-white text-base">${a.trainer.name}</div>
                                    <div class="text-xs text-accent-blue font-medium mb-1">${a.trainer.expert_skill}</div>
                                    <div class="text-xs text-slate-400">Scheduled: <span class="text-slate-300 font-medium">${d} at ${time}</span></div>
                                    <div class="text-xs text-slate-500 mt-2">Goals: "${a.learning_goals}"</div>
                                </div>
                                <div>
                                    <span class="badge ${a.status === 'confirmed' ? 'green' : a.status === 'cancelled' ? 'red' : ''} text-xs">${a.status}</span>
                                </div>
                            </div>
                        `;
                    });
                    if (list.length) html += '</div>';
                    document.getElementById('dashboard-content').innerHTML = html;
                }
            } catch (e) {
                console.error(e);
            }
        }

        async function loadJobs() {
            const kw = document.getElementById('job-keyword').value;
            const loc = document.getElementById('job-location').value;
            const type = document.getElementById('job-type').value;
            const exp = document.getElementById('job-experience').value;

            let url = `${API}/jobs`;
            const params = [`page=${currentJobPage}`];
            if (kw) params.push(`keyword=${encodeURIComponent(kw)}`);
            if (loc) params.push(`location=${encodeURIComponent(loc)}`);
            if (type) params.push(`job_type=${encodeURIComponent(type)}`);
            if (exp) params.push(`experience_level=${encodeURIComponent(exp)}`);

            // Fix: jobs index endpoint does not filter correctly, use /search when filtering
            if (kw || loc || type || exp) {
                url += '/search?' + params.join('&');
            } else {
                url += '?' + params.join('&');
            }

            try {
                const res = await fetch(url, {
                    headers: {
                        'Authorization': `Bearer ${TOKEN}`
                    }
                });
                if (res.ok) {
                    const data = await res.json();
                    const pagination = data.data || {};
                    totalJobPages = pagination.last_page || 1;
                    // Fix: data.data is a pagination object, we need pagination.data for the jobs array
                    renderJobs(pagination.data || []);
                    renderPagination();
                }
            } catch (e) {
                console.error(e);
            }
        }

        function renderJobs(jobs) {
            const c = document.getElementById('jobs-list');
            if (!jobs.length) {
                c.innerHTML = '<div class="empty-state col-span-full"><div class="empty-icon">🔍</div><h3 class="empty-title">No Jobs Found</h3><p class="empty-desc">Try resetting your filters or adjusting your keywords.</p></div>';
                return;
            }
            c.innerHTML = jobs.map(j => `
                <div class="glass-panel rounded-2xl p-6 border border-white/5 flex flex-col justify-between hover:border-accent-blue/20 hover:shadow-lg hover:shadow-accent-blue/5 transition duration-300">
                    <div>
                        <div class="font-display font-bold text-lg text-white mb-0.5">${j.title}</div>
                        <div class="text-sm text-slate-400 mb-3">${j.employer ? j.employer.company_name : 'Company'}</div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            ${j.job_type ? `<span class="badge">${j.job_type}</span>` : ''}
                            ${j.experience_level ? `<span class="badge">${j.experience_level}</span>` : ''}
                            ${j.location ? `<span class="badge green">📍 ${j.location}</span>` : ''}
                        </div>
                        <div class="text-slate-400 text-xs leading-relaxed mb-4">${(j.description || '').substring(0, 110)}...</div>
                    </div>
                    <div class="flex items-center justify-between pt-4 border-t border-white/5">
                        <div class="text-sm font-bold text-accent-green">${j.salary_range || '₹ Negotiable'}</div>
                        <div class="flex items-center gap-2">
                            <button class="border border-white/10 hover:border-white/20 text-[#F0F4FF] text-xs px-3.5 py-2 rounded-xl cursor-pointer transition" onclick="viewJob(${j.id})">Details</button>
                            <button class="bg-accent-blue hover:bg-[#90cdf4] text-bg-deep font-bold text-xs px-3.5 py-2 rounded-xl cursor-pointer transition shadow-md" onclick="openApply(${j.id}, '${j.title.replace(/'/g, "\\'")}')">Apply</button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function renderPagination() {
            const container = document.getElementById('jobs-pagination');
            if (!container) return;

            if (totalJobPages <= 1) {
                container.innerHTML = '';
                return;
            }

            container.innerHTML = `
                <div class="flex items-center justify-center gap-4 mt-8 border-t border-white/5 pt-6">
                    <button class="border border-white/10 hover:border-white/20 text-[#F0F4FF] text-xs font-semibold px-4 py-2 rounded-xl disabled:opacity-30 disabled:pointer-events-none transition cursor-pointer" onclick="changeJobPage(-1)" ${currentJobPage === 1 ? 'disabled' : ''}>
                        Previous
                    </button>
                    <span class="text-xs text-slate-400">Page ${currentJobPage} of ${totalJobPages}</span>
                    <button class="border border-white/10 hover:border-white/20 text-[#F0F4FF] text-xs font-semibold px-4 py-2 rounded-xl disabled:opacity-30 disabled:pointer-events-none transition cursor-pointer" onclick="changeJobPage(1)" ${currentJobPage === totalJobPages ? 'disabled' : ''}>
                        Next
                    </button>
                </div>
            `;
        }

        function changeJobPage(direction) {
            currentJobPage += direction;
            loadJobs();
        }

        function resetJobFilters() {
            document.getElementById('job-keyword').value = '';
            document.getElementById('job-location').value = '';
            document.getElementById('job-type').value = '';
            document.getElementById('job-experience').value = '';
            currentJobPage = 1;
            loadJobs();
        }

        let searchT;
        document.getElementById('job-keyword').addEventListener('input', () => {
            clearTimeout(searchT);
            searchT = setTimeout(() => {
                currentJobPage = 1;
                loadJobs();
            }, 300);
        });
        document.getElementById('job-location').addEventListener('change', () => {
            currentJobPage = 1;
            loadJobs();
        });
        document.getElementById('job-type').addEventListener('change', () => {
            currentJobPage = 1;
            loadJobs();
        });
        document.getElementById('job-experience').addEventListener('change', () => {
            currentJobPage = 1;
            loadJobs();
        });

        async function viewJob(id) {
            try {
                const res = await fetch(`${API}/jobs/${id}`);
                if (res.ok) {
                    const data = await res.json();
                    const j = data.data;
                    document.getElementById('job-title').textContent = j.title;

                    let skillsHtml = '';
                    if (j.required_skills && j.required_skills.length) {
                        skillsHtml = `
                            <div class="my-4">
                                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Required Skills</h4>
                                <div class="flex flex-wrap gap-2">${j.required_skills.map(s => `<span class="badge">${s}</span>`).join('')}</div>
                            </div>
                        `;
                    }

                    document.getElementById('job-details').innerHTML = `
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-0.5">Company</h4>
                                <p class="text-white text-base font-semibold">${j.employer ? j.employer.company_name : 'Company Name'}</p>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-0.5">Location</h4>
                                <p class="text-slate-300 text-sm">📍 ${j.location} (${j.job_type})</p>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5">Description</h4>
                                <p class="text-slate-300 text-sm leading-relaxed whitespace-pre-line">${j.description}</p>
                            </div>
                            ${skillsHtml}
                            <div class="grid grid-cols-2 gap-4 border-t border-white/5 pt-4">
                                <div>
                                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-0.5">Salary Offer</h4>
                                    <p class="text-accent-green font-bold text-sm">${j.salary_range || '₹ Negotiable'}</p>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-0.5">Experience Level</h4>
                                    <p class="text-white font-medium text-sm capitalize">${j.experience_level || 'entry'}</p>
                                </div>
                            </div>
                            <button class="w-full bg-accent-blue hover:bg-[#90cdf4] text-bg-deep font-bold py-3.5 rounded-xl transition duration-200 mt-6 cursor-pointer text-sm shadow-md" onclick="openApply(${j.id}, '${j.title.replace(/'/g, "\\'")}'); closeModal('job-modal');">Apply Now</button>
                        </div>
                    `;
                    openModal('job-modal');
                }
            } catch (e) {
                showToast('Failed to load job details', 'error');
            }
        }

        function openApply(id, title) {
            document.getElementById('apply-job-id').value = id;
            document.getElementById('apply-job-title').value = title;
            document.getElementById('apply-letter').value = '';
            openModal('apply-modal');
        }

        async function submitApplication(e) {
            e.preventDefault();
            try {
                const res = await fetch(`${API}/applications`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${TOKEN}`,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        job_id: document.getElementById('apply-job-id').value,
                        cover_letter: document.getElementById('apply-letter').value
                    })
                });

                const data = await res.json();

                if (res.ok) {
                    closeModal('apply-modal');
                    showToast('Applied successfully!');
                    loadJobs();
                    loadDashData();
                } else {
                    showToast(data.message || 'Failed to submit application', 'error');
                }
            } catch (e) {
                showToast('Connection error', 'error');
            }
        }

        async function loadTrainers() {
            try {
                const res = await fetch(`${API}/trainers`, {
                    headers: {
                        'Authorization': `Bearer ${TOKEN}`
                    }
                });
                if (res.ok) {
                    const data = await res.json();
                    renderTrainers(data.data || []);
                }
            } catch (e) {
                console.error(e);
            }
        }

        function renderTrainers(trainers) {
            const c = document.getElementById('trainers-list');
            if (!trainers.length) {
                c.innerHTML = '<div class="empty-state col-span-full"><div class="empty-icon">👨‍🏫</div><h3 class="empty-title">No Coaches Available</h3></div>';
                return;
            }
            c.innerHTML = trainers.map(t => `
                <div class="glass-panel rounded-2xl p-6 border border-white/5 text-center flex flex-col justify-between hover:border-accent-blue/25 transition duration-300">
                    <div>
                        <div class="w-14 h-14 bg-gradient-to-br from-accent-blue to-accent-green rounded-full flex items-center justify-center font-bold text-bg-deep text-lg mx-auto mb-4">${t.avatar_char}</div>
                        <div class="font-display font-semibold text-white text-base mb-1">${t.name}</div>
                        <div class="text-xs text-accent-blue font-medium mb-3">${t.expert_skill}</div>
                        <div class="text-xs text-slate-400 mb-3">⭐ ${t.rating} rating</div>
                        <p class="text-xs text-slate-400 leading-relaxed mb-4 font-light">${t.bio}</p>
                    </div>
                    <div>
                        <div class="text-[10px] text-slate-500 mb-1">⏰ ${t.availability}</div>
                        <div class="text-sm font-bold text-accent-green mb-4">₹${t.hourly_rate} / hr</div>
                        <button class="w-full bg-accent-blue hover:bg-[#90cdf4] text-bg-deep font-bold py-2.5 rounded-xl transition duration-200 cursor-pointer text-xs shadow-md" onclick="openAppt(${t.id}, '${t.name.replace(/'/g, "\\'")}')">Book Coach</button>
                    </div>
                </div>
            `).join('');
        }

        function openAppt(id, name) {
            document.getElementById('appt-trainer-id').value = id;
            document.getElementById('appt-trainer').value = name;
            document.getElementById('appt-datetime').value = '';
            document.getElementById('appt-goals').value = '';
            openModal('appointment-modal');
        }

        async function submitBooking(e) {
            e.preventDefault();

            // Format datetime correctly as: Y-m-d H:i (e.g. 2026-05-24 14:30)
            const rawVal = document.getElementById('appt-datetime').value;
            const formattedDate = rawVal.replace('T', ' ');

            try {
                const res = await fetch(`${API}/appointments`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${TOKEN}`,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        trainer_id: document.getElementById('appt-trainer-id').value,
                        scheduled_at: formattedDate,
                        learning_goals: document.getElementById('appt-goals').value
                    })
                });

                const data = await res.json();

                if (res.ok) {
                    closeModal('appointment-modal');
                    showToast('Coaching appointment booked successfully!');
                    loadDashData();
                } else {
                    showToast(data.message || 'Failed to book appointment', 'error');
                }
            } catch (e) {
                showToast('Connection error', 'error');
            }
        }

        function loadProfileForm() {
            const prof = currentUser.professional || {};
            document.getElementById('prof-headline').value = prof.headline || '';
            document.getElementById('prof-title').value = prof.current_title || '';
            document.getElementById('prof-bio').value = prof.bio || currentUser.bio || '';
            document.getElementById('prof-exp').value = prof.experience_years || 0;
            document.getElementById('prof-loc').value = prof.location || currentUser.location || '';
            document.getElementById('prof-skills').value = (prof.skills || []).join(', ');
            document.getElementById('prof-portfolio').value = prof.portfolio_url || '';
            document.getElementById('prof-linkedin').value = prof.linkedin_url || '';
            document.getElementById('prof-github').value = prof.github_url || '';
        }

        async function saveProfile(e) {
            e.preventDefault();
            const headline = document.getElementById('prof-headline').value;
            const current_title = document.getElementById('prof-title').value;
            const bio = document.getElementById('prof-bio').value;
            const experience_years = parseInt(document.getElementById('prof-exp').value) || 0;
            const location = document.getElementById('prof-loc').value;
            const skillsString = document.getElementById('prof-skills').value;
            const skills = skillsString ? skillsString.split(',').map(s => s.trim()).filter(Boolean) : [];
            const portfolio_url = document.getElementById('prof-portfolio').value;
            const linkedin_url = document.getElementById('prof-linkedin').value;
            const github_url = document.getElementById('prof-github').value;

            try {
                // 1. Update basic user fields
                const userRes = await fetch(`${API}/auth/profile`, {
                    method: 'PUT',
                    headers: {
                        'Authorization': `Bearer ${TOKEN}`,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: currentUser.name,
                        phone: currentUser.phone,
                        bio,
                        location
                    })
                });

                // 2. Create / Update professional details
                const profRes = await fetch(`${API}/professionals`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${TOKEN}`,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        headline,
                        current_title,
                        bio,
                        experience_years,
                        location,
                        skills,
                        portfolio_url: portfolio_url || undefined,
                        linkedin_url: linkedin_url || undefined,
                        github_url: github_url || undefined
                    })
                });

                if (userRes.ok && profRes.ok) {
                    // Refresh profile
                    const profileRes = await fetch(`${API}/auth/profile`, {
                        headers: {
                            'Authorization': `Bearer ${TOKEN}`
                        }
                    });
                    if (profileRes.ok) {
                        currentUser = await profileRes.json();
                    }
                    showToast('Professional profile saved successfully!');
                } else {
                    showToast('Failed to save profile. Check fields.', 'error');
                }
            } catch (e) {
                showToast('Connection error', 'error');
            }
        }


        // ================= EMPLOYER ACTIONS =================

        async function loadEmployerDashData() {
            try {
                const [jobsRes, appsRes] = await Promise.all([
                    fetch(`${API}/jobs/employer/listings`, {
                        headers: {
                            'Authorization': `Bearer ${TOKEN}`
                        }
                    }),
                    fetch(`${API}/applications`, {
                        headers: {
                            'Authorization': `Bearer ${TOKEN}`
                        }
                    })
                ]);

                if (jobsRes.ok) {
                    const data = await jobsRes.json();
                    document.getElementById('posted-jobs-count').textContent = data.data.total || 0;
                }

                if (appsRes.ok) {
                    const data = await appsRes.json();
                    const list = data.data.data || [];
                    document.getElementById('received-apps-count').textContent = data.data.total || 0;

                    let html = list.length ? '<div class="space-y-4">' : '<div class="empty-state"><div class="empty-icon">📂</div><h3 class="empty-title">No Candidate Submissions</h3><p class="empty-desc">When candidates apply to your jobs, they will show up here.</p></div>';
                    list.slice(0, 5).forEach(a => {
                        const d = new Date(a.applied_at).toLocaleDateString();
                        html += `
                            <div class="glass-panel rounded-xl p-5 border border-white/5 flex items-center justify-between gap-4">
                                <div>
                                    <div class="font-semibold text-white text-base">${a.user ? a.user.name : 'Job Seeker'}</div>
                                    <div class="text-xs text-slate-400">Applied for <span class="text-accent-blue font-medium">${a.job.title}</span> on ${d}</div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="badge ${a.status === 'accepted' || a.status === 'shortlisted' ? 'green' : a.status === 'rejected' ? 'red' : ''} text-xs">${a.status}</span>
                                    <button class="border border-white/10 hover:border-white/20 text-[#F0F4FF] text-xs px-3 py-1.5 rounded-lg cursor-pointer transition" onclick="viewCandidate(${a.id})">Details</button>
                                </div>
                            </div>
                        `;
                    });
                    if (list.length) html += '</div>';
                    document.getElementById('dashboard-content').innerHTML = html;
                }
            } catch (e) {
                console.error(e);
            }
        }

        async function loadEmployerListings() {
            try {
                const res = await fetch(`${API}/jobs/employer/listings`, {
                    headers: {
                        'Authorization': `Bearer ${TOKEN}`
                    }
                });
                if (res.ok) {
                    const data = await res.json();
                    renderEmployerListings(data.data.data || []);
                }
            } catch (e) {
                console.error(e);
            }
        }

        function renderEmployerListings(jobs) {
            const c = document.getElementById('employer-listings-list');
            if (!jobs.length) {
                c.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-icon">💼</div>
                        <h3 class="empty-title">No Jobs Posted</h3>
                        <p class="empty-desc mb-5">Start by posting your first job listing to get applications.</p>
                        <button class="bg-accent-blue hover:bg-[#90cdf4] text-bg-deep font-bold text-xs px-5 py-3 rounded-xl cursor-pointer transition shadow-md mx-auto" onclick="openPostJobModal()">Post a Job</button>
                    </div>
                `;
                return;
            }
            c.innerHTML = jobs.map(j => `
                <div class="glass-panel rounded-xl p-5 border border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2.5 mb-1.5">
                            <span class="font-semibold text-white text-base">${j.title}</span>
                            <span class="badge ${j.is_active ? 'green' : 'red'} text-[9px] px-2 py-0.5">${j.is_active ? 'Active' : 'Inactive'}</span>
                        </div>
                        <div class="text-xs text-slate-400 flex flex-wrap gap-x-4 gap-y-1">
                            <span>📍 ${j.location}</span>
                            <span>💼 ${j.job_type}</span>
                            <span>💰 ${j.salary_range || '₹ Negotiable'}</span>
                            <span>👥 ${j.applications_count || 0} Applicants</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="border border-white/10 hover:border-white/20 text-[#F0F4FF] text-xs px-3.5 py-2 rounded-xl cursor-pointer transition" onclick="toggleJobStatus(${j.id}, ${j.is_active})">
                            ${j.is_active ? 'Deactivate' : 'Activate'}
                        </button>
                        <button class="border border-white/10 hover:border-white/20 text-[#F0F4FF] text-xs px-3.5 py-2 rounded-xl cursor-pointer transition" onclick="openEditJobModal(${j.id})">
                            Edit
                        </button>
                        <button class="bg-red-500/10 hover:bg-red-500/25 border border-red-500/20 text-red-400 text-xs px-3.5 py-2 rounded-xl cursor-pointer transition" onclick="deleteJobListing(${j.id})">
                            Delete
                        </button>
                    </div>
                </div>
            `).join('');
        }

        async function toggleJobStatus(id, currentStatus) {
            try {
                const res = await fetch(`${API}/jobs/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Authorization': `Bearer ${TOKEN}`,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        is_active: !currentStatus
                    })
                });
                if (res.ok) {
                    showToast('Job status updated successfully!');
                    loadEmployerListings();
                } else {
                    showToast('Failed to update status', 'error');
                }
            } catch (e) {
                showToast('Connection error', 'error');
            }
        }

        async function deleteJobListing(id) {
            if (!confirm('Are you sure you want to delete this job listing? This action cannot be undone.')) return;
            try {
                const res = await fetch(`${API}/jobs/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${TOKEN}`
                    }
                });
                if (res.ok) {
                    showToast('Job listing deleted successfully!');
                    loadEmployerListings();
                } else {
                    showToast('Failed to delete job', 'error');
                }
            } catch (e) {
                showToast('Connection error', 'error');
            }
        }

        function openPostJobModal() {
            document.getElementById('post-job-id').value = '';
            document.getElementById('post-job-modal-title').textContent = 'Post a New Job';
            document.getElementById('post-job-form').reset();
            openModal('post-job-modal');
        }

        async function openEditJobModal(id) {
            try {
                const res = await fetch(`${API}/jobs/${id}`);
                if (res.ok) {
                    const data = await res.json();
                    const j = data.data;
                    document.getElementById('post-job-id').value = j.id;
                    document.getElementById('post-job-modal-title').textContent = 'Edit Job Listing';
                    document.getElementById('post-job-title').value = j.title;
                    document.getElementById('post-job-desc').value = j.description;
                    document.getElementById('post-job-loc').value = j.location;
                    document.getElementById('post-job-type').value = j.job_type;
                    document.getElementById('post-job-salary').value = j.salary_range || '';
                    document.getElementById('post-job-exp').value = j.experience_level || 'entry';
                    document.getElementById('post-job-skills').value = (j.required_skills || []).join(', ');
                    document.getElementById('post-job-positions').value = j.number_of_positions || 1;
                    openModal('post-job-modal');
                }
            } catch (e) {
                showToast('Failed to load job details', 'error');
            }
        }

        async function submitJob(e) {
            e.preventDefault();
            const id = document.getElementById('post-job-id').value;
            const title = document.getElementById('post-job-title').value;
            const description = document.getElementById('post-job-desc').value;
            const location = document.getElementById('post-job-loc').value;
            const job_type = document.getElementById('post-job-type').value;
            const salary_range = document.getElementById('post-job-salary').value;
            const experience_level = document.getElementById('post-job-exp').value;
            const skillsStr = document.getElementById('post-job-skills').value;
            const required_skills = skillsStr ? skillsStr.split(',').map(s => s.trim()).filter(Boolean) : [];
            const number_of_positions = parseInt(document.getElementById('post-job-positions').value) || 1;

            const payload = {
                title,
                description,
                location,
                job_type,
                salary_range,
                experience_level,
                required_skills,
                number_of_positions
            };

            const url = id ? `${API}/jobs/${id}` : `${API}/jobs`;
            const method = id ? 'PUT' : 'POST';

            try {
                const res = await fetch(url, {
                    method,
                    headers: {
                        'Authorization': `Bearer ${TOKEN}`,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await res.json();

                if (res.ok) {
                    closeModal('post-job-modal');
                    showToast(id ? 'Job listing updated successfully!' : 'Job listing posted successfully!');
                    loadEmployerListings();
                } else {
                    showToast(data.message || 'Failed to save job listing', 'error');
                }
            } catch (e) {
                showToast('Connection error', 'error');
            }
        }

        async function loadCandidates() {
            try {
                const res = await fetch(`${API}/applications`, {
                    headers: {
                        'Authorization': `Bearer ${TOKEN}`
                    }
                });
                if (res.ok) {
                    const data = await res.json();
                    renderCandidates(data.data.data || []);
                }
            } catch (e) {
                console.error(e);
            }
        }

        function renderCandidates(apps) {
            const c = document.getElementById('candidates-list');
            if (!apps.length) {
                c.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-icon">👥</div>
                        <h3 class="empty-title">No Applicants</h3>
                        <p class="empty-desc">Your job listings haven't received any submissions yet.</p>
                    </div>
                `;
                return;
            }
            c.innerHTML = apps.map(a => `
                <div class="glass-panel rounded-xl p-6 border border-white/5 space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-white/5 pb-3">
                        <div>
                            <div class="font-bold text-white text-base">${a.user ? a.user.name : 'Anonymous User'}</div>
                            <div class="text-xs text-slate-400">Applied for <span class="text-accent-blue font-medium">${a.job.title}</span></div>
                        </div>
                        <div>
                            <span class="badge ${a.status === 'accepted' ? 'green' : a.status === 'rejected' ? 'red' : a.status === 'shortlisted' ? 'green' : ''} text-xs">${a.status}</span>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Cover Letter</h4>
                        <p class="text-sm text-slate-300 bg-[#0D1120] p-4 rounded-xl border border-white/5 leading-relaxed whitespace-pre-wrap">${a.cover_letter || 'No cover letter provided.'}</p>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-2">
                        <div class="text-xs text-slate-500">Contact: ${a.user ? (a.user.phone || 'N/A') : 'N/A'} • ${a.user ? a.user.email : 'N/A'}</div>
                        <div class="flex items-center gap-2">
                            <button class="border border-white/10 hover:border-white/20 text-[#F0F4FF] text-xs px-3.5 py-2 rounded-xl cursor-pointer transition" onclick="updateCandidateStatus(${a.id}, 'shortlisted')">
                                Shortlist
                            </button>
                            <button class="bg-accent-green hover:bg-[#99ffbd] text-bg-deep font-bold text-xs px-3.5 py-2 rounded-xl cursor-pointer transition shadow-md" onclick="updateCandidateStatus(${a.id}, 'accepted')">
                                Accept
                            </button>
                            <button class="bg-red-500/10 hover:bg-red-500/25 border border-red-500/20 text-red-400 text-xs px-3.5 py-2 rounded-xl cursor-pointer transition" onclick="updateCandidateStatus(${a.id}, 'rejected')">
                                Reject
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        async function updateCandidateStatus(appId, status) {
            try {
                const res = await fetch(`${API}/applications/${appId}`, {
                    method: 'PUT',
                    headers: {
                        'Authorization': `Bearer ${TOKEN}`,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        status
                    })
                });
                if (res.ok) {
                    showToast(`Candidate marked as ${status}!`);
                    loadCandidates();
                } else {
                    showToast('Failed to update candidate status', 'error');
                }
            } catch (e) {
                showToast('Connection error', 'error');
            }
        }

        async function viewCandidate(id) {
            try {
                const res = await fetch(`${API}/applications/${id}`, {
                    headers: {
                        'Authorization': `Bearer ${TOKEN}`
                    }
                });
                if (res.ok) {
                    const data = await res.json();
                    const a = data.data;
                    document.getElementById('job-title').textContent = 'Candidate Application Details';
                    document.getElementById('job-details').innerHTML = `
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-0.5">Applicant</h4>
                                <p class="text-white text-base font-semibold">${a.user ? a.user.name : 'Unknown User'}</p>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-0.5 font-medium">Applied For</h4>
                                <p class="text-accent-blue text-sm font-semibold">${a.job.title}</p>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5 font-medium">Cover Letter</h4>
                                <p class="text-slate-300 text-sm bg-[#0D1120] p-4 rounded-xl border border-white/5 leading-relaxed whitespace-pre-wrap">${a.cover_letter || 'N/A'}</p>
                            </div>
                            <div class="text-xs text-slate-500 border-t border-white/5 pt-4">
                                Contact: ${a.user ? (a.user.phone || 'N/A') : 'N/A'} • ${a.user ? a.user.email : 'N/A'}
                            </div>
                            <div class="flex gap-2 pt-4">
                                <button class="flex-1 bg-accent-green hover:bg-[#99ffbd] text-bg-deep font-bold py-3 rounded-xl cursor-pointer text-sm shadow-md" onclick="updateCandidateStatus(${a.id}, 'accepted'); closeModal('job-modal');">Accept</button>
                                <button class="flex-1 border border-white/10 hover:border-white/20 text-[#F0F4FF] py-3 rounded-xl cursor-pointer text-sm" onclick="updateCandidateStatus(${a.id}, 'shortlisted'); closeModal('job-modal');">Shortlist</button>
                            </div>
                        </div>
                    `;
                    openModal('job-modal');
                }
            } catch (e) {
                showToast('Failed to load candidate details', 'error');
            }
        }

        function loadCompanyProfileForm() {
            document.getElementById('comp-name').value = currentUser.company_name || currentUser.name || '';
            document.getElementById('comp-loc').value = currentUser.location || '';
            document.getElementById('comp-bio').value = currentUser.bio || '';
            document.getElementById('comp-phone').value = currentUser.phone || '';
        }

        async function saveCompanyProfile(e) {
            e.preventDefault();
            const company_name = document.getElementById('comp-name').value;
            const location = document.getElementById('comp-loc').value;
            const bio = document.getElementById('comp-bio').value;
            const phone = document.getElementById('comp-phone').value;

            try {
                const res = await fetch(`${API}/auth/profile`, {
                    method: 'PUT',
                    headers: {
                        'Authorization': `Bearer ${TOKEN}`,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        company_name,
                        name: currentUser.name,
                        location,
                        bio,
                        phone
                    })
                });

                if (res.ok) {
                    // Re-fetch profile
                    const profileRes = await fetch(`${API}/auth/profile`, {
                        headers: {
                            'Authorization': `Bearer ${TOKEN}`
                        }
                    });
                    if (profileRes.ok) {
                        currentUser = await profileRes.json();
                        document.getElementById('user-display-name').textContent = currentUser.company_name || currentUser.name;
                        document.getElementById('welcome-name').textContent = currentUser.name;
                    }
                    showToast('Company profile saved successfully!');
                } else {
                    showToast('Failed to save company profile', 'error');
                }
            } catch (e) {
                showToast('Connection error', 'error');
            }
        }
    </script>
</body>

</html>