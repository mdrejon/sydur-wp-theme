<?php
/**
 * The template for displaying all single services
 */

get_header(); ?>

<main class="pt-32 pb-24 px-6 md:px-12 max-w-7xl mx-auto">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'reveal active' ); ?>>
            <header class="mb-12">
                <div class="flex items-center gap-4 mb-4 font-mono text-sm text-primary">
                    <a href="<?php echo get_post_type_archive_link( 'service' ); ?>" class="hover:underline">Services</a>
                    <span>/</span>
                    <span><?php the_title(); ?></span>
                </div>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6"><?php the_title(); ?></h1>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="rounded-3xl overflow-hidden border border-slate-700/50 mb-12 h-64 md:h-96">
                        <?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-full object-cover' ) ); ?>
                    </div>
                <?php endif; ?>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                <!-- Main Content -->
                <div class="lg:col-span-2 text-slate-400 text-lg leading-relaxed prose prose-invert max-w-none">
                    <?php the_content(); ?>
                </div>

                <!-- Sidebar / Contact Form -->
                <div class="lg:col-span-1">
                    <div class="glass-panel p-8 rounded-3xl border border-slate-700/50 sticky top-32">
                        <?php 
                        $inquiry_title = get_post_meta( get_the_ID(), 'inquiry_title', true ) ?: 'Inquiry about ' . get_the_title();
                        $inquiry_desc = get_post_meta( get_the_ID(), 'inquiry_description', true ) ?: "Fill out the form below and I'll get back to you with a custom quote within 24 hours.";
                        $benefits_text = get_post_meta( get_the_ID(), 'benefits', true );
                        $benefits = $benefits_text ? explode( "\n", str_replace( "\r", "", $benefits_text ) ) : array(
                            'Enterprise-grade code standards',
                            'Direct communication with developer',
                            'Scalable & maintainable architecture'
                        );
                        ?>
                        <h3 class="text-2xl font-bold text-white mb-6"><?php echo esc_html( $inquiry_title ); ?></h3>
                        <p class="text-slate-400 mb-8 text-sm"><?php echo esc_html( $inquiry_desc ); ?></p>
                        
                        <div class="cf7-container">
                            <?php 
                            $options = get_option( 'sydur_options' );
                            $form_shortcode = isset( $options['service_form_shortcode'] ) ? $options['service_form_shortcode'] : '';
                            
                            if ( ! empty( $form_shortcode ) ) {
                                echo do_shortcode( $form_shortcode ); 
                            } else {
                                echo '<p class="text-xs text-slate-500 italic">Please configure the Service Form Shortcode in Theme Options > Contact Settings.</p>';
                            }
                            ?>
                        </div>

                        <div class="mt-8 pt-8 border-t border-slate-800">
                            <h4 class="text-white font-bold mb-4">Why choose this service?</h4>
                            <ul class="space-y-3 text-sm text-slate-400">
                                <?php foreach ( $benefits as $benefit ) : if ( trim( $benefit ) ) : ?>
                                    <li class="flex items-start gap-2">
                                        <span class="text-primary mt-1">✓</span>
                                        <span><?php echo esc_html( trim( $benefit ) ); ?></span>
                                    </li>
                                <?php endif; endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
