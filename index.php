<?php
/**
 * The main template file / Blog Archive
 */

get_header(); ?>

    <!-- Page Header -->
    <header class="pt-32 pb-16 px-6 md:px-12 max-w-7xl mx-auto animate-fade-in-up">
        <p class="font-mono text-primary mb-4 ml-1">Insights & Tutorials</p>
        <h1 class="text-4xl md:text-6xl font-bold text-white tracking-tight mb-6">
            <?php 
            if ( is_home() && ! is_front_page() ) {
                single_post_title();
            } elseif ( is_archive() ) {
                the_archive_title();
            } elseif ( is_search() ) {
                printf( __( 'Search Results for: %s', 'sydur-wp-theme' ), '<span>' . get_search_query() . '</span>' );
            } else {
                echo 'Writing & Thinking.';
            }
            ?>
        </h1>
        <div class="text-lg text-slate-400 max-w-2xl leading-relaxed mb-10">
            <?php if ( is_archive() ) {
                the_archive_description();
            } else {
                echo '<p>Deep dives into WordPress plugin architecture, Vue.js reactivity, backend scaling, and my journey as a full-stack developer.</p>';
            } ?>
        </div>
        
        <!-- Search & Filter -->
        <div class="flex flex-col md:flex-row gap-4 max-w-3xl">
            <form role="search" method="get" class="relative flex-grow" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <span class="absolute left-4 top-3 text-slate-500 text-lg">&#128269;</span>
                <input type="text" name="s" placeholder="Search articles..." value="<?php echo get_search_query(); ?>" class="w-full bg-slate-800/50 border border-slate-700 text-white rounded-lg py-3 pl-12 pr-4 focus:outline-none focus:border-primary transition-colors font-mono text-sm">
            </form>
            <div class="flex gap-2 overflow-x-auto pb-2 md:pb-0 scrollbar-hide font-mono text-sm">
                <a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="whitespace-nowrap px-4 py-3 bg-primary text-slate-900 font-bold rounded-lg hover:bg-primaryHover transition-colors">All Posts</a>
            </div>
        </div>
    </header>

    <!-- Blog Grid -->
    <main class="py-12 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); 
                    $categories = get_the_category();
                    $first_cat = ! empty( $categories ) ? esc_html( $categories[0]->name ) : 'Article';
                ?>
                    <!-- Article -->
                    <article class="glass-panel p-6 rounded-xl border border-slate-700 hover:border-primary/50 transition-all hover:-translate-y-2 group cursor-pointer reveal" onclick="window.location.href='<?php the_permalink(); ?>'">
                        <div class="flex justify-between items-center mb-4 font-mono text-xs">
                            <span class="text-primary bg-primary/10 px-2 py-1 rounded">#<?php echo $first_cat; ?></span>
                            <span class="text-slate-500 flex items-center gap-1"><span class="text-sm">&#128197;</span> <?php echo get_the_date(); ?></span>
                        </div>
                        <h2 class="text-xl font-bold text-white mb-3 group-hover:text-primary transition-colors line-clamp-2">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="text-slate-400 text-sm leading-relaxed mb-6 line-clamp-3">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="flex items-center justify-between font-mono text-xs">
                            <span class="text-slate-500 flex items-center gap-1"><span class="text-sm">&#9202;</span> Read</span>
                            <span class="text-primary group-hover:text-white transition-colors flex items-center gap-2">Read <span class="text-lg">&#10142;</span></span>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else : ?>
                <p class="text-white">No posts found.</p>
            <?php endif; ?>

        </div>

        <!-- Pagination -->
        <div class="mt-16 flex justify-center items-center gap-4 font-mono text-sm reveal">
            <?php
            echo paginate_links( array(
                'prev_text' => '&lt; Prev',
                'next_text' => 'Next &gt;',
                'type'      => 'plain',
            ) );
            ?>
            <style>
                .page-numbers { display: inline-flex; align-items: center; justify-content: center; width: 2.5rem; height: 2.5rem; border-radius: 0.25rem; border: 1px solid #334155; color: #cbd5e1; transition: all 0.2s; }
                .page-numbers:hover { border-color: #22d3ee; color: #22d3ee; }
                .page-numbers.current { background-color: #22d3ee; color: #0f172a; border-color: #22d3ee; font-weight: bold; }
                .prev, .next { width: auto; padding: 0.5rem 1rem; }
            </style>
        </div>
    </main>

<?php get_footer(); ?>
