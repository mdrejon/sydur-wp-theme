<?php
/**
 * The template for displaying service archives
 */

get_header(); ?>

<main class="pt-32 pb-24 px-6 md:px-12 max-w-7xl mx-auto">
    <header class="mb-20 text-center reveal active">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">Professional Services</h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-lg leading-relaxed">
            From technical auditing to enterprise-scale plugin development, I provide specialized services for the modern web.
        </p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article class="reveal active">
                <a href="<?php the_permalink(); ?>" class="glass-panel p-10 rounded-3xl block h-full border border-slate-700/50 hover:border-primary transition-all duration-500 group">
                    <div class="text-4xl mb-6 text-slate-500 group-hover:text-primary transition-colors">&#9881;</div>
                    <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-primary transition-colors"><?php the_title(); ?></h3>
                    <div class="text-slate-400 text-sm leading-relaxed mb-8">
                        <?php the_excerpt(); ?>
                    </div>
                    <span class="text-white font-mono text-xs uppercase tracking-widest border-b border-primary pb-1">Learn More</span>
                </a>
            </article>
        <?php endwhile; else : ?>
            <p class="text-slate-500 col-span-full text-center">No services listed yet.</p>
        <?php endif; ?>
    </div>

    <!-- Global CTA -->
    <section class="mt-32 p-12 md:p-20 rounded-[3rem] bg-gradient-to-br from-primary/20 to-blue-600/10 border border-primary/20 text-center reveal">
        <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-8">Ready to start your next project?</h2>
        <p class="text-slate-300 mb-12 max-w-xl mx-auto text-lg">Whether you need a custom plugin or a technical consultation, I'm here to help you scale.</p>
        <a href="<?php echo home_url('/#contact'); ?>" class="inline-block px-12 py-4 bg-primary text-slate-900 font-bold rounded-full hover:shadow-[0_0_30px_rgba(34,211,238,0.4)] transition-all">
            Get in Touch Today
        </a>
    </section>
</main>

<?php get_footer(); ?>
