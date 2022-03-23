<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Slicko
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function slicko_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( !is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if ( !is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    // add a classs when box layout selected.
    $page_layout = get_theme_mod( 'slicko_site_layout', 'fullwidth_layout' );
    if ( 'boxed_layout' === $page_layout ) {
        $classes[] = 'box-layout-page';
    }

    return $classes;
}
add_filter( 'body_class', 'slicko_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function slicko_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'slicko_pingback_header' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function slicko_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'slicko' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'slicko' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );

    if ( class_exists( 'WooCommerce' ) ):

        register_sidebar(
            array(
                'name'          => esc_html__( 'Products Sidebar', 'slicko' ),
                'id'            => 'product-sidebar',
                'description'   => esc_html__( 'Add widgets here.', 'slicko' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )
        );

    endif;

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer Widget Area', 'slicko' ),
            'id'            => 'footer-widget-area',
            'description'   => esc_html__( 'Add widgets here.', 'slicko' ),
            'before_widget' => '<section id="%1$s" class="slicko-footer-widget widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'slicko_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function slicko_scripts() {

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'slicko-fonts', slicko_fonts_url(), array(), null );
    // Add Themify icons, used in the main stylesheet.
    wp_enqueue_style( 'themify-icons', get_template_directory_uri() . '/assets/vendor/themify-icons/themify-icons.css', array(), wp_get_theme()->get( 'Version' ) );
    // Add Fontawesome icons, used in the main stylesheet.
    wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/assets/css/all.min.css' ), array(), '4.7.0' );

    wp_enqueue_style( 'select2-min', get_theme_file_uri( '/assets/css/select2.min.css' ), array(), true );
    wp_enqueue_style( 'nice-select', get_theme_file_uri( '/assets/css/nice-select.min.css' ), array(), 'null' );

    // Add Grid styles files.
    wp_dequeue_style( 'grid' );
    wp_enqueue_style( 'grid', get_template_directory_uri() . '/assets/css/grid.css', array(), wp_get_theme()->get( 'Version' ) );
    // Add Theme styles files.
    wp_dequeue_style( 'theme-style' );
    wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/assets/css/theme-style.css', array(), wp_get_theme()->get( 'Version' ) );
    // Add Dashicons.
    wp_enqueue_style( 'dashicons' );
    // Add Slicko main styles files.
    wp_enqueue_style( 'slicko-main', get_template_directory_uri() . '/assets/css/slicko-style.css', array(), wp_get_theme()->get( 'Version' ) );
    // Theme stylesheet.
    wp_enqueue_style( 'slicko-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
    // Add Slicko mairesponsiven styles files.
    wp_enqueue_style( 'slicko-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_style( 'slicko-gutenberg', get_template_directory_uri() . '/assets/css/gutenberg.css', array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_script('slicko-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), wp_get_theme()->get( 'Version' ), true );

    wp_enqueue_script( 'jquery-masonry' );
    wp_enqueue_script( 'select2-min-js', get_theme_file_uri( '/assets/js/select2.min.js' ), array( 'jquery' ), null, true );
    wp_enqueue_script( 'nice-select', get_theme_file_uri( '/assets/js/jquery.nice-select.min.js' ), array( 'jquery' ), null, true );
    wp_enqueue_script( 'slicko-config', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
    wp_enqueue_script( 'slicko-touch-navigation', get_template_directory_uri() . '/assets/js/touch-keyboard-navigation.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );

    wp_localize_script(
        'slicko-touch-navigation',
        'screenReaderText',
        array(
            'expand'   => __( 'expand child menu', 'slicko' ),
            'collapse' => __( 'collapse child menu', 'slicko' ),
        )
    );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    $slicko_dynamic_css       = '';
    $slicko_header_bg         = get_header_image();
    $slicko_header_background = get_theme_mod( 'header_background_color' );
    $slicko_footer_background = get_theme_mod( 'footer_background_color', '#22304A' );
    $slicko_footer_text       = get_theme_mod( 'footer_text_color', '#FFFFFF' );
    $slicko_footer_anchor     = get_theme_mod( 'footer_anchor_color', '#666666' );

    $slicko_footer_bottom_background = get_theme_mod( 'footer_bottom_background_color', '#22304A' );
    $slicko_footer_bottom_text       = get_theme_mod( 'footer_bottom_text_color', '#666666' );
    $slicko_footer_bottom_anchor     = get_theme_mod( 'footer_bottom_anchor_color', '#fc414a' );

    if ( $slicko_header_bg ) {
        $slicko_dynamic_css .= '.slicko-breadcrumb-section { background: url("' . esc_url( $slicko_header_bg ) . '") no-repeat scroll left top rgba(0, 0, 0, 0); position: relative; background-size: cover; }';
        $slicko_dynamic_css .= '.slicko-breadcrumb-section::before {
			content: "";
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			background: rgba(255,255,255,0.5);
		}';
        $slicko_dynamic_css .= "\n";
    }
    if ( $slicko_header_background ) {
        $slicko_dynamic_css .= '.slicko-breadcrumb-section { background-color: ' . esc_attr( $slicko_header_background ) . ' }';
        $slicko_dynamic_css .= "\n";
    }
    if ( $slicko_footer_background ) {
        $slicko_dynamic_css .= '#colophon { background-color: ' . esc_attr( $slicko_footer_background ) . ' }';
        $slicko_dynamic_css .= "\n";
    }
    if ( $slicko_footer_text ) {
        $slicko_dynamic_css .= '.slicko-footer-widget, .slicko-footer-widget li, .slicko-footer-widget p, .slicko-footer-widget h3, .slicko-footer-widget h4 { color: ' . esc_attr( $slicko_footer_text ) . ' }';
        $slicko_dynamic_css .= "\n";
    }
    if ( $slicko_footer_anchor ) {
        $slicko_dynamic_css .= '.slicko-footer-widget a { color: ' . esc_attr( $slicko_footer_anchor ) . ' }';
        $slicko_dynamic_css .= "\n";
    }
    if ( $slicko_footer_bottom_background ) {
        $slicko_dynamic_css .= '.slicko-footer-bottom { background-color: ' . esc_attr( $slicko_footer_bottom_background ) . ' }';
        $slicko_dynamic_css .= "\n";
    }
    if ( $slicko_footer_bottom_text ) {
        $slicko_dynamic_css .= '.slicko-footer-bottom p, .slicko-copywright, .slicko-copywright li { color: ' . esc_attr( $slicko_footer_bottom_text ) . ' }';
        $slicko_dynamic_css .= "\n";
    }
    if ( $slicko_footer_bottom_anchor ) {
        $slicko_dynamic_css .= '.slicko-footer-bottom a, .slicko-copywright a, .slicko-copywright li a { color: ' . esc_attr( $slicko_footer_bottom_anchor ) . ' }';
        $slicko_dynamic_css .= "\n";
    }

    $slicko_dynamic_css = slicko_css_strip_whitespace( $slicko_dynamic_css );

    wp_add_inline_style( 'slicko-style', $slicko_dynamic_css );
}
add_action( 'wp_enqueue_scripts', 'slicko_scripts', 5 );

//Admin custom css and js


add_action('admin_enqueue_scripts', 'slicko_custom__css_and_js');

function slicko_custom__css_and_js() {
    wp_enqueue_style( 'admin-style', get_template_directory_uri() . '/assets/css/admin.css', array(), wp_get_theme()->get( 'Version' ) );

}


/**
 * Add an extra menu to our nav for our priority+ navigation to use
 *
 * @param object $nav_menu  Nav menu.
 * @param object $args      Nav menu args.
 * @return string More link for hidden menu items.
 */
function slicko_add_ellipses_to_nav( $nav_menu, $args ) {

    if ( 'menu-1' === $args->theme_location ):

        $nav_menu .= '<div class="main-menu-more">';
        $nav_menu .= '<ul class="main-menu">';
        $nav_menu .= '<li class="menu-item menu-item-has-children">';
        $nav_menu .= '<button class="submenu-expand main-menu-more-toggle is-empty" tabindex="-1" aria-label="More" aria-haspopup="true" aria-expanded="false">';
        $nav_menu .= '<span class="screen-reader-text">' . esc_html__( 'More', 'slicko' ) . '</span>';
        // $nav_menu .= slicko_get_icon_svg( 'arrow_drop_down_ellipsis' );
        $nav_menu .= '</button>';
        $nav_menu .= '<ul class="sub-menu hidden-links">';
        $nav_menu .= '<li id="menu-item--1" class="mobile-parent-nav-menu-item menu-item--1">';
        $nav_menu .= '<button class="menu-item-link-return">';
        // $nav_menu .= slicko_get_icon_svg( 'chevron_left' );
        $nav_menu .= esc_html__( 'Back', 'slicko' );
        $nav_menu .= '</button>';
        $nav_menu .= '</li>';
        $nav_menu .= '</ul>';
        $nav_menu .= '</li>';
        $nav_menu .= '</ul>';
        $nav_menu .= '</div>';
    endif;
    return $nav_menu;
}

/**
 * Get minified css and removed space
 *
 * @since 1.0.0
 */
function slicko_css_strip_whitespace( $css ) {
    $replace = array(
        '#/\*.*?\*/#s' => '', // Strip C style comments.
        '#\s\s+#' => ' ', // Strip excess whitespace.
    );
    $search = array_keys( $replace );
    $css    = preg_replace( $search, $replace, $css );

    $replace = array(
        ': ' => ':',
        '; ' => ';',
        ' {' => '{',
        ' }' => '}',
        ', ' => ',',
        '{ ' => '{',
        ';}' => '}', // Strip optional semicolons.
        ",\n" => ',', // Don't wrap multiple selectors.
        "\n}" => '}', // Don't wrap closing braces.
        '} ' => "}\n", // Put each rule on it's own line.
    );
    $search = array_keys( $replace );
    $css    = str_replace( $search, $replace, $css );

    return trim( $css );
}

if ( !function_exists( 'slicko_fonts_url' ) ):

    /**
     * Register Google fonts for Slicko.
     *
     * @return string Google fonts URL for the theme.
     * @since 1.0.0
     */

    function slicko_fonts_url() {
        $fonts_url = '';
        $fonts     = array();

        /* translators: If there are characters in your language that are not supported by Inter, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Inter font: on or off', 'slicko' ) ) {
            $fonts[] = 'Inter:300,400,600';
        }

        /* translators: If there are characters in your language that are not supported by Inter, translate this to 'off'. Do not translate into your own language. */
        /* if ('off' !== _x('on', 'Saira Condensed font: on or off', 'slicko')) {
        $fonts[] = 'Saira Condensed:400,500,600';
        }
         */
        $fonts = apply_filters( 'slicko_google_fonts', $fonts );

        if ( $fonts ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( 'latin' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/**
 * Logo wrapper
 *
 * @since 1.0.0
 */
function slicko_logo_wrap() {
    ?>
	<a class="slicko_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' );?>" itemprop="url">
		<?php echo slicko_logo(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    ?>
	</a>
<?php
}

/**
 * Slicko Logo.
 *
 * @return string
 * @since 1.0.0
 */
function slicko_logo() {
    if ( get_theme_mod( 'custom_logo' ) ) {
        $logo          = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
        $alt_attribute = get_post_meta( get_theme_mod( 'custom_logo' ), '_wp_attachment_image_alt', true );
        if ( empty( $alt_attribute ) ) {
            $alt_attribute = get_bloginfo( 'name' );
        }
        $logo = '<img src="' . esc_url( $logo[0] ) . '" alt="' . esc_attr( $alt_attribute ) . '">';
    } else {
        $logo = '<h2>' . get_bloginfo( 'name' ) . '</h2>';
    }
    return $logo;
}

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function slicko_custom_excerpt_length( $length ) {
    if ( is_admin() ) {
        return $length;
    }
    return 40;
}
add_filter( 'excerpt_length', 'slicko_custom_excerpt_length', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function slicko_excerpt_more( $more ) {
    if ( is_admin() ) {
        return $more;
    }
    return '';
}
add_filter( 'excerpt_more', 'slicko_excerpt_more' );

if ( !function_exists( 'slicko_related_posts' ) ) {
    /**
     * Single blog post related posts list
     */
    function slicko_related_posts( $the_post_id ) {

        // Define shared post arguments.
        $related_args = array(
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
            'ignore_sticky_posts'    => 1,
            'orderby'                => 'rand',
            'post_type'              => 'post',
            'post__not_in'           => array( $the_post_id ),
            'posts_per_page'         => 3,
        );
        $related_post_type = get_theme_mod( 'slicko_related_post_from', 'category' );
        // Related by tags.
        if ( $related_post_type == 'tag' ) {
            $tags = wp_get_post_tags( $the_post_id );
            if ( $tags ) {
                $first_tag               = $tags[0]->term_id;
                $related_args['tag__in'] = array( $first_tag );
            }
        } else {
            // Related by categories.
            $cats = wp_get_post_categories( $the_post_id );
            if ( $cats && isset( $cats[0] ) ) {
                $first_tag                    = ( isset( $cats[0]->term_id ) ) ? $cats[0]->term_id : $cats[0];
                $related_args['category__in'] = array( $first_tag );
            }
        }

        return $related_args;
    }
}

if ( !function_exists( 'slicko_set_attributes' ) ) {
    /**
     * Set dynamic attributes
     */
    function slicko_set_attributes( $attributes ) {

        if ( !$attributes ) {
            return;
        }

        $set_attr = array();
        foreach ( $attributes as $key => $attr ) {
            $attr       = (array) $attr;
            $attr       = implode( " ", $attr );
            $set_attr[] = "{$key}='{$attr}'";
        }

        return implode( " ", $set_attr );
    }
}

/**
 * wp_body_open callback for backword Compatibility
 */
if ( !function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/**
 * WooCommerce Modification
 */
if ( !function_exists( 'is_woocommerce_active' ) ) {
    function is_woocommerce_active() {
        return ( class_exists( 'WooCommerce' ) ) ? true : false;
    }
}
function slicko_woo_wrapper_start() {
    echo '<div id="primary" class="' . esc_attr( slicko_content_class() ) . '"><main id="main" class="site-main" role="main">';
}

function slicko_woo_hooks() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    add_action( 'woocommerce_before_main_content', 'slicko_woo_wrapper_start', 10 );

    $related_product = get_theme_mod( 'slicko_related_product_option', 'show' );
    if ( $related_product === 'hide' ) {
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    }
}
add_action( 'wp_head', 'slicko_woo_hooks' );

/**
 * slicko get archive post type
 *
 */
function slicko_get_archive_post_type() {
    $postname = isset( get_queried_object()->name ) ? get_queried_object()->name : '';
    return is_archive() ? $postname : '';
}

function slicko_is_edit_mode() {

    return isset( $_GET['elementor-preview'] );
}

function slicko_header_settings() {

    if ( defined( 'ELEMENTOR_PRO_VERSION' ) && slicko_is_edit_mode() ) {
        return;
    } else {
        $slicko = get_option( 'slicko' );

        $check_header_post = get_posts( ['post_type' => 'slicko_header'] );

        if ( 0 != count( $check_header_post ) ) {
            printf( '<header class="site-header slicko-elementor-header">' );
            slicko_header_footer_template_query( 'slicko_header' );
            printf( '</header>' );
        } else {
            get_template_part( 'template-parts/headers/header' );
        }
    }

}


/**
 * Slicko Footer Query
 *
 */
function slicko_header_footer_template_query( $post_type, $post_id = '' ) {
    global $post;
    $current_page_id = isset( $post->ID ) ? $post->ID : false;
    // Query for blog posts
    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => -1,
    );
    if ( empty( $post_id ) ) {
        $argc['p'] = $post_id;
    }
    $footer_query = new WP_Query( $args );
    if ( $footer_query->have_posts() ):
        while ( $footer_query->have_posts() ):
            $footer_query->the_post();
            $include_on = get_post_meta( get_the_ID(), 'slicko_include_on', true );
            $exclude_on = get_post_meta( get_the_ID(), 'slicko_exclude_on', true );
            $excluded   = false;
            $output     = '';
            if ( $exclude_on ) {
                $specific_pages = get_post_meta( get_the_ID(), 'slicko_exclude_pages', true ) ? get_post_meta( get_the_ID(), 'slicko_exclude_pages', true ) : [];
                if ( 'entire_website' == $exclude_on || in_array( $current_page_id, $specific_pages ) ) {
                    $excluded = true;
                }
            }

            if ( !$excluded && $include_on ) {
				$specific_pages = get_post_meta( get_the_ID(), 'slicko_include_pages', true ) ? get_post_meta( get_the_ID(), 'slicko_include_pages', true ) : [];

                if ( 'entire_website' == $include_on || in_array( $current_page_id, $specific_pages ) ) {
					ob_start();
                    the_content();
                    $content = ob_get_clean();
                    $output  = $content;
                }
            }

            printf($output);
        endwhile;
    endif;
}
function slicko_get_site_logo($logo_type = 'dark')
    {
        $logo = '';
        $logo_url = '';
        $slicko_dark_logo = get_theme_mod('slicko_dark_logo');

            if (has_custom_logo()) {
                $core_logo_id = get_theme_mod('custom_logo');
                $logo_url = wp_get_attachment_image_src($core_logo_id, 'full');
                $logo = '<img src="' . esc_url($logo_url[0]) . '" alt="' . esc_attr(get_bloginfo('title')) . '" class="navbar-brand__regular">';
            } else {

                $logo = '<h1 class="navbar-brand__regular">' . get_bloginfo('name') . '</h1>';
            }

        return $logo;
    }