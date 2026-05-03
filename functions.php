<?php
/**
 * Theme functions and definitions
 */

if ( ! defined( 'SYDUR_THEME_VERSION' ) ) {
    define( 'SYDUR_THEME_VERSION', '1.0.0' );
}

/**
 * Setup Theme
 */
function sydur_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'sydur-wp-theme' ),
    ) );
}
add_action( 'after_setup_theme', 'sydur_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function sydur_theme_scripts() {
    wp_enqueue_style( 'sydur-tailwind', get_template_directory_uri() . '/assets/css/tailwind.css', array(), SYDUR_THEME_VERSION );
    wp_enqueue_style( 'sydur-style', get_stylesheet_uri(), array( 'sydur-tailwind' ), SYDUR_THEME_VERSION );
    wp_enqueue_script( 'chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'sydur_theme_scripts' );



/**
 * Register Custom Post Types
 */
function sydur_register_cpts() {
    // Services
    register_post_type( 'service', array(
        'labels'      => array(
            'name'          => __( 'Services', 'sydur-wp-theme' ),
            'singular_name' => __( 'Service', 'sydur-wp-theme' ),
        ),
        'public'      => true,
        'has_archive' => false,
        'supports'    => array( 'title', 'editor', 'excerpt' ),
        'menu_icon'   => 'dashicons-admin-tools',
    ) );

    // Experience
    register_post_type( 'experience', array(
        'labels'      => array(
            'name'          => __( 'Experience', 'sydur-wp-theme' ),
            'singular_name' => __( 'Experience', 'sydur-wp-theme' ),
        ),
        'public'      => true,
        'has_archive' => false,
        'supports'    => array( 'title', 'editor', 'custom-fields' ), // Enabled custom-fields for dates/roles
        'menu_icon'   => 'dashicons-portfolio',
    ) );

    // Portfolio
    register_post_type( 'portfolio', array(
        'labels'      => array(
            'name'          => __( 'Portfolio', 'sydur-wp-theme' ),
            'singular_name' => __( 'Portfolio Item', 'sydur-wp-theme' ),
        ),
        'public'      => true,
        'has_archive' => true,
        'supports'    => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ), // Custom fields for tech stack
        'menu_icon'   => 'dashicons-format-gallery',
    ) );
}
add_action( 'init', 'sydur_register_cpts' );

/**
 * Theme Options Page
 */
function sydur_theme_menu() {
    add_theme_page( 'Theme Options', 'Theme Options', 'manage_options', 'sydur-theme-options', 'sydur_theme_options_page' );
}
add_action( 'admin_menu', 'sydur_theme_menu' );

function sydur_theme_settings_init() {
    register_setting( 'sydur_theme_options', 'sydur_options' );

    add_settings_section( 'sydur_hero_section', 'Hero Settings', null, 'sydur-theme-options' );
    add_settings_field( 'hero_greeting', 'Hero Greeting', 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_hero_section', array( 'label_for' => 'hero_greeting' ) );
    add_settings_field( 'hero_title', 'Hero Title', 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_hero_section', array( 'label_for' => 'hero_title' ) );
    add_settings_field( 'hero_subtitle', 'Hero Subtitle', 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_hero_section', array( 'label_for' => 'hero_subtitle' ) );
    add_settings_field( 'hero_description', 'Hero Description', 'sydur_textarea_field_cb', 'sydur-theme-options', 'sydur_hero_section', array( 'label_for' => 'hero_description' ) );

    add_settings_section( 'sydur_about_section', 'About Settings', null, 'sydur-theme-options' );
    add_settings_field( 'about_text', 'About Me Text (HTML allowed)', 'sydur_textarea_field_cb', 'sydur-theme-options', 'sydur_about_section', array( 'label_for' => 'about_text' ) );
    add_settings_field( 'github_url', 'GitHub URL', 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_about_section', array( 'label_for' => 'github_url' ) );
    add_settings_field( 'linkedin_url', 'LinkedIn URL', 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_about_section', array( 'label_for' => 'linkedin_url' ) );

    add_settings_section( 'sydur_contact_section', 'Contact Settings', null, 'sydur-theme-options' );
    add_settings_field( 'contact_email', 'Contact Email', 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_contact_section', array( 'label_for' => 'contact_email' ) );
}
add_action( 'admin_init', 'sydur_theme_settings_init' );

function sydur_text_field_cb( $args ) {
    $options = get_option( 'sydur_options' );
    $val = isset( $options[ $args['label_for'] ] ) ? $options[ $args['label_for'] ] : '';
    echo '<input type="text" id="' . esc_attr( $args['label_for'] ) . '" name="sydur_options[' . esc_attr( $args['label_for'] ) . ']" value="' . esc_attr( $val ) . '" class="regular-text">';
}

function sydur_textarea_field_cb( $args ) {
    $options = get_option( 'sydur_options' );
    $val = isset( $options[ $args['label_for'] ] ) ? $options[ $args['label_for'] ] : '';
    echo '<textarea id="' . esc_attr( $args['label_for'] ) . '" name="sydur_options[' . esc_attr( $args['label_for'] ) . ']" rows="5" class="large-text">' . esc_textarea( $val ) . '</textarea>';
}

function sydur_theme_options_page() {
    ?>
    <div class="wrap">
        <h1>Sydur Theme Options</h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'sydur_theme_options' );
            do_settings_sections( 'sydur-theme-options' );
            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}

/**
 * Seed Default Content on Theme Activation
 */
function sydur_seed_default_content() {
    if ( get_option( 'sydur_demo_content_imported' ) ) {
        return;
    }

    // 1. Seed Theme Options
    $default_options = array(
        'hero_greeting'    => 'Hi, my name is',
        'hero_title'       => 'Sydur Rahman.',
        'hero_subtitle'    => 'I build things for the web.',
        'hero_description' => "I'm a Full Stack Web Developer specializing in scalable architecture, reactive frontends, and enterprise-grade WordPress plugins. With over 7 years of experience, I turn complex problems into elegant, maintainable code.",
        'about_text'       => "<p>I see myself as a <span class='text-primary'>problem solver first</span>, and a developer second. Coming from a non-IT background with an MBA in Accounting, my journey into development was driven by pure curiosity and an analytical mindset.</p>\n<p>Over the past 7+ years, I've worked deeply with web technologies, specializing in complex backend logic, API integrations, and modern frontends (like Vue.js). I focus on practical solutions and improving systems rather than just writing lines of code.</p>\n<p>I thrive when debugging difficult issues or refactoring legacy architectures to make them reliable and scalable for thousands of active users across diverse server environments.</p>",
        'github_url'       => 'https://github.com',
        'linkedin_url'     => 'https://linkedin.com',
        'contact_email'    => 'hello@sydur.com',
    );
    update_option( 'sydur_options', $default_options );

    // 2. Seed Services
    $services = array(
        array(
            'title'   => 'Advanced Plugin Engineering',
            'content' => 'Developing scalable, secure, and highly optimized WordPress plugins from scratch. I build tools intended for mass distribution or highly specific enterprise use-cases.',
        ),
        array(
            'title'   => 'Reactive Frontend UI',
            'content' => 'Bridging the gap between robust backends and smooth user experiences. I integrate modern JavaScript frameworks like Vue.js and Vanilla JS to create seamless, app-like interfaces.',
        ),
        array(
            'title'   => 'Legacy Code Refactoring',
            'content' => 'Auditing, debugging, and modernizing old codebases. I resolve complex conflicts, improve database query efficiency, and ensure systems are maintainable for the future.',
        ),
    );

    foreach ( $services as $service ) {
        wp_insert_post( array(
            'post_type'    => 'service',
            'post_title'   => $service['title'],
            'post_excerpt' => $service['content'],
            'post_status'  => 'publish',
        ) );
    }

    // 3. Seed Experience
    $experiences = array(
        array(
            'title'    => 'Full Stack / WordPress Developer @ Premio.com',
            'duration' => 'April 2025 - Feb 2026',
            'location' => 'Remote',
            'content'  => "<ul>\n<li>Managed and enhanced complex existing applications and internal sites.</li>\n<li>Developed new features and debugged critical website issues using modern standards.</li>\n<li>Utilized PHP for robust backend logic and Vue.js for creating dynamic, reactive user interfaces.</li>\n</ul>",
        ),
        array(
            'title'    => 'WordPress Plugin Engineer @ Themefic.com',
            'duration' => 'July 2022 - Present',
            'location' => 'Full-time',
            'content'  => "<ul>\n<li>Engineered new premium plugins and scaled existing features for a large user base.</li>\n<li>Created custom functionality for enterprise clients and provided deep technical support.</li>\n<li>Participated in team architecture planning to solve challenging data structures.</li>\n</ul>",
        ),
        array(
            'title'    => 'Junior Web Developer @ Smart Framework',
            'duration' => 'Nov 2020 - Jun 2022',
            'location' => 'Full-time',
            'content'  => "<ul>\n<li>Designed and developed end-to-end client web projects focusing on robust functionality.</li>\n<li>Handled ongoing site maintenance, database optimization, and client communication.</li>\n</ul>",
        ),
    );

    foreach ( $experiences as $exp ) {
        $post_id = wp_insert_post( array(
            'post_type'   => 'experience',
            'post_title'  => $exp['title'],
            'post_content'=> $exp['content'],
            'post_status' => 'publish',
        ) );
        if ( ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, 'duration', $exp['duration'] );
            update_post_meta( $post_id, 'location', $exp['location'] );
        }
    }

    // 4. Seed Portfolio
    $portfolios = array(
        array(
            'title'      => 'Premium Checkout Extension',
            'excerpt'    => 'A highly scalable WordPress plugin designed to optimize the checkout flow. Built a reactive frontend dashboard using Vue.js communicating with secure custom REST API endpoints to handle complex pricing matrices without page reloads.',
            'tech_stack' => 'Vue.js, PHP 8, WP REST API, MySQL',
        ),
        array(
            'title'      => 'Support Ticket Automator',
            'excerpt'    => 'Developed an internal management system to automate client support ticket routing based on issue complexity and plugin type. Utilized custom database tables to handle large datasets efficiently outside standard WP posts structure.',
            'tech_stack' => 'Vanilla JS, PHP, Custom SQL, Cron Jobs',
        ),
    );

    foreach ( $portfolios as $portfolio ) {
        $post_id = wp_insert_post( array(
            'post_type'    => 'portfolio',
            'post_title'   => $portfolio['title'],
            'post_excerpt' => $portfolio['excerpt'],
            'post_status'  => 'publish',
        ) );
        if ( ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, 'tech_stack', $portfolio['tech_stack'] );
        }
    }

    // Mark as imported
    update_option( 'sydur_demo_content_imported', true );
}
add_action( 'after_switch_theme', 'sydur_seed_default_content' );

