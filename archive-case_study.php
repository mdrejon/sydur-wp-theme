<?php
/**
 * The template for displaying case study archives
 */

get_header(); ?>

<main class="pt-32 pb-24 px-6 md:px-12 max-w-7xl mx-auto">
    <header class="mb-20 text-center reveal active">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">Case Studies</h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-lg leading-relaxed">
            Deep dives into complex problems solved, from initial architectural planning to final deployment.
        </p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article class="group reveal active">
                <a href="<?php the_permalink(); ?>" class="block">
                    <div class="relative overflow-hidden rounded-3xl border border-slate-700/50 mb-6 aspect-video bg-slate-800">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500' ) ); ?>
                        <?php else : ?>
                            <div class="flex items-center justify-center h-full text-slate-700 text-5xl font-bold font-mono">
                                <?php echo get_the_title()[0]; ?>
                            </div>
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-8">
                            <span class="text-primary font-mono text-sm">Read Full Case Study →</span>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-primary transition-colors"><?php the_title(); ?></h3>
                    <div class="text-slate-400 text-sm line-clamp-3 leading-relaxed mb-4">
                        <?php the_excerpt(); ?>
                    </div>
                </a>
            </article>
        <?php endwhile; else : ?>
            <p class="text-slate-500 col-span-full text-center py-12">No case studies found yet. Check back soon!</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
