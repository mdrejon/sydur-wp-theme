<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'font-sans antialiased relative selection:bg-primary selection:text-slate-900' ); ?>>

    <!-- Background Elements -->
    <div class="fixed inset-0 z-[-1] bg-grid opacity-30"></div>
    <div class="fixed top-0 left-1/4 w-96 h-96 bg-primary/20 rounded-full mix-blend-multiply filter blur-[128px] animate-blob z-[-1]"></div>
    <?php if ( is_front_page() ) : ?>
    <div class="fixed top-0 right-1/4 w-96 h-96 bg-blue-500/20 rounded-full mix-blend-multiply filter blur-[128px] animate-blob animation-delay-2000 z-[-1]"></div>
    <?php endif; ?>

    <!-- Navigation -->
    <nav id="navbar" class="fixed w-full z-50 transition-all duration-300 py-4 <?php echo is_front_page() ? '' : 'glass-panel shadow-md border-b border-slate-800'; ?>">
        <div class="max-w-7xl mx-auto px-6 md:px-12 flex justify-between items-center">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-bold text-white tracking-tighter flex items-center gap-1 group">
                <span class="text-primary group-hover:text-white transition-colors">&lt;</span>
                SR<span class="text-primary font-mono text-xl">/</span>
                <span class="text-primary group-hover:text-white transition-colors">&gt;</span>
            </a>
            
            <!-- Desktop Nav -->
            <div class="hidden lg:flex items-center font-mono text-sm primary-menu-container">
                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'desktop-menu',
                        'fallback_cb'    => false,
                        'walker'         => new Sydur_Numbered_Walker_Nav_Menu(),
                    ) );
                } else {
                    echo '<p class="text-slate-500">Please assign a menu in Appearance -> Menus</p>';
                }
                ?>
                <?php 
                $options = get_option( 'sydur_options' );
                $btn_label = ! empty( $options['header_button_label'] ) ? $options['header_button_label'] : __( 'Hire Me', 'sydur-wp-theme' );
                $btn_link  = ! empty( $options['header_button_link'] ) ? $options['header_button_link'] : '#contact';
                $btn_target = ! empty( $options['header_button_target'] ) ? 'target="_blank"' : '';
                ?>
                <a
                href="<?php echo esc_url( $btn_link ); ?>"
                class="px-4 py-2 border border-primary text-primary rounded hover:bg-primary/10 transition-colors ml-4"
                <?php echo $btn_target; ?>
                ><?php echo esc_html( $btn_label ); ?></a> 
            </div>

            <!-- Mobile Menu Button -->
            <button class="lg:hidden text-slate-300 hover:text-white text-3xl leading-none" id="mobile-menu-btn">&#9776;</button>
        </div>
        
        <!-- Mobile Nav Dropdown -->
        <div id="mobile-menu" class="hidden lg:hidden glass-panel absolute top-full left-0 w-full flex flex-col items-center py-6 font-mono text-sm shadow-xl border-b border-slate-700">
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'mobile-menu',
                    'fallback_cb'    => false,
                ) );
            } else {
                echo '<p class="text-slate-500">Please assign a menu.</p>';
            }
            ?>
        </div>
    </nav>
