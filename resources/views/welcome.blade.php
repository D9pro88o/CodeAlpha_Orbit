<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orbit — Project Management</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-ink-navy text-canvas">

    <nav class="max-w-6xl mx-auto px-6 py-6 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <svg width="28" height="28" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="13" cy="13" r="10" stroke="#2F8F8C" stroke-width="1.5"/>
                <circle cx="13" cy="13" r="2" fill="#EDEEE9"/>
                <circle cx="21.5" cy="13" r="2.25" fill="#E8A33D"/>
            </svg>
            <span class="font-display font-bold text-xl tracking-tight">Orbit</span>
        </div>

        <div class="flex items-center gap-6">
            @auth
                <a href="{{ route('projects.index') }}" class="text-sm font-medium hover:text-signal-amber transition">
                    Go to Projects
                </a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-canvas/70 hover:text-canvas transition">
                    Log in
                </a>
                <a href="{{ route('register') }}" class="bg-signal-amber text-ink-navy text-sm font-semibold px-4 py-2 rounded-md hover:bg-signal-amber/90 transition">
                    Get Started
                </a>
            @endauth
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 pt-20 pb-24 text-center">
        <p class="font-mono text-xs uppercase tracking-widest text-orbit-teal mb-4">
            Project Management, In Sync
        </p>
        <h1 class="font-display font-bold text-5xl sm:text-6xl leading-tight mb-6">
            Keep every task<br>in its orbit.
        </h1>
        <p class="text-canvas/60 text-lg max-w-xl mx-auto mb-10">
            Create projects, assign tasks, and talk it through — all in one place.
            Built for teams who want clarity without the clutter.
        </p>

        <div class="flex justify-center gap-4">
            @auth
                <a href="{{ route('projects.index') }}"
                   class="bg-signal-amber text-ink-navy font-semibold px-6 py-3 rounded-md hover:bg-signal-amber/90 transition">
                    Go to Your Projects
                </a>
            @else
                <a href="{{ route('register') }}"
                   class="bg-signal-amber text-ink-navy font-semibold px-6 py-3 rounded-md hover:bg-signal-amber/90 transition">
                    Create Free Account
                </a>
                <a href="{{ route('login') }}"
                   class="border border-canvas/20 text-canvas font-medium px-6 py-3 rounded-md hover:border-canvas/40 transition">
                    Log In
                </a>
            @endauth
        </div>
    </main>

    <section class="max-w-5xl mx-auto px-6 pb-24 grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-panel-slate/40 border border-canvas/10 rounded-lg p-6">
            <p class="font-mono text-xs text-orbit-teal uppercase tracking-wide mb-2">01</p>
            <h3 class="font-display font-semibold text-lg mb-2">Group Projects</h3>
            <p class="text-canvas/50 text-sm">Spin up a project, invite your team by email, and start organizing.</p>
        </div>
        <div class="bg-panel-slate/40 border border-canvas/10 rounded-lg p-6">
            <p class="font-mono text-xs text-orbit-teal uppercase tracking-wide mb-2">02</p>
            <h3 class="font-display font-semibold text-lg mb-2">Task Boards</h3>
            <p class="text-canvas/50 text-sm">Drag tasks across lists, assign owners, and track due dates at a glance.</p>
        </div>
        <div class="bg-panel-slate/40 border border-canvas/10 rounded-lg p-6">
            <p class="font-mono text-xs text-orbit-teal uppercase tracking-wide mb-2">03</p>
            <h3 class="font-display font-semibold text-lg mb-2">Live Comments</h3>
            <p class="text-canvas/50 text-sm">Discuss tasks in real time — no more digging through chat history.</p>
        </div>
    </section>

    <footer class="max-w-6xl mx-auto px-6 py-8 border-t border-canvas/10 text-center">
        <p class="font-mono text-[10px] text-canvas/30 uppercase tracking-widest">
            Orbit · Track. Assign. Deliver.
        </p>
    </footer>

</body>
</html>