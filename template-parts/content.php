<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Slicko
 */
$slicko_classes = array(
	"slicko-default-hentry",
	"slicko-default-hentry",
	"slicko-blog-wrap"
);
if (!has_post_thumbnail()) {
	$slicko_classes[] = "slicko-hentry-without-thumbnail";
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($slicko_classes); ?>>
	<div class="post-single-item">
		<div class="post-thumbnail">
			<div class="entry-media">
				<?php slicko_post_thumbnail(); ?>
				<?php
				if (is_sticky()) {
					echo '<span class="sticky-text" >' . esc_html__('Sticky', 'slicko') . '</span>';
				}
				?>
			</div>
		</div>
		<div class="post-content">
			<div class="slicko-blog-content slicko-blog-content-2">
				<header class="entry-header">
					<?php
					if ('post' === get_post_type()) :
					?>
						<div class="entry-meta">
							<?php
							slicko_posted_on();
							?>
						</div><!-- .entry-meta -->
					<?php endif;

					if (is_singular()) :
						the_title('<h1 class="entry-title slicko-blog-title">', '</h1>');
					else :
						the_title('<h2 class="entry-title slicko-blog-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
					endif;
					?>
				</header><!-- .entry-header -->

			</div>
		</div>
	</div>



</article><!-- #post-<?php the_ID(); ?> -->