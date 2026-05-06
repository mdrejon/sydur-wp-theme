<?php

/**
 * Theme functions and definitions
 */

if (! defined('SYDUR_THEME_VERSION')) {
    define('SYDUR_THEME_VERSION', '1.0.2');
}

/**
 * Setup Theme
 */
function sydur_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus(array(
        'primary'   => esc_html__('Primary Menu', 'sydur-wp-theme'),
        'secondary' => esc_html__('Secondary Menu', 'sydur-wp-theme'),
        'footer'    => esc_html__('Footer Menu', 'sydur-wp-theme'),
    ));
}
add_action('after_setup_theme', 'sydur_theme_setup');

/**
 * Enqueue scripts and styles.
 */
function sydur_theme_scripts()
{
    wp_enqueue_style('sydur-tailwind', get_template_directory_uri() . '/assets/css/tailwind.css', array(), SYDUR_THEME_VERSION);
    wp_enqueue_style('sydur-style', get_stylesheet_uri(), array('sydur-tailwind'), SYDUR_THEME_VERSION);
    wp_enqueue_script('chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'sydur_theme_scripts');

/**
 * Enqueue admin styles
 */
function sydur_admin_styles($hook)
{
    if ('appearance_page_sydur-theme-options' !== $hook) {
        return;
    }
?>
    <style>
        .sydur-options-wrap {
            max-width: 1000px;
            margin: 20px 0;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .sydur-options-wrap h1 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 30px;
            color: #1d2327;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
            letter-spacing: -0.02em;
        }

        .sydur-options-wrap h2 {
            font-size: 18px;
            margin: 40px 0 20px;
            padding: 12px 18px;
            background: #f1f5f9;
            border-left: 4px solid #22d3ee;
            color: #1e293b;
            border-radius: 0 6px 6px 0;
            font-weight: 600;
        }

        .form-table th {
            width: 250px;
            padding: 20px 10px 20px 0;
            font-weight: 600;
            color: #475569;
        }

        .form-table td {
            padding: 15px 10px;
        }

        /* Switch/Toggle Styling */
        .sydur-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .sydur-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .sydur-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .sydur-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.sydur-slider {
            background-color: #22d3ee;
        }

        input:focus+.sydur-slider {
            box-shadow: 0 0 1px #22d3ee;
        }

        input:checked+.sydur-slider:before {
            transform: translateX(26px);
        }

        .regular-text {
            width: 100%;
            max-width: 500px;
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 8px 12px;
        }

        .wp-editor-wrap {
            max-width: 700px;
        }
    </style>
<?php
}
add_action('admin_enqueue_scripts', 'sydur_admin_styles');



/**
 * Register Custom Post Types
 */
function sydur_register_cpts()
{
    // Services
    register_post_type('service', array(
        'labels'      => array(
            'name'          => __('Services', 'sydur-wp-theme'),
            'singular_name' => __('Service', 'sydur-wp-theme'),
        ),
        'public'      => true,
        'has_archive' => true,
        'supports'    => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'   => 'dashicons-admin-tools',
        'rewrite'     => array('slug' => 'services'),
    ));

    // Case Studies
    register_post_type('case_study', array(
        'labels'      => array(
            'name'          => __('Case Studies', 'sydur-wp-theme'),
            'singular_name' => __('Case Study', 'sydur-wp-theme'),
        ),
        'public'      => true,
        'has_archive' => true,
        'supports'    => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'   => 'dashicons-media-document',
        'rewrite'     => array('slug' => 'case-studies'),
    ));

    // Experience
    register_post_type('experience', array(
        'labels'      => array(
            'name'          => __('Experience', 'sydur-wp-theme'),
            'singular_name' => __('Experience', 'sydur-wp-theme'),
        ),
        'public'      => true,
        'has_archive' => false,
        'supports'    => array('title', 'editor', 'custom-fields'), // Enabled custom-fields for dates/roles
        'menu_icon'   => 'dashicons-portfolio',
    ));

    // Portfolio
    register_post_type('portfolio', array(
        'labels'      => array(
            'name'          => __('Portfolio', 'sydur-wp-theme'),
            'singular_name' => __('Portfolio Item', 'sydur-wp-theme'),
        ),
        'public'      => true,
        'has_archive' => true,
        'supports'    => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'), // Custom fields for tech stack
        'menu_icon'   => 'dashicons-format-gallery',
    ));
}
add_action('init', 'sydur_register_cpts');

/**
 * Theme Options Page
 */
function sydur_theme_menu()
{
    add_theme_page('Theme Options', 'Theme Options', 'manage_options', 'sydur-theme-options', 'sydur_theme_options_page');
}
add_action('admin_menu', 'sydur_theme_menu');

function sydur_theme_settings_init()
{
    register_setting('sydur_theme_options', 'sydur_options');

    add_settings_section('sydur_header_section', 'Header Settings', null, 'sydur-theme-options');
    add_settings_field('header_button_label', 'Header Button Label', 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_header_section', array('label_for' => 'header_button_label', 'placeholder' => 'Hire Me'));
    add_settings_field('header_button_link', 'Header Button Link', 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_header_section', array('label_for' => 'header_button_link', 'placeholder' => '#contact'));
    add_settings_field('header_button_target', 'Open Link in New Tab', 'sydur_checkbox_field_cb', 'sydur-theme-options', 'sydur_header_section', array('label_for' => 'header_button_target'));

    add_settings_section('sydur_hero_section', 'Hero Settings', null, 'sydur-theme-options');
    add_settings_field('hero_greeting', 'Hero Greeting', 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_hero_section', array('label_for' => 'hero_greeting', 'placeholder' => 'Hi, my name is'));
    add_settings_field('hero_title', 'Hero Title', 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_hero_section', array('label_for' => 'hero_title', 'placeholder' => 'Sydur Rahman.'));
    add_settings_field('hero_subtitle', 'Hero Subtitle', 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_hero_section', array('label_for' => 'hero_subtitle', 'placeholder' => 'I build things for the web.'));
    add_settings_field('hero_description', 'Hero Description', 'sydur_textarea_field_cb', 'sydur-theme-options', 'sydur_hero_section', array('label_for' => 'hero_description', 'placeholder' => 'Brief description about yourself...'));

    add_settings_section('sydur_about_section', 'About Settings', null, 'sydur-theme-options');
    add_settings_field('about_text', 'About Me Text (HTML allowed)', 'sydur_textarea_field_cb', 'sydur-theme-options', 'sydur_about_section', array('label_for' => 'about_text', 'placeholder' => 'Tell your story...'));
    add_settings_field('github_url', 'GitHub URL', 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_about_section', array('label_for' => 'github_url', 'placeholder' => 'https://github.com/yourusername'));
    add_settings_field('linkedin_url', 'LinkedIn URL', 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_about_section', array('label_for' => 'linkedin_url', 'placeholder' => 'https://linkedin.com/in/yourusername'));

    add_settings_section('sydur_contact_section', 'Contact Settings', null, 'sydur-theme-options');
    add_settings_field('contact_email', 'Contact Email', 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_contact_section', array('label_for' => 'contact_email', 'placeholder' => 'hello@sydur.com'));
    add_settings_field('service_form_shortcode', 'Service Form Shortcode (CF7)', 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_contact_section', array('label_for' => 'service_form_shortcode', 'placeholder' => '[contact-form-7 id="..." title="..."]'));
    // Section Headings
    add_settings_section('sydur_headings_section', 'Section Headings', null, 'sydur-theme-options');
    $headings = array(
        'about_heading'      => 'About Section Heading',
        'services_heading'   => 'Services Section Heading',
        'experience_heading' => 'Experience Section Heading',
        'skills_heading'     => 'Skills Section Heading',
        'portfolio_heading'  => 'Portfolio Section Heading',
        'case_study_heading' => 'Case Study Section Heading',
        'contact_heading'    => 'Contact Section Heading',
    );
    foreach ($headings as $key => $label) {
        add_settings_field($key, $label, 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_headings_section', array('label_for' => $key, 'placeholder' => $label));
    }

    // Visibility and Links Section
    add_settings_section('sydur_visibility_section', 'Section Visibility & Links', null, 'sydur-theme-options');
    $sections = array(
        'about'        => 'About Section',
        'services'     => 'Services Section',
        'case_study'   => 'Case Study Section',
        'experience'   => 'Experience Section',
        'skills'       => 'Skills Section',
        'portfolio'    => 'Portfolio Section',
        'contact'      => 'Contact Section',
    );
    foreach ($sections as $id => $label) {
        add_settings_field('hide_' . $id, 'Hide ' . $label, 'sydur_checkbox_field_cb', 'sydur-theme-options', 'sydur_visibility_section', array('label_for' => 'hide_' . $id));
        if (in_array($id, array('services', 'case_study', 'experience', 'portfolio'))) {
            add_settings_field($id . '_more_link', $label . ' "View More" Link', 'sydur_text_field_cb', 'sydur-theme-options', 'sydur_visibility_section', array('label_for' => $id . '_more_link', 'placeholder' => 'https://...'));
        }
    }
}
add_action('admin_init', 'sydur_theme_settings_init');

function sydur_checkbox_field_cb($args)
{
    $options = get_option('sydur_options');
    $val = isset($options[$args['label_for']]) ? (bool) $options[$args['label_for']] : false;
?>
    <label class="sydur-switch">
        <input type="checkbox" id="<?php echo esc_attr($args['label_for']); ?>" name="sydur_options[<?php echo esc_attr($args['label_for']); ?>]" value="1" <?php checked(1, $val); ?>>
        <span class="sydur-slider"></span>
    </label>
<?php
}

function sydur_text_field_cb($args)
{
    $options = get_option('sydur_options');
    $val = isset($options[$args['label_for']]) ? $options[$args['label_for']] : '';
    $placeholder = isset($args['placeholder']) ? $args['placeholder'] : '';
    echo '<input type="text" id="' . esc_attr($args['label_for']) . '" name="sydur_options[' . esc_attr($args['label_for']) . ']" value="' . esc_attr($val) . '" placeholder="' . esc_attr($placeholder) . '" class="regular-text">';
}

function sydur_textarea_field_cb($args)
{
    $options = get_option('sydur_options');
    $val = isset($options[$args['label_for']]) ? $options[$args['label_for']] : '';
    $placeholder = isset($args['placeholder']) ? $args['placeholder'] : '';

    // Check if we should use WP Editor or simple textarea
    if (in_array($args['label_for'], array('hero_description', 'about_text'))) {
        wp_editor($val, $args['label_for'], array(
            'textarea_name' => 'sydur_options[' . $args['label_for'] . ']',
            'textarea_rows' => 10,
            'media_buttons' => true,
            'tinymce'       => array(
                'toolbar1' => 'bold,italic,underline,separator,bullist,numlist,separator,link,unlink,separator,undo,redo',
                'placeholder' => $placeholder, // TinyMCE placeholder support might vary
            ),
        ));
    } else {
        echo '<textarea id="' . esc_attr($args['label_for']) . '" name="sydur_options[' . esc_attr($args['label_for']) . ']" rows="5" placeholder="' . esc_attr($placeholder) . '" class="large-text">' . esc_textarea($val) . '</textarea>';
    }
}

/**
 * Walker that prepends numeric prefixes to menu items.
 */
class Sydur_Numbered_Walker_Nav_Menu extends Walker_Nav_Menu
{
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        // Use menu order for numbering (starting at 1) and pad to two digits.
        $number = str_pad($item->menu_order, 2, '0', STR_PAD_LEFT);
        $prefix = '<span class="text-primary">' . $number . '.</span> ';
        $item->title = $prefix . $item->title;
        parent::start_el($output, $item, $depth, $args, $id);
    }
}

function sydur_theme_options_page()
{
?>
    <div class="wrap">
        <div class="sydur-options-wrap">
            <h1>Sydur Theme Options</h1>
            <form action="options.php" method="post">
                <?php
                settings_fields('sydur_theme_options');
                // Custom sections rendering to avoid default h2/h3 styles if needed, 
                // but we'll stick to do_settings_sections and style them via CSS.
                do_settings_sections('sydur-theme-options');
                submit_button('Save All Changes', 'primary large');
                ?>
            </form>
        </div>
    </div>
<?php
}

/**
 * Seed Default Content on Theme Activation
 */
function sydur_seed_default_content()
{
    if (get_option('sydur_demo_content_imported')) {
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
        'header_button_label' => 'Hire Me',
        'header_button_link'  => '#contact',
        'header_button_target' => 0,
        'service_form_shortcode' => '[contact-form-7 id="service-inquiry" title="Service Inquiry Form"]',
    );
    update_option('sydur_options', $default_options);

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

    foreach ($services as $service) {
        wp_insert_post(array(
            'post_type'    => 'service',
            'post_title'   => $service['title'],
            'post_excerpt' => $service['content'],
            'post_status'  => 'publish',
        ));
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

    foreach ($experiences as $exp) {
        $post_id = wp_insert_post(array(
            'post_type'   => 'experience',
            'post_title'  => $exp['title'],
            'post_content' => $exp['content'],
            'post_status' => 'publish',
        ));
        if (! is_wp_error($post_id)) {
            update_post_meta($post_id, 'duration', $exp['duration']);
            update_post_meta($post_id, 'location', $exp['location']);
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

    foreach ($portfolios as $portfolio) {
        $post_id = wp_insert_post(array(
            'post_type'    => 'portfolio',
            'post_title'   => $portfolio['title'],
            'post_excerpt' => $portfolio['excerpt'],
            'post_status'  => 'publish',
        ));
        if (! is_wp_error($post_id)) {
            update_post_meta($post_id, 'tech_stack', $portfolio['tech_stack']);
        }
    }

    // Mark as imported
    update_option('sydur_demo_content_imported', true);
}
add_action('after_switch_theme', 'sydur_seed_default_content');
