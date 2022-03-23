<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Slicko
 */

?>

<?php
/**
 * slicko_content_end hook
 *
 * @since 1.0.0
 */
do_action( 'slicko_content_end' );

/**
 * slicko_footer_before hook
 *
 * @since 1.0.0
 */
do_action( 'slicko_footer_before' );


/**
 * slicko_footer_settings hook
 *
 * @since 1.0.0
 */
do_action( 'slicko_footer_settings' );


/**
 * slicko_footer_bottom hook
 *
 * @since 1.0.0
 */
do_action( 'slicko_footer_bottom' );

/**
 * slicko_footer_after hook
 *
 * @since 1.0.0
 */
do_action( 'slicko_footer_after' );


/**
 * slicko_after_page
 * 
 * @since 1.0.0
 */
do_action( 'slicko_after_page' );


wp_footer(); ?>

</body>
</html>
