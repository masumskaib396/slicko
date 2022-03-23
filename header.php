<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Slicko
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
/**
 * slicko_before_page hook
 *
 * @since 1.0.0
 */
do_action( 'slicko_before_page' );

/**
 * slicko_header_top_bar hook
 *
 * @since 1.0.0
 */
do_action( 'slicko_header_top_bar' );

/**
 * slicko_header_section hook
 *
 * @hooked - slicko_header_start - 10
 * @hooked - slicko_header_wrap - 20
 * @hooked - slicko_header_end - 30
 * 
 * @since 1.0.0
 */
do_action( 'slicko_header_section' );

/**
 * slicko_banner_section hook
 *
 * @hooked - slicko_banner_section_start - 10
 * @hooked - slicko_banner_title - 20
 * @hooked - slicko_banner_section_end - 30
 *
 * @since 1.0.0
 */
do_action( 'slicko_banner_section' );

/**
 * slicko_content_start hook
 *
 *
 * @since 1.0.0
 */
do_action( 'slicko_content_start' );
