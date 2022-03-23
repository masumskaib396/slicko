<?php
/**
 * Slicko Header Settings panel at Theme Customizer
 *
 * @package Slicko
 * @since 1.0.0
 */

add_action( 'customize_register', 'slicko_header_settings_register' );

function slicko_header_settings_register( $wp_customize ) {

	/**
     * Add General Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel('slicko_header_settings_panel',array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => esc_html__( 'Header Settings', 'slicko' ),
    ));


    $wp_customize->get_section('header_image')->panel = 'slicko_header_settings_panel';
    $wp_customize->get_section('header_image')->title = esc_html__('Header Background Image', 'slicko');
    $wp_customize->get_section('header_image')->priority = 3;

     /**
     * Website layout section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'slicko_header_background_section',
        array(
            'title'         => esc_html__( 'Header Background Color', 'slicko' ),
            'description'   => esc_html__( 'Choose Header Background Color.', 'slicko' ),
            'priority'      => 55,
            'panel'         => 'slicko_header_settings_panel',
        )
    );

    $wp_customize->add_setting(
        'header_background_color',
        array(
            'default' => '#ececec',
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    
    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
        $wp_customize, 
        'header_background_color', 
        array(
            'label'      => esc_html__( 'Header Background Color', 'slicko' ),
            'section'    => 'slicko_header_background_section',
            'priority'   => 20,
        ) ) 
    );

} // header panel close