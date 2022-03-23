<?php



if ( ! function_exists( 'slicko_related_post_list' ) ) {

   /**

    * Related post list

    */

    function slicko_related_post_list(){

        ?>

        <div class="slicko-section bg-slicko-alabaster">

            <div class="container">

                <div class="slicko-section-title text-center">

                    <?php

                    $related_title = get_theme_mod('slicko_related_posts_title', __("Related Posts", "slicko"));

                    if ( $related_title ) {

                        echo '<h2>' . esc_html( $related_title  ) . '</h2>';

                    }

                    ?>

                </div>

                <?php

                if( function_exists('slicko_related_posts') ) :

                $related_query = new WP_Query( slicko_related_posts(get_the_ID()) );



                if ( $related_query->have_posts() ) : ?>

                <div class="row">

                    <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>

                    <div class="col-lg-4 col-md-6">

                        <div class="slicko-blog-wrap single-related-item slicko-blog-three-column m-b-none">

                            <?php if( has_post_thumbnail() ) : ?>

                            <div class="slicko-blog-thumb">

                                <?php the_post_thumbnail('slicko-featured-thumb'); ?>

                            </div>

                            <?php endif; ?>

                            <a class="slicko-related-title" href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>

                        </div>

                    </div>

                    <?php endwhile; ?>

					<?php wp_reset_postdata(); ?>

                </div><!-- .row -->

                <?php else : ?>

                    <p><?php esc_html_e( 'Sorry, no similar posts found.', 'slicko' ); ?></p>

                <?php endif; ?>

                <?php endif; ?>

            </div><!-- .container -->

        </div><!-- .slicko-section -->

        <?php

    }



}



/**

 * Managed functions for general section hooking

 *

 * @since 1.0.0

 */

add_action( 'slicko_related_posts', 'slicko_related_post_list' );