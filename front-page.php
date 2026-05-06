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

// Retrieve dynamic headings from options
$about_heading = isset($options['about_heading']) && !empty($options['about_heading']) ? $options['about_heading'] : 'About Me';
$services_heading = isset($options['services_heading']) && !empty($options['services_heading']) ? $options['services_heading'] : "What I Do";
$experience_heading = isset($options['experience_heading']) && !empty($options['experience_heading']) ? $options['experience_heading'] : "Where I've Worked";
$skills_heading = isset($options['skills_heading']) && !empty($options['skills_heading']) ? $options['skills_heading'] : "Technical Arsenal";
$portfolio_heading = isset($options['portfolio_heading']) && !empty($options['portfolio_heading']) ? $options['portfolio_heading'] : "Some Things I've Built";
$contact_heading = isset($options['contact_heading']) && !empty($options['contact_heading']) ? $options['contact_heading'] : "What's Next?";
 
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
    <?php if ( empty( $options['hide_about'] ) ) : ?>
    <section id="about" class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="flex items-center mb-12 reveal">
            <h2 class="text-3xl font-bold text-white font-mono">
                <span class="text-primary text-xl md:text-2xl mr-2">01.</span><?php echo esc_html( $about_heading ); ?>
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
  <span class="text-primary">skills:</span> [
    <span class="text-green-400">'WordPress'</span>, <span class="text-green-400">'PHP'</span>, <span class="text-green-400">'Vue.js'</span>, <span class="text-green-400">'Tailwind'</span>
  ],
  <span class="text-primary">isAvailableForHire:</span> <span class="text-blue-400">true</span>
};
</pre>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- 02. Services Section -->
    <?php if ( empty( $options['hide_services'] ) ) : ?>
    <section id="services" class="py-24 px-6 md:px-12 max-w-7xl mx-auto relative overflow-hidden">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary/5 rounded-full blur-[120px] pointer-events-none -z-10"></div>
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 reveal">
            <div>
                <h2 class="text-3xl font-bold text-white font-mono mb-4">
                    <span class="text-primary text-xl md:text-2xl mr-2">02.</span><?php echo esc_html( $services_heading ); ?>
                </h2>
                <p class="text-slate-400 max-w-md">Specialized solutions tailored for high-performance WordPress ecosystems.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $services = new WP_Query( array( 'post_type' => 'service', 'posts_per_page' => 6 ) );
            if ( $services->have_posts() ) :
                $delay = 0;
                while ( $services->have_posts() ) : $services->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="glass-panel p-10 rounded-3xl reveal hover:-translate-y-2 transition-all duration-500 group border border-slate-700/50 hover:border-primary/40 flex flex-col h-full" style="transition-delay: <?php echo esc_attr( $delay ); ?>ms;">
                        <div class="flex justify-between items-start mb-8">
                            <div class="text-4xl text-slate-500 group-hover:text-primary transition-colors transform group-hover:rotate-12 duration-500">&#9881;</div>
                            <span class="text-[10px] font-mono text-slate-600 uppercase tracking-widest bg-slate-800/50 px-3 py-1 rounded-full">Service</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-primary transition-colors">
                            <?php the_title(); ?>
                        </h3>
                        <div class="text-slate-400 text-sm leading-relaxed mb-8 flex-grow">
                            <?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
                        </div>
                        <div class="flex items-center gap-2 text-white font-bold text-sm uppercase tracking-tighter">
                            Inquire Now
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </a>
                    <?php
                    $delay += 100;
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        
        <div class="mt-16 text-center reveal">
            <a href="<?php echo esc_url( isset($options['services_more_link']) && !empty($options['services_more_link']) ? $options['services_more_link'] : get_post_type_archive_link( 'service' ) ); ?>" class="inline-block px-8 py-3 border border-slate-700 text-slate-300 rounded hover:border-primary hover:text-primary transition-all font-mono text-sm">
                View All Services →
            </a>
        </div>
    </section>
    <?php endif; ?>

    <!-- Case Studies Section -->
    <?php if ( empty( $options['hide_case_study'] ) ) : ?>
    <section id="case-studies" class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="flex items-center mb-16 reveal">
            <h2 class="text-3xl font-bold text-white font-mono">
                <span class="text-primary text-xl md:text-2xl mr-2">03.</span><?php echo esc_html( isset($options['case_study_heading']) ? $options['case_study_heading'] : 'Deep Dives' ); ?>
            </h2>
            <div class="h-[1px] bg-slate-700 flex-grow ml-6"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <?php
            $case_studies = new WP_Query( array( 'post_type' => 'case_study', 'posts_per_page' => 2 ) );
            if ( $case_studies->have_posts() ) :
                while ( $case_studies->have_posts() ) : $case_studies->the_post();
                    ?>
                    <article class="group reveal relative">
                        <a href="<?php the_permalink(); ?>" class="block">
                            <div class="relative h-[400px] rounded-3xl overflow-hidden border border-slate-700/50 mb-8 bg-slate-800 shadow-2xl">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-700' ) ); ?>
                                <?php endif; ?>
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
                                <div class="absolute bottom-8 left-8 right-8">
                                    <span class="text-primary font-mono text-xs uppercase tracking-widest block mb-2">Featured Project</span>
                                    <h3 class="text-3xl font-extrabold text-white group-hover:text-primary transition-colors"><?php the_title(); ?></h3>
                                </div>
                            </div>
                            <div class="flex justify-between items-center px-2">
                                <p class="text-slate-400 text-sm italic"><?php echo esc_html( get_post_meta( get_the_ID(), 'results', true ) ?: 'Success Story' ); ?></p>
                                <span class="text-white font-mono text-xs group-hover:underline">View Details →</span>
                            </div>
                        </a>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        
        <div class="mt-20 text-center reveal">
            <a href="<?php echo esc_url( isset($options['case_study_more_link']) && !empty($options['case_study_more_link']) ? $options['case_study_more_link'] : get_post_type_archive_link( 'case_study' ) ); ?>" class="inline-block px-8 py-3 border border-slate-700 text-slate-300 rounded hover:border-primary hover:text-primary transition-all font-mono text-sm">
                Explore All Case Studies
            </a>
        </div>
    </section>
    <?php endif; ?>

    <!-- 04. Experience Section -->
    <?php if ( empty( $options['hide_experience'] ) ) : ?>
    <section id="experience" class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="flex items-center mb-16 reveal">
            <h2 class="text-3xl font-bold text-white font-mono">
                <span class="text-primary text-xl md:text-2xl mr-2">04.</span><?php echo esc_html( $experience_heading ); ?>
            </h2>
            <div class="h-[1px] bg-slate-700 flex-grow ml-6"></div>
        </div>

        <div class="relative border-l border-slate-700 ml-3 md:ml-6 space-y-12 mb-16">
            <?php
            $experience = new WP_Query( array( 'post_type' => 'experience', 'posts_per_page' => 3 ) );
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
            endif;
            ?>
        </div>

        <div class="text-center reveal">
            <a href="<?php echo esc_url( isset($options['experience_more_link']) && !empty($options['experience_more_link']) ? $options['experience_more_link'] : '#' ); ?>" class="text-primary font-mono text-sm hover:underline">Full Resume / Experience History →</a>
        </div>
    </section>
    <?php endif; ?>

    <!-- 05. Technical Arsenal Section -->
    <?php if ( empty( $options['hide_skills'] ) ) : ?>
    <section id="skills" class="py-32 px-6 md:px-12 max-w-7xl mx-auto relative">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary/10 rounded-full blur-[150px] -z-10 animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-500/10 rounded-full blur-[150px] -z-10"></div>

        <div class="text-center mb-20 reveal">
            <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-6">
                <span class="text-primary font-mono text-xl block mb-2">05. Capabilities</span>
                <?php echo esc_html( $skills_heading ); ?>
            </h2>
            <p class="text-slate-400 max-w-2xl mx-auto text-lg leading-relaxed">
                A specialized toolkit forged through years of building complex WordPress ecosystems and reactive web applications.
            </p>
        </div>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-6 gap-6 reveal">
            
            <!-- Large Hero Card: Core Backend -->
            <div class="col-span-1 md:col-span-6 lg:col-span-4 glass-panel p-6 md:p-10 rounded-3xl border border-slate-700/50 flex flex-col justify-between group hover:border-primary/40 transition-all duration-500 hover:shadow-[0_0_50px_-12px_rgba(34,211,238,0.2)]">
                <div>
                    <div class="flex items-center justify-between mb-8">
                        <div class="p-3 bg-primary/10 rounded-2xl text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                            </svg>
                        </div>
                        <span class="font-mono text-[10px] md:text-xs text-slate-500 uppercase tracking-tighter">Backend Architecture</span>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">Scalable PHP Systems</h3>
                    <p class="text-slate-400 mb-8 max-w-md text-sm md:text-base">Building robust, enterprise-grade backends with a focus on performance, security, and developer experience.</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1.5 md:px-4 md:py-2 bg-slate-800/50 rounded-xl text-primary font-mono text-xs md:text-sm border border-slate-700/30">PHP 8.3</span>
                    <span class="px-3 py-1.5 md:px-4 md:py-2 bg-slate-800/50 rounded-xl text-primary font-mono text-xs md:text-sm border border-slate-700/30">OOP/Patterns</span>
                    <span class="px-3 py-1.5 md:px-4 md:py-2 bg-slate-800/50 rounded-xl text-primary font-mono text-xs md:text-sm border border-slate-700/30">MySQL</span>
                    <span class="px-3 py-1.5 md:px-4 md:py-2 bg-slate-800/50 rounded-xl text-primary font-mono text-xs md:text-sm border border-slate-700/30">Laravel</span>
                </div>
            </div>

            <!-- Square Card: WP Expertise -->
            <div class="col-span-1 md:col-span-3 lg:col-span-2 glass-panel p-6 md:p-8 rounded-3xl border border-slate-700/50 hover:border-blue-400/40 transition-all duration-500 group">
                <div class="p-3 bg-blue-500/10 rounded-2xl text-blue-400 w-fit mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">WP Plugin Mastery</h3>
                <p class="text-slate-500 text-sm mb-6">Custom CPTs, Gutenberg blocks, and REST API integration.</p>
                <div class="space-y-3">
                    <div class="h-1.5 w-full bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-400 w-[95%]"></div>
                    </div>
                    <div class="flex justify-between text-[10px] font-mono text-slate-500 uppercase tracking-widest">
                        <span>Plugin API</span>
                        <span>95%</span>
                    </div>
                </div>
            </div>

            <!-- Chart Card: Radar Stats -->
            <div class="col-span-1 md:col-span-6 lg:col-span-3 glass-panel p-6 md:p-8 rounded-3xl border border-slate-700/50 lg:order-last">
                <div class="flex items-center justify-between mb-6">
                    <h4 class="text-white font-bold">Skill Distribution</h4>
                    <div class="w-2 h-2 rounded-full bg-green-500 shadow-[0_0_10px_#22c55e]"></div>
                </div>
                <div class="h-64 md:h-72">
                    <canvas id="stackChart"></canvas>
                </div>
            </div>

            <!-- Long Card: Frontend Reactivity -->
            <div class="col-span-1 md:col-span-3 lg:col-span-3 glass-panel p-6 md:p-8 rounded-3xl border border-slate-700/50 flex flex-col justify-between hover:border-purple-500/40 transition-all duration-500">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold text-white mb-2">Modern Frontends</h3>
                        <p class="text-slate-400 text-sm mb-6">Reactive interfaces that feel like native apps.</p>
                    </div>
                    <div class="p-3 bg-purple-500/10 rounded-2xl text-purple-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-slate-800/30 rounded-2xl border border-slate-700/30 hover:bg-slate-800/50 transition-colors">
                        <div class="text-purple-400 font-bold mb-1 text-sm md:text-base">Vue.js</div>
                        <div class="text-[10px] text-slate-500 font-mono">Composition API</div>
                    </div>
                    <div class="p-4 bg-slate-800/30 rounded-2xl border border-slate-700/30 hover:bg-slate-800/50 transition-colors">
                        <div class="text-cyan-400 font-bold mb-1 text-sm md:text-base">Tailwind</div>
                        <div class="text-[10px] text-slate-500 font-mono">Utility Design</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- 06. Portfolio Section -->
    <?php if ( empty( $options['hide_portfolio'] ) ) : ?>
    <section id="portfolio" class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="flex items-center mb-16 reveal">
            <h2 class="text-3xl font-bold text-white font-mono">
                <span class="text-primary text-xl md:text-2xl mr-2">06.</span><?php echo esc_html( $portfolio_heading ); ?>
            </h2>
            <div class="h-[1px] bg-slate-700 flex-grow ml-6"></div>
        </div>

        <div class="space-y-24 mb-16">
            <?php
            $portfolio = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => 3 ) );
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
            endif;
            ?>
        </div>

        <div class="text-center reveal">
            <a href="<?php echo esc_url( isset($options['portfolio_more_link']) && !empty($options['portfolio_more_link']) ? $options['portfolio_more_link'] : get_post_type_archive_link( 'portfolio' ) ); ?>" class="inline-block px-8 py-3 border border-slate-700 text-slate-300 rounded hover:border-primary hover:text-primary transition-all font-mono text-sm">
                View All Projects →
            </a>
        </div>
    </section>
    <?php endif; ?>

    <!-- 07. Contact Section -->
    <?php if ( empty( $options['hide_contact'] ) ) : ?>
    <section id="contact" class="py-32 px-6 md:px-12 max-w-4xl mx-auto text-center reveal">
        <p class="font-mono text-primary mb-4">07. <?php echo esc_html( $contact_heading ); ?></p>
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Get In Touch</h2>
        <p class="text-lg text-slate-400 mb-10 leading-relaxed max-w-2xl mx-auto">
            I'm currently open for new opportunities. Whether you have a question or just want to say hi, I'll try my best to get back to you!
        </p>
        <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="inline-block px-8 py-4 border border-primary text-primary font-mono rounded hover:bg-primary/10 transition-colors">
            Say Hello
        </a>
    </section>
    <?php endif; ?>


<?php get_footer(); ?>

