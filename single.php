<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

    <?php
    while ( have_posts() ) :
        the_post();
        
        $categories = get_the_category();
        $first_cat = ! empty( $categories ) ? esc_html( $categories[0]->name ) : 'Article';
        ?>
        <!-- Article Header -->
        <header class="pt-32 pb-10 px-6 md:px-12 max-w-4xl mx-auto mt-8">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="font-mono text-primary text-sm mb-8 inline-flex items-center hover:text-white transition-colors">
                <span class="mr-2 text-lg">&#8592;</span> Back to all posts
            </a>
            
            <div class="flex items-center gap-4 font-mono text-xs text-slate-400 mb-6 border-b border-slate-800 pb-6">
                <span class="text-primary bg-primary/10 px-3 py-1.5 rounded uppercase tracking-wider"><?php echo $first_cat; ?></span>
                <span class="flex items-center gap-2"><span class="text-base">&#128197;</span> <?php echo get_the_date(); ?></span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight leading-tight mb-6">
                <?php the_title(); ?>
            </h1>
            
            <!-- Author Profile -->
            <div class="flex items-center gap-4 mt-8">
                <div class="w-12 h-12 rounded-full bg-slate-800 border-2 border-slate-700 flex items-center justify-center text-xl overflow-hidden">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
                </div>
                <div>
                    <p class="text-white font-medium text-sm"><?php the_author(); ?></p>
                    <p class="font-mono text-xs text-slate-500">Author</p>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="py-4 px-6 md:px-12 max-w-4xl mx-auto prose">
            <?php the_content(); ?>
        </main>

        <!-- Article Footer / Share -->
        <div class="max-w-4xl mx-auto px-6 md:px-12 mt-12 mb-20 border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="font-mono text-sm text-slate-400">
                Tags: <?php the_tags( '', ', ', '' ); ?>
            </div>
        </div>
        
    <?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>
