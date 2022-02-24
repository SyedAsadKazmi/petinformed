<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DisruptPress
 */

?>






<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

	<div class="entry-content">



		
		<?php
		

            //echo esc_attr( get_the_title() );
		//the_excerpt();
           // echo '<div class="blog-featured-image">';

            //echo get_the_post_thumbnail( $post->ID, 'full' );
            //echo '</div>';

            $cat ='';
            $i = 0;
            $separator = ', ';
            foreach( ( get_the_category() ) as $category ) {
                if ( $category->cat_name != 'Uncategorized' ) {
                    if ( 0 < $i ) {
                        $cat .= $separator;
                    }
                    $cat .= $category->cat_name;
                    $i ++;
                }
            }

//            echo '<div class="dp-custom-post-loop-wrap-parent">
//									<div class="dp-custom-post-loop-wrap-child">
//
//							<a href="'.get_permalink().'">
//								<div class="dp-custom-post-loop-image">
//								</div>
//								<div class="dp-custom-post-loop-content-wrap">
//								<div class="dp-custom-post-loop-title"></div>
//								<div class="dp-custom-post-loop-meta">
//									<div class="dp-custom-post-loop-date">'.get_the_date().'</div>
//									<div class="dp-custom-post-loop-cat">'.$cat.'</div>
//								</div>
//									</div>
//
//							</a>
//						</div>
//						'.the_excerpt().'
//					</div>';

//        if ( get_the_post_thumbnail( $post->ID, 'full' ) ) {
//            $thumbnail = '<div class="dp-blog-roll-loop-featured-image"><a href="'.get_permalink().'">' . get_the_post_thumbnail( $post->ID, 'full' ) . '</a></div>';
//        } else {
//            $thumbnail = '';
//        }
            echo '<div class="dp-blog-roll-loop-wrap">';

                if ( has_action( 'disruptpress_blog_roll_container_1' ) ) {
                    echo '<div class="dp-blog-roll-loop-container dp-blog-roll-loop-container-1">';
                    do_action( 'disruptpress_blog_roll_container_1' );
                    echo '</div>';
                }

                if ( has_action( 'disruptpress_blog_roll_container_2' ) ) {
                    echo '<div class="dp-blog-roll-loop-container dp-blog-roll-loop-container-2">';
                    do_action( 'disruptpress_blog_roll_container_2' );
                    echo '</div>';
                }

                if ( has_action( 'disruptpress_blog_roll_container_3' ) ) {
                    echo '<div class="dp-blog-roll-loop-container dp-blog-roll-loop-container-3">';
                    do_action( 'disruptpress_blog_roll_container_3' );
                    echo '</div>';
                }

            echo '</div>';


		
			//wp_link_pages( array(
			//	'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'disruptpress' ),
			//	'after'  => '</div>',
			//) );
		?>
	</div><!-- .entry-content -->



	<footer class="entry-footer">
		<p class="entry-meta">
			<?php disruptpress_entry_footer(); ?>
		</p>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->