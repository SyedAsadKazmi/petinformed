<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DisruptPress
 */

?>
<?php do_action( 'disruptpress_before_entry' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

    <?php do_action( 'disruptpress_before_entry_content' ); ?>
	<div class="entry-content" itemprop="text">
		<?php
        do_action( 'disruptpress_before_the_content' );
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'disruptpress' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
    <?php do_action( 'disruptpress_after_entry_content' ); ?>
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'disruptpress' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
