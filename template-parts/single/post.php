<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Slicko
 */

?>

<article id="post-<?php the_ID(); ?>" <?php echo esc_attr( slicko_content_class() ); ?>>

    <div class="blog-details-page">
        <div class="post-thumbnail">
            <?php slicko_post_thumbnail(); ?>
        </div>
        <div class="single-post-content-wrap">

		<div class="entry-content clearfix">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'slicko' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					esc_html( get_the_title() )
				)
			);?>
		<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'slicko' ),
					'after'  => '</div>',
				)
			);
			?>
		</div>


		<footer class="entry-footer">
			 <?php slicko_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .entry-content -->
    </div>


</article><!-- #post-<?php the_ID(); ?> -->