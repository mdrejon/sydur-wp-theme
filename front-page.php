<?php
/**
 * The front page template file
 */

get_header(); 

$options = get_option( 'sydur_options' );
$hero_greeting = isset( $options['hero_greeting'] ) && ! empty( $options['hero_greeting'] ) ? $options['hero_greeting'] : 'Hi, my name is';
$hero_title = isset( $options['hero_title'] ) && ! empty( $options['hero_title'] ) ? $options['hero_title'] : 'Sydur Rahman.';
$hero_subtitle = isset( $options['hero_subtitle'] ) && ! empty( $options['hero_subtitle'] ) ? $options['hero_subtitle'] : 'I build things for the web.';
$hero_desc = isset( $options['hero_description'] ) && ! empty( $options['hero_description'] ) ? $options['hero_description'] : "I'm a Full Stack Web Developer specializing in scalable architecture, reactive frontends, and enterprise-grade WordPress plugins.";

$about_text = isset( $options['about_text'] ) && ! empty( $options['about_text'] ) ? $options['about_text'] : "<p>I see myself as a <span class='text-primary'>problem solver first</span>, and a developer second.</p>";
$github_url = isset( $options['github_url'] ) ? $options['github_url'] : '#';
$linkedin_url = isset( $options['linkedin_url'] ) ? $options['linkedin_url'] : '#';

$contact_email = isset( $options['contact_email'] ) ? $options['contact_email'] : 'hello@sydur.com';
?>

    <!-- Hero Section -->
    <section class="min-h-screen flex items-center pt-20 pb-12 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="max-w-3xl animate-fade-in-up">
            <p class="font-mono text-primary mb-4 ml-1"><?php echo esc_html( $hero_greeting ); ?></p>
            <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-4">
                <?php echo esc_html( $hero_title ); ?>
            </h1>
            <h2 class="text-4xl md:text-6xl font-bold text-slate-400 mb-6 leading-tight">
                <?php echo esc_html( $hero_subtitle ); ?>
            </h2>
            <div class="text-lg md:text-xl text-slate-400 mb-10 max-w-2xl leading-relaxed">
                <?php echo wp_kses_post( $hero_desc ); ?>
            </div>
            <div class="flex flex-wrap gap-4 font-mono text-sm">
                <a href="#contact" class="px-6 py-3 bg-primary text-slate-900 font-bold rounded hover:bg-primaryHover transition-colors">
                    Get In Touch
                </a>
                <a href="#portfolio" class="px-6 py-3 border border-slate-600 text-slate-300 rounded hover:border-slate-400 hover:text-white transition-colors">
                    View Portfolio
                </a>
            </div>
        </div>
    </section>

    <!-- 01. About Section -->
    <section id="about" class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="flex items-center mb-12 reveal">
            <h2 class="text-3xl font-bold text-white font-mono">
                <span class="text-primary text-xl md:text-2xl mr-2">01.</span>About Me
            </h2>
            <div class="h-[1px] bg-slate-700 flex-grow ml-6"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6 text-slate-400 text-lg leading-relaxed reveal">
                <?php echo wp_kses_post( wpautop( $about_text ) ); ?>
                <div class="pt-4 flex gap-6 font-mono text-sm">
                    <?php if ( $github_url ) : ?>
                    <a href="<?php echo esc_url( $github_url ); ?>" target="_blank" class="text-slate-400 hover:text-primary transition-colors flex items-center gap-2">
                        <span class="text-2xl">&#128423;</span> GitHub
                    </a>
                    <?php endif; ?>
                    <?php if ( $linkedin_url ) : ?>
                    <a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" class="text-slate-400 hover:text-primary transition-colors flex items-center gap-2">
                        <span class="text-2xl">&#128100;</span> LinkedIn
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Terminal Graphic -->
            <div class="reveal">
                <div class="glass-panel rounded-lg overflow-hidden shadow-2xl border-t border-slate-600">
                    <div class="bg-slate-800/80 px-4 py-3 flex items-center gap-2 border-b border-slate-700">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="ml-2 font-mono text-xs text-slate-400">sydur_config.json</span>
                    </div>
                    <div class="p-6 font-mono text-sm md:text-base overflow-x-auto">
