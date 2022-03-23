<?php
/**
 * Slicko Search Form
 *
 * @package Slicko
 * @since 1.0
 * @version 1.0
 */

?>
<form role="search" method="get" class="slicko-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'slicko' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'slicko' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'slicko' ); ?>" />
	</label>
	<button type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'slicko' ); ?>"><i class="ti-search"></i></button>
</form>
