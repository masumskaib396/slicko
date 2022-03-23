/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-branding h2' ).text( to );
		} );
	} );
	
	wp.customize( 'header_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.blog-breadcrumb' ).css( {
				'background-color': to
			} );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.blog-breadcrumb span, .blog-breadcrumb .post__caption, .blog-breadcrumb h1' ).css( {
					'color': '#202427'
				} );
			} else {
				$( '.blog-breadcrumb span, .blog-breadcrumb .post__caption, .blog-breadcrumb h1' ).css( {
					'color': to
				} );
			}
		} );
	} );
	
	
	wp.customize( 'footer_background_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '#colophon' ).css( {
					'background-color': '#f3f4f8'
				} );
			} else {
				$( '#colophon' ).css( {
					'background-color': to
				} );
			}
		} );
	} );

	wp.customize( 'footer_text_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.slicko-footer-widget, .slicko-footer-widget li, .slicko-footer-widget p, .slicko-footer-widget h3,  .slicko-footer-widget h4' ).css( {
					'color': '#FFFFFF'
				} );
			} else {
				$( '.slicko-footer-widget, .slicko-footer-widget li, .slicko-footer-widget p, .slicko-footer-widget h3, .slicko-footer-widget h4' ).css( {
					'color': to
				} );
			}
		} );
	} );


	wp.customize( 'footer_anchor_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.slicko-footer-widget a' ).css( {
					'color': '#666666'
				} );
			} else {
				$( '.slicko-footer-widget a' ).css( {
					'color': to
				} );
			}
		} );
	} );
	
	
	wp.customize( 'footer_bottom_background_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.slicko-copyright.text-center' ).css( {
					'background-color': '#22304A'
				} );
			} else {
				$( '.slicko-copyright.text-center' ).css( {
					'background-color': to
				} );
			}
		} );
	} );

	wp.customize( 'footer_bottom_text_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.slicko-copyright p, .slicko-copyright, .slicko-copyright li' ).css( {
					'color': '#666666'
				} );
			} else {
				$( '.slicko-copyright p, .slicko-copyright, .slicko-copyright li' ).css( {
					'color': to
				} );
			}
		} );
	} );


	wp.customize( 'footer_bottom_anchor_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.slicko-footer-bottom a, .slicko-copywright a, .slicko-copywright li a' ).css( {
					'color': '#666666'
				} );
			} else {
				$( '.slicko-footer-bottom a, .slicko-copywright a, .slicko-copywright li a' ).css( {
					'color': to
				} );
			}
		} );
	} );

	wp.customize( 'slicko_site_layout', function( value ) {
		value.bind( function( to ) {
			if ( 'boxed_layout' === to ) {
				$( 'body' ).addClass('box-layout-page');
			} else {
				$( 'body' ).removeClass('box-layout-page');
			}
		} );
	} );



} )( jQuery );
