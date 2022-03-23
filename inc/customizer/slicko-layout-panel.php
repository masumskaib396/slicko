<?php
/**
 * Slicko Page layout for archive/sing/blog, page and single blog post
 *
 * @package Slicko
 * @since 1.0.0
 */

add_action( 'customize_register', 'slicko_design_settings_register' );

function slicko_design_settings_register( $wp_customize ) {

	// Register the radio image control class as a JS control type.
    $wp_customize->register_control_type( 'Slicko_Customize_Control_Radio_Image' );

	/**
     * Add Layout Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'slicko_layout_settings_panel',
	    array(
	        'priority'       => 25,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => esc_html__( 'Layout Settings', 'slicko' ),
	    )
    );

    /**
     * Archive Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'slicko_archive_settings_section',
        array(
            'title'     => esc_html__( 'Archive/Blog Settings', 'slicko' ),
            'panel'     => 'slicko_layout_settings_panel',
            'priority'  => 5,
        )
    );

    /**
     * Image Radio field for archive sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'slicko_archive_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'slicko_sanitize_select',
        )
    );
    $wp_customize->add_control( new Slicko_Customize_Control_Radio_Image(
        $wp_customize,
        'slicko_archive_sidebar',
            array(
                'label'    => esc_html__( 'Archive Sidebars', 'slicko' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'slicko' ),
                'section'  => 'slicko_archive_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'slicko' ),
                            'url'   => '%s/assets/images/left-sidebars.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'slicko' ),
                            'url'   => '%s/assets/images/right-sidebars.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'slicko' ),
                            'url'   => '%s/assets/images/three-column.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Text field for archive read more
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'slicko_archive_read_more_text',
        array(
            'default'      => esc_html__( 'Read More', 'slicko' ),
            'transport'    => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'slicko_archive_read_more_text',
        array(
            'type'      	=> 'text',
            'label'        	=> esc_html__( 'Read More Text', 'slicko' ),
            'description'  	=> esc_html__( 'Enter read more button text for archive page.', 'slicko' ),
            'section'   	=> 'slicko_archive_settings_section',
            'priority'  	=> 15
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'slicko_archive_read_more_text',
            array(
                'selector' => '.entry-footer > a.slicko-icon-btn',
                'render_callback' => 'slicko_customize_partial_archive_more',
            )
    );

    /**
     * Page Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'slicko_page_settings_section',
        array(
            'title'     => esc_html__( 'Page Settings', 'slicko' ),
            'panel'     => 'slicko_layout_settings_panel',
            'priority'  => 10,
        )
    );

    /**
     * Image Radio for page sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'slicko_default_page_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'slicko_sanitize_select',
        )
    );
    $wp_customize->add_control( new Slicko_Customize_Control_Radio_Image(
        $wp_customize,
        'slicko_default_page_sidebar',
            array(
                'label'    => esc_html__( 'Page Sidebars', 'slicko' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'slicko' ),
                'section'  => 'slicko_page_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'slicko' ),
                            'url'   => '%s/assets/images/page-left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'slicko' ),
                            'url'   => '%s/assets/images/page-right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'slicko' ),
                            'url'   => '%s/assets/images/full-content.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Post Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'slicko_post_settings_section',
        array(
            'title'     => esc_html__( 'Single Post Settings', 'slicko' ),
            'panel'     => 'slicko_layout_settings_panel',
            'priority'  => 15,
        )
    );

    /**
     * Image Radio for post sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'slicko_default_post_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'slicko_sanitize_select',
        )
    );
    $wp_customize->add_control( new Slicko_Customize_Control_Radio_Image(
        $wp_customize,
        'slicko_default_post_sidebar',
            array(
                'label'    => esc_html__( 'Post Sidebars', 'slicko' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'slicko' ),
                'section'  => 'slicko_post_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'slicko' ),
                            'url'   => '%s/assets/images/page-left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'slicko' ),
                            'url'   => '%s/assets/images/page-right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'slicko' ),
                            'url'   => '%s/assets/images/full-content.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Switch option for Related posts
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'slicko_related_posts_option',
        array(
            'default' => 'show',
            'transport'  => 'refresh',
            'sanitize_callback' => 'slicko_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new slicko_Customize_Switch_Control(
        $wp_customize,
            'slicko_related_posts_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Related Post Option', 'slicko' ),
                'description'   => esc_html__( 'Show/Hide option for related posts section at single post page.', 'slicko' ),
                'section'   => 'slicko_post_settings_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'slicko' ),
                    'hide'  => esc_html__( 'Hide', 'slicko' )
                ),
                'priority'  => 10,
            )
        )
    );

    /**
     * Text field for related post section title
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'slicko_related_posts_title',
        array(
            'default'    => esc_html__( 'Related Posts', 'slicko' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'slicko_related_posts_title',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Related Post Section Title', 'slicko' ),
            'section'   => 'slicko_post_settings_section',
            'active_callback' => 'slicko_is_related_shown',
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'slicko_related_posts_title',
            array(
                'selector' => 'h2.slicko-related-title',
                'render_callback' => 'slicko_customize_partial_related_title',
            )
    );

    $wp_customize->add_setting(
        'slicko_related_post_from',
        array(
            'transport'  => 'refresh',
            'sanitize_callback' => 'slicko_sanitize_select',
            'default' => 'category',
        )
    );

    $wp_customize->add_control(
        'slicko_related_post_from', array(
            'type' => 'select',
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'section' => 'slicko_post_settings_section', // Add a default or your own section
            'label'     => esc_html__( 'Select Related Post Type', 'slicko' ),
            'active_callback' => 'slicko_is_related_shown',
            'description' => esc_html__( 'Select whish taxonomy you want to fetch related post', 'slicko' ),
            'choices' => array(
                'category' => esc_html__( 'Category', 'slicko' ),
                'tag' => esc_html__( 'Tag', 'slicko' ),
            ),
        )
    );




    if ( class_exists( 'WooCommerce' ) ) :

    /**
     * Product Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'slicko_product_settings_section',
        array(
            'title'     => esc_html__( 'Product Page Settings', 'slicko' ),
            'panel'     => 'slicko_layout_settings_panel',
            'priority'  => 20,
        )
    );

    /**
     * Image Radio for page sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'slicko_product_page_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'slicko_sanitize_select',
        )
    );
    $wp_customize->add_control( new Slicko_Customize_Control_Radio_Image(
        $wp_customize,
        'slicko_product_page_sidebar',
            array(
                'label'    => esc_html__( 'Product Page Sidebars', 'slicko' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'slicko' ),
                'section'  => 'slicko_product_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'slicko' ),
                            'url'   => '%s/assets/images/left-sidebars.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'slicko' ),
                            'url'   => '%s/assets/images/right-sidebars.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'slicko' ),
                            'url'   => '%s/assets/images/no-sidebars.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Single Product Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'slicko_single_product_settings_section',
        array(
            'title'     => esc_html__( 'Single Product Settings', 'slicko' ),
            'panel'     => 'slicko_layout_settings_panel',
            'priority'  => 25,
        )
    );

    /**
     * Image Radio for post sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'slicko_single_product_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'slicko_sanitize_select',
        )
    );
    $wp_customize->add_control( new Slicko_Customize_Control_Radio_Image(
        $wp_customize,
        'slicko_single_product_sidebar',
            array(
                'label'    => esc_html__( 'Single Product Sidebars', 'slicko' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'slicko' ),
                'section'  => 'slicko_single_product_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'slicko' ),
                            'url'   => '%s/assets/images/left-sidebars.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'slicko' ),
                            'url'   => '%s/assets/images/right-sidebars.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'slicko' ),
                            'url'   => '%s/assets/images/no-sidebars.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Switch option for Related posts
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'slicko_related_product_option',
        array(
            'default' => 'show',
            'transport'  => 'refresh',
            'sanitize_callback' => 'slicko_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new slicko_Customize_Switch_Control(
        $wp_customize,
            'slicko_related_product_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Related Product Option', 'slicko' ),
                'description'   => esc_html__( 'Show/Hide option for related product section at single product page.', 'slicko' ),
                'section'   => 'slicko_single_product_settings_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'slicko' ),
                    'hide'  => esc_html__( 'Hide', 'slicko' )
                ),
                'priority'  => 10,
            )
        )
    );


    endif; // if woocommerce available

} // Layout panel closed