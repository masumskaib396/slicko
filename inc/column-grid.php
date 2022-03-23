<?php

if ( !function_exists( 'slicko_content_wrap_calc' ) ) {
	/**
	 * Slicko content wrap classes list
	 *
	 */
	function slicko_content_wrap_calc( $type_layout ) {
		$wrap_class = array(
			'col-lg-8',
			'col-md-12',
			'col-sm-12',
			'content-area',
		);
		if ( 'no_sidebar' === $type_layout ) {
			$wrap_class = array(
				'col-lg-12',
				'col-md-12',
				'col-sm-12',
				'content-area',
			);
		} elseif ( 'left_sidebar' === $type_layout ) {
			$wrap_class[] = 'order-lg-2';
			$wrap_class[] = 'order-md-2';
		}
		return $wrap_class;
	}
}



if ( !function_exists( 'slicko_column_wrap_calc' ) ) {
	/**
	 * Slicko clumn wrap  list
	 *
	 */
	function slicko_column_wrap_calc() {

		$column_archive_sidebar      = get_theme_mod( 'slicko_archive_sidebar', 'right_sidebar' );
		if( 'no_sidebar' === $column_archive_sidebar ){
			$gride = 'col-lg-4 col-md-6 col-sm-12';
		}else{
			$gride = 'col-lg-6 col-md-6 col-sm-12';
		};

		return $gride;
	}
}






if ( !function_exists( 'slicko_content_class' ) ) {
	/**
	 * Slicko content class init
	 */
	function slicko_content_class() {

		$archive_sidebar      = get_theme_mod( 'slicko_archive_sidebar', 'right_sidebar' );
		$post_default_sidebar = get_theme_mod( 'slicko_default_post_sidebar', 'right_sidebar' );
		$page_default_sidebar = get_theme_mod( 'slicko_default_page_sidebar', 'right_sidebar' );
		$product_default_sidebar = get_theme_mod( 'slicko_product_page_sidebar', 'right_sidebar' );
		$product_singlet_sidebar = get_theme_mod( 'slicko_single_product_sidebar', 'right_sidebar' );

		if ( is_woocommerce_active() && is_product() ) {
			$content_class = slicko_content_wrap_calc( $product_singlet_sidebar );
		} elseif ( is_single() ) {
			$content_class = slicko_content_wrap_calc( $post_default_sidebar );
		} elseif ( is_page_template('template-full.php') ) {
			$content_class = slicko_content_wrap_calc( 'no_sidebar' );
		} elseif ( is_page_template('template-full-width.php') ) {
			$content_class = slicko_content_wrap_calc( 'no_sidebar' );
		} elseif ( is_page() ) {
			$content_class = slicko_content_wrap_calc( $page_default_sidebar );
		} elseif ( is_woocommerce_active() && is_shop() ) {
			$content_class = slicko_content_wrap_calc( $product_default_sidebar );
		} else {
			$content_class = slicko_content_wrap_calc( $archive_sidebar );
		}

		$content_class = apply_filters('slicko_content_class', $content_class);

		$content_class = implode( ' ', $content_class );
		return $content_class;
	}
}

if ( !function_exists( 'slicko_sidebar_wrap_calc' ) ) {
	/**
	 * Slicko sidebar classes list
	 */
	function slicko_sidebar_wrap_calc( $type_layout ) {
		$wrap_class = array(
			'col-lg-4',
			'col-md-10',
			'col-sm-12',
			'widget-area',
		);
		if ( 'left_sidebar' === $type_layout ) {
			$wrap_class[] = 'order-lg-1';
			$wrap_class[] = 'order-md-1';
		}
		return $wrap_class;
	}
}

if ( !function_exists( 'slicko_sidebar_class' ) ) {
	/**
	 * Slicko sidebar class init
	 */
	function slicko_sidebar_class() {

		$archive_sidebar      = get_theme_mod( 'slicko_archive_sidebar', 'right_sidebar' );
		$post_default_sidebar = get_theme_mod( 'slicko_default_post_sidebar', 'right_sidebar' );
		$page_default_sidebar = get_theme_mod( 'slicko_default_page_sidebar', 'right_sidebar' );
		$product_default_sidebar = get_theme_mod( 'slicko_product_page_sidebar', 'right_sidebar' );
		$product_singlet_sidebar = get_theme_mod( 'slicko_single_product_sidebar', 'right_sidebar' );

		if ( is_woocommerce_active() && is_product() ) {
			$sidebar_class = slicko_sidebar_wrap_calc( $product_singlet_sidebar );
		} elseif ( is_single() ) {
			$sidebar_class = slicko_sidebar_wrap_calc( $post_default_sidebar );
		} elseif ( is_page() ) {
			$sidebar_class = slicko_sidebar_wrap_calc( $page_default_sidebar );
		} elseif ( is_woocommerce_active() && is_shop() ) {
			$sidebar_class = slicko_sidebar_wrap_calc( $product_default_sidebar );
		} else {
			$sidebar_class = slicko_sidebar_wrap_calc( $archive_sidebar );
		}

		$sidebar_class = apply_filters('slicko_sidebar_class', $sidebar_class);
		$sidebar_class = implode( ' ', $sidebar_class );
		return $sidebar_class;
	}
}