<?php
/**
 * The template for displaying 404 pages (not found)
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <style>
        body {
            background-color: #0f172a;
            color: #cbd5e1;
            overflow: hidden; /* Keep it contained */
        }

        .bg-grid {
            background-size: 40px 40px;
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            mask-image: linear-gradient(to bottom, transparent, black, transparent);
            -webkit-mask-image: radial-gradient(circle at center, black 0%, transparent 80%);
        }

        .glass-panel {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .glitch-effect {
            animation: glitch 1s linear infinite;
        }

        @keyframes glitch {
            2%, 64% { transform: translate(2px, 0) skew(0deg); }
            4%, 60% { transform: translate(-2px, 0) skew(0deg); }
            62% { transform: translate(0, 0) skew(5deg); }
        }
        
        /* Blinking cursor for terminal */
        .cursor-blink {
            display: inline-block;
            width: 8px;
            height: 15px;
            background-color: #22d3ee;
            animation: blink 1s step-end infinite;
            vertical-align: middle;
            margin-left: 4px;
        }
        @keyframes blink { 50% { opacity: 0; } }
    </style>
</head>
<body class="font-sans antialiased h-screen flex flex-col items-center justify-center relative selection:bg-primary selection:text-slate-900">

    <!-- Background Elements -->
    <div class="fixed inset-0 z-[-1] bg-grid opacity-40"></div>
    <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-primary/10 rounded-full mix-blend-multiply filter blur-[100px] z-[-1]"></div>

    <!-- Navigation (Simplified for 404) -->
    <nav class="absolute top-0 w-full py-6 px-6 md:px-12 flex justify-between items-center">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-bold text-white tracking-tighter flex items-center gap-1 group">
            <span class="text-primary group-hover:text-white transition-colors">&lt;</span>
            SR<span class="text-primary font-mono text-xl">/</span>
            <span class="text-primary group-hover:text-white transition-colors">&gt;</span>
        </a>
    </nav>

    <!-- Main 404 Content -->
    <main class="text-center px-6 z-10 w-full max-w-2xl">
        
        <!-- Big Glitch Title -->
        <h1 class="text-8xl md:text-[150px] font-black text-white/5 tracking-widest mb-4 glitch-effect select-none">
            404
        </h1>
        
        <!-- Terminal Error Window -->
        <div class="glass-panel rounded-lg overflow-hidden border border-slate-700 shadow-2xl mb-10 text-left relative z-20 -mt-16 md:-mt-24 mx-auto max-w-lg">
            <div class="bg-slate-800 px-4 py-2 flex items-center gap-2 border-b border-slate-700">
                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                <span class="ml-2 font-mono text-xs text-slate-400">error.log</span>
            </div>
            <div class="p-6 font-mono text-sm md:text-base bg-[#0d1117] leading-relaxed">
                <p class="text-slate-400"><span class="text-green-400">sydur@server</span>:<span class="text-blue-400">~</span>$ curl -I request_url</p>
                <p class="text-red-400 mt-2">HTTP/2 404 Not Found</p>
                <p class="text-yellow-300 mt-1">Warning: The requested endpoint does not exist or has been moved.</p>
                <p class="text-slate-400 mt-4"><span class="text-green-400">sydur@server</span>:<span class="text-blue-400">~</span>$ _ <span class="cursor-blink"></span></p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 font-mono text-sm">
            <button onclick="window.history.back()" class="px-6 py-3 border border-slate-600 text-slate-300 font-bold rounded flex items-center justify-center gap-2 hover:border-slate-400 hover:text-white transition-all w-full sm:w-auto">
                <span class="text-lg">&#8592;</span> Go Back
            </button>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="px-6 py-3 bg-primary text-slate-900 font-bold rounded flex items-center justify-center gap-2 hover:bg-primaryHover transition-all w-full sm:w-auto">
                Return to Root <span class="text-lg">&#8962;</span>
            </a>
        </div>
    </main>

    <!-- Simple Footer -->
    <footer class="absolute bottom-6 w-full text-center text-slate-600 font-mono text-xs">
        System Status: Operational. Navigational Error Detected.
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
