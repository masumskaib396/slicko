<?php

/**
 * Page Start
 *
 * @since 1.0.0
 */
if (!function_exists('slicko_page_wrap_start')) :
    function slicko_page_wrap_start()
    {
        $page_attr = array(
            'class' => array('site', 'logisitco_page_wrap'),
            'id' => 'page'
        );
        $page_attr = apply_filters('slicko_page_attr', $page_attr);
        echo '<div ' . slicko_set_attributes($page_attr) . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo '<a class="skip-link screen-reader-text" href="#content">' . esc_html__('Skip to content', 'slicko') . '</a>';
    }
endif;


/**
 * Page End
 *
 * @since 1.0.0
 */
if (!function_exists('slicko_page_wrap_end')) :
    function slicko_page_wrap_end()
    {
        echo '</div><!-- #page -->';
    }
endif;


/**
 * Content wrap start
 *
 * @since 1.0.0
 */
if (!function_exists('slicko_content_start')) :
    function slicko_content_start()
    {
        echo '<div id="content" class="site-content">';
    }
endif;


/**
 * Content wrap end
 *
 * @since 1.0.0
 */
if (!function_exists('slicko_content_end')) :
    function slicko_content_end()
    {
        echo '</div><!-- #content -->';
    }
endif;


/**
 * Content wrap start
 *
 * @since 1.0.0
 */
if (!function_exists('slicko_content_inner_start')) :
    function slicko_content_inner_start()
    {
        if (is_page_template("template-full.php") || is_page_template('elementor_header_footer') || is_page_template('elementor_canvas'))
            return;

        echo '<div class="container">';
        echo '<div class="row blog-content-row justify-content-center">';
    }
endif;

/**
 * Content wrap end
 *
 * @since 1.0.0
 */
if (!function_exists('slicko_content_inner_end')) :
    function slicko_content_inner_end()
    {
        if (is_page_template("template-full.php") || is_page_template('elementor_header_footer') || is_page_template('elementor_canvas'))
            return;

        echo '</div> <!-- .container -->';
        echo '</div> <!-- .row -->';
    }
endif;



/**
 * Custom hooks functions are define about general section.
 *
 * @package Slicko
 * @since 1.0.0
 */



/**
 * Header banner section start
 *
 * @since 1.0.0
 */
if (!function_exists('slicko_banner_section_start')) :
    function slicko_banner_section_start()
    {
        if (is_page_template("template-full.php") || is_page_template('elementor_header_footer') || is_page_template('elementor_canvas'))
            return;

        global $slickoObj;

        $breadcrumb_attr = apply_filters('slicko_breadcrumb_class', $slickoObj->slicko_breadcrumb_bridge());
    }
endif;


/**
 * Header banner title
 *
 * @since 1.0.0
 */
if (!function_exists('slicko_banner_title')) :
    function slicko_banner_title()
    {
        if (is_page_template("template-full.php") || is_page_template('elementor_header_footer') || is_page_template('elementor_canvas'))
            return;

        /* $breadcrumb = new Slicko_BreadCrumb();
        echo wp_kses_post($breadcrumb->init()); */
    }
endif;


/**
 * Header banner section end
 *
 * @since 1.0.0
 */
if (!function_exists('slicko_banner_section_end')) :
    function slicko_banner_section_end()
    {
        if (is_page_template("template-full.php") || is_page_template('elementor_header_footer'))
            return;

        echo '</div>';
        echo '</div>';
        echo '</section><!-- .slicko-breadcrumb-section-->';
    }
endif;



/**
 * Footer section start
 *
 * @since 1.0.0
 */
if (!function_exists('slicko_footer_section_start')) :
    function slicko_footer_section_start()
    {
        echo '<footer id="colophon" class="site-footer slicko-section bg-cloud-burst">';
    }
endif;


/**
 * Footer section widget area
 *
 * @since 1.0.0
 */
if (!function_exists('slicko_footer_section_bottom')) :
    function slicko_footer_section_bottom()
    {
        ?>
        <div class="slicko-copyright text-center">
            <?php
                $copyright = get_theme_mod('slicko_copyright_text', 'Slicko');
                if ($copyright) :
                    $allowed_html = array(
                        'a' => array(
                            'href' => array(),
                            'title' => array()
                        ),
                        'br' => array(),
                        'em' => array(),
                        'strong' => array(),
                    );
                ?>
                    <p class="slicko-copywright">
                        <?php echo wp_kses($copyright, $allowed_html); ?>
                    </p>
                <?php endif; ?>
            </div><!-- .slicko-footer-bottom -->
        <?php
    }
endif;

/**
 * Footer section widget area
 *
 * @since 1.0.0
 */
if (!function_exists('slicko_footer_section_widgets')) :
    function slicko_footer_section_widgets()
    {
        if (is_active_sidebar('footer-widget-area')) :
            $footer_layout = get_theme_mod('footer_widget_layout', 'column_four');
        ?>
            <div class="slicko-footer-top p-t-b-95 p-sm-t-b-70 slicko-footer-<?php echo esc_attr($footer_layout); ?>">
                <div class="container">
                    <div class="row">
                        <?php dynamic_sidebar('footer-widget-area'); ?>
                    </div><!-- .row -->
                </div><!-- .container -->
            </div>
            <!--.slicko-footer-top -->
        <?php
        endif;
    }
endif;



/**
 * slicko Footer Settings
 *
 */
function slicko_footer_settings() {
    if ( defined( 'ELEMENTOR_PRO_VERSION' ) && slicko_is_edit_mode() ) {
        return;
    } else {
        $check_footer_post = get_posts( ['post_type' => 'slicko_footer'] );

        if ( 0 != count( $check_footer_post ) ) {

            slicko_header_footer_template_query( 'slicko_footer' );
        } else {
            slicko_footer_section_widgets();
            slicko_footer_section_bottom();
        }
    }
}


/**
 * Footer section end
 *
 * @since 1.0.0
 */
if (!function_exists('slicko_footer_section_end')) :
    function slicko_footer_section_end()
    {
        echo '</footer><!-- #colophon-->';
    }
endif;





/**
 * Page Wrapper
 *
 * @since 1.0.0
 */
add_action('slicko_before_page', 'slicko_page_wrap_start');
add_action('slicko_after_page', 'slicko_page_wrap_end');


/**
 * Main content wrapper
 *
 * @since 1.0.0
 */
add_action('slicko_content_start', 'slicko_content_start', 10);
add_action('slicko_content_start', 'slicko_content_inner_start', 20);
add_action('slicko_content_end', 'slicko_content_inner_end', 10);
add_action('slicko_content_end', 'slicko_content_end', 20);



/**
 * Managed functions for Header section hooking
 *
 * @since 1.0.0
 */
add_action('slicko_header_section', 'slicko_header_settings', 10);



/**
 * Managed functions for top banner hook
 *
 * @since 1.0.0
 */
add_action('slicko_banner_section', 'slicko_banner_section_start', 10);
add_action('slicko_banner_section', 'slicko_banner_title', 20);
add_action('slicko_banner_section', 'slicko_banner_section_end', 30);



/**
 * Managed functions for footer area hook
 *
 * @since 1.0.0
 */
add_action('slicko_footer_before', 'slicko_footer_section_start' );
add_action('slicko_footer_before', 'slicko_footer_settings');
add_action('slicko_footer_after', 'slicko_footer_section_end' );