<pre class="text-slate-300">
<span class="text-pink-400">const</span> <span class="text-blue-400">developer</span> = {
  <span class="text-primary">name:</span> <span class="text-green-400">'<?php echo esc_js( $hero_title ); ?>'</span>,
  <span class="text-primary">role:</span> <span class="text-green-400">'Full Stack Developer'</span>,
  <span class="text-primary">isAvailableForHire:</span> <span class="text-blue-400">true</span>
};
</pre>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 02. Services Section -->
    <section id="services" class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="flex items-center mb-16 reveal">
            <h2 class="text-3xl font-bold text-white font-mono">
                <span class="text-primary text-xl md:text-2xl mr-2">02.</span>What I Do
            </h2>
            <div class="h-[1px] bg-slate-700 flex-grow ml-6"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            $services = new WP_Query( array( 'post_type' => 'service', 'posts_per_page' => -1 ) );
            if ( $services->have_posts() ) :
                $delay = 0;
                while ( $services->have_posts() ) : $services->the_post();
                    ?>
                    <div class="glass-panel p-8 rounded-xl reveal hover:-translate-y-2 transition-transform duration-300 group border-t border-slate-700" style="transition-delay: <?php echo esc_attr( $delay ); ?>ms;">
                        <div class="text-4xl mb-6 text-slate-400 group-hover:text-primary transition-colors">&#9881;</div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-primary transition-colors">
                            <?php the_title(); ?>
                        </h3>
                        <div class="text-slate-400 text-sm leading-relaxed">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                    <?php
                    $delay += 100;
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="text-slate-400">No services found. Add some in the WordPress admin.</p>';
            endif;
            ?>
        </div>
    </section>

    <!-- 03. Experience Section -->
    <section id="experience" class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="flex items-center mb-16 reveal">
            <h2 class="text-3xl font-bold text-white font-mono">
                <span class="text-primary text-xl md:text-2xl mr-2">03.</span>Where I've Worked
            </h2>
            <div class="h-[1px] bg-slate-700 flex-grow ml-6"></div>
        </div>

        <div class="relative border-l border-slate-700 ml-3 md:ml-6 space-y-12">
            <?php
            $experience = new WP_Query( array( 'post_type' => 'experience', 'posts_per_page' => -1 ) );
            if ( $experience->have_posts() ) :
                while ( $experience->have_posts() ) : $experience->the_post();
                    $duration = get_post_meta( get_the_ID(), 'duration', true ) ?: 'Duration not set';
                    $location = get_post_meta( get_the_ID(), 'location', true ) ?: 'Remote';
                    ?>
                    <div class="relative pl-8 md:pl-12 reveal">
                        <div class="absolute -left-2 top-1 w-4 h-4 rounded-full bg-slate-900 border-2 border-primary"></div>
                        <div class="flex flex-col md:flex-row md:items-baseline justify-between mb-2">
                            <h3 class="text-xl font-bold text-white">
                                <?php the_title(); ?>
                            </h3>
                            <span class="font-mono text-sm text-slate-400 mt-1 md:mt-0"><?php echo esc_html( $duration ); ?></span>
                        </div>
                        <p class="text-sm text-slate-500 mb-4 font-mono"><?php echo esc_html( $location ); ?></p>
                        <div class="space-y-3 text-slate-400 prose-sm prose-li:marker:text-primary">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="text-slate-400">No experience found. Add some in the WordPress admin.</p>';
            endif;
            ?>
        </div>
    </section>

    <!-- 04. Skills Section with Chart.js -->
    <section id="skills" class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="flex items-center mb-12 reveal">
            <h2 class="text-3xl font-bold text-white font-mono">
                <span class="text-primary text-xl md:text-2xl mr-2">04.</span>Technical Arsenal
            </h2>
            <div class="h-[1px] bg-slate-700 flex-grow ml-6"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-8 reveal">
                <div>
                    <h3 class="text-xl font-bold text-white mb-4 border-b border-slate-700 pb-2">Backend & Architecture</h3>
                    <div class="flex flex-wrap gap-3 font-mono text-sm">
                        <span class="px-4 py-2 glass-panel text-primary rounded border border-slate-700">PHP 8.x</span>
                        <span class="px-4 py-2 glass-panel text-primary rounded border border-slate-700">MySQL</span>
                        <span class="px-4 py-2 glass-panel text-primary rounded border border-slate-700">WP Plugin API</span>
                        <span class="px-4 py-2 glass-panel text-primary rounded border border-slate-700">RESTful APIs</span>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white mb-4 border-b border-slate-700 pb-2">Frontend Reactivity</h3>
                    <div class="flex flex-wrap gap-3 font-mono text-sm">
                        <span class="px-4 py-2 glass-panel text-white rounded border border-slate-700">JavaScript</span>
                        <span class="px-4 py-2 glass-panel text-white rounded border border-slate-700">Vue.js</span>
                        <span class="px-4 py-2 glass-panel text-white rounded border border-slate-700">Tailwind CSS</span>
                    </div>
                </div>
            </div>

            <div class="glass-panel p-6 rounded-xl border border-slate-700 reveal text-center flex flex-col justify-center">
                <h3 class="text-lg font-mono text-slate-300 mb-6">Development Focus Distribution</h3>
                <div class="chart-container mx-auto">
                    <canvas id="stackChart"></canvas>
                </div>
                <p class="text-xs text-slate-500 mt-4 font-mono">*Estimated distribution.</p>
            </div>
        </div>
    </section>

    <!-- 05. Portfolio Section -->
    <section id="portfolio" class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="flex items-center mb-16 reveal">
            <h2 class="text-3xl font-bold text-white font-mono">
                <span class="text-primary text-xl md:text-2xl mr-2">05.</span>Some Things I've Built
            </h2>
            <div class="h-[1px] bg-slate-700 flex-grow ml-6"></div>
        </div>

        <div class="space-y-24">
            <?php
            $portfolio = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => -1 ) );
            if ( $portfolio->have_posts() ) :
                $counter = 0;
                while ( $portfolio->have_posts() ) : $portfolio->the_post();
                    $tech_stack = get_post_meta( get_the_ID(), 'tech_stack', true ) ?: 'WordPress, PHP';
                    $tech_array = explode( ',', $tech_stack );
                    
                    $is_even = $counter % 2 == 0;
                    ?>
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center reveal group">
                        
                        <?php if ( $is_even ) : ?>
                            <!-- Image Left -->
                            <div class="md:col-span-7 relative h-64 md:h-80 rounded-lg overflow-hidden glass-panel border border-slate-700 flex items-center justify-center bg-gradient-to-br from-slate-800 to-slate-900 group-hover:border-primary/50 transition-colors">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover opacity-50 group-hover:opacity-100 transition-opacity' ) ); ?>
                                <?php else: ?>
                                    <div class="text-center">
                                        <div class="text-5xl mb-2 opacity-50">&#128722;</div>
                                        <span class="font-mono text-slate-500 text-sm tracking-widest">PROJECT_VIEW</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Content Block -->
                        <div class="md:col-span-5 relative z-10 <?php echo $is_even ? 'md:text-right md:-ml-12' : 'md:-mr-12 order-2 md:order-1'; ?>">
                            <p class="font-mono text-primary text-sm mb-2">Featured Project</p>
                            <h3 class="text-2xl font-bold text-white mb-4 hover:text-primary transition-colors cursor-pointer">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="glass-panel p-6 rounded-lg text-slate-400 text-sm leading-relaxed mb-4 shadow-xl border border-slate-700 <?php echo $is_even ? 'md:text-right text-left' : 'text-left'; ?>">
                                <?php the_excerpt(); ?>
                            </div>
                            <ul class="flex flex-wrap <?php echo $is_even ? 'md:justify-end' : ''; ?> gap-4 font-mono text-xs text-slate-300 mb-6">
                                <?php foreach ( $tech_array as $tech ) : ?>
                                    <li><?php echo esc_html( trim( $tech ) ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <?php if ( ! $is_even ) : ?>
                            <!-- Image Right -->
                            <div class="md:col-span-7 relative h-64 md:h-80 rounded-lg overflow-hidden glass-panel border border-slate-700 flex items-center justify-center bg-gradient-to-bl from-slate-800 to-slate-900 group-hover:border-primary/50 transition-colors order-1 md:order-2">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover opacity-50 group-hover:opacity-100 transition-opacity' ) ); ?>
                                <?php else: ?>
                                    <div class="text-center">
                                        <div class="text-5xl mb-2 opacity-50">&#128202;</div>
                                        <span class="font-mono text-slate-500 text-sm tracking-widest">PROJECT_VIEW</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                    <?php
                    $counter++;
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="text-slate-400">No portfolio items found. Add some in the WordPress admin.</p>';
            endif;
            ?>
        </div>
    </section>

    <!-- 06. Contact Section -->
    <section id="contact" class="py-32 px-6 md:px-12 max-w-4xl mx-auto text-center reveal">
        <p class="font-mono text-primary mb-4">06. What's Next?</p>
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Get In Touch</h2>
        <p class="text-lg text-slate-400 mb-10 leading-relaxed max-w-2xl mx-auto">
            I'm currently open for new opportunities. Whether you have a question or just want to say hi, I'll try my best to get back to you!
        </p>
        <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="inline-block px-8 py-4 border border-primary text-primary font-mono rounded hover:bg-primary/10 transition-colors">
            Say Hello
        </a>
    </section>

<?php get_footer(); ?>
