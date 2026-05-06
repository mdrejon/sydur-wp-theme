<?php
/**
 * The template for displaying all single case studies
 */

get_header(); ?>

<main class="pt-32 pb-24 px-6 md:px-12 max-w-7xl mx-auto">
    <?php while ( have_posts() ) : the_post(); 
        $client = get_post_meta( get_the_ID(), 'client', true ) ?: 'Confidential Client';
        $role = get_post_meta( get_the_ID(), 'role', true ) ?: 'Lead Developer';
        $results = get_post_meta( get_the_ID(), 'results', true ) ?: 'Successfully Deployed';
    ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'reveal active' ); ?>>
            <header class="mb-16">
                <div class="flex items-center gap-4 mb-4 font-mono text-sm text-primary uppercase tracking-widest">
                    <span>Case Study</span>
                    <span>/</span>
                    <span><?php the_title(); ?></span>
                </div>
                <h1 class="text-4xl md:text-7xl font-extrabold text-white mb-8 leading-tight"><?php the_title(); ?></h1>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 py-8 border-y border-slate-800">
                    <div>
                        <span class="block font-mono text-[10px] text-slate-500 uppercase mb-1">Client</span>
                        <span class="text-white font-bold"><?php echo esc_html( $client ); ?></span>
                    </div>
                    <div>
                        <span class="block font-mono text-[10px] text-slate-500 uppercase mb-1">Role</span>
                        <span class="text-white font-bold"><?php echo esc_html( $role ); ?></span>
                    </div>
                    <div>
                        <span class="block font-mono text-[10px] text-slate-500 uppercase mb-1">Date</span>
                        <span class="text-white font-bold"><?php echo get_the_date(); ?></span>
                    </div>
                    <div>
                        <span class="block font-mono text-[10px] text-slate-500 uppercase mb-1">Outcome</span>
                        <span class="text-primary font-bold"><?php echo esc_html( $results ); ?></span>
                    </div>
                </div>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="rounded-3xl overflow-hidden border border-slate-700/50 mb-16 shadow-2xl">
                    <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-auto' ) ); ?>
                </div>
            <?php endif; ?>

            <div class="max-w-4xl mx-auto text-slate-400 text-lg leading-relaxed prose prose-invert prose-headings:text-white prose-strong:text-primary">
                <?php the_content(); ?>
            </div>

            <!-- Next Case Study / CTA -->
            <footer class="mt-24 pt-16 border-t border-slate-800 text-center">
                <h3 class="text-3xl font-bold text-white mb-6">Have a similar project in mind?</h3>
                <p class="text-slate-400 mb-10 max-w-2xl mx-auto">Let's discuss how I can help you achieve similar results for your business.</p>
                <a href="#contact" class="inline-block px-10 py-4 bg-primary text-slate-900 font-bold rounded-full hover:bg-primary/90 transition-all">
                    Start a Conversation
                </a>
            </footer>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
