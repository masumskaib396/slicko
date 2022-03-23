<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Slicko
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="primary" class="<?php echo esc_attr( slicko_content_class() ); ?>">

	<main id="main" class="site-main">

	<?php
	if ( have_posts() ) :

		if ( is_home() && ! is_front_page() ) :
			?>
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>
			<?php
		endif;

		?>

		<div class="row posts-row blog-content-area">
			<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					?>

						<div class="<?php echo esc_attr( slicko_column_wrap_calc() ); ?>">
							<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
						</div>
					<?php

				endwhile;
			?>
		</div>

		<?php


echo get_the_posts_pagination();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
