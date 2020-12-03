<?php
/**
 * The Template for displaying all single post content.
 *
 * @package YIKES Starter
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-container' ); ?>>
	<header class="post-header">
		<h2 class="post-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>

		<div class="entry-meta">
			<?php yikes_starter_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .post-header -->

	<div class="post-content">
		<?php the_excerpt(); ?>
	</div><!-- .post-content -->

	<footer class="entry-meta">
		<?php
		if ( 'post' === get_post_type() ) {
			$category_list = get_the_category_list( ', ' );
			$tag_list      = get_the_tag_list( '', ', ' );
			$meta_text     = '';

			if ( ! empty( $category_list ) && ! empty( $tag_list ) ) {

				// If we have categories and tags.
				$meta_text = '<span class="footer-entry-meta-item">
								<i class="fa fa-fw fa-folder-open"></i> %1$s
							  </span> 
							  <span class="footer-entry-meta-item">
							  	<i class="fa fa-fw fa-tags"></i> %2$s
							  </span>';

			} elseif ( ! empty( $tag_list ) ) {

				// If we only have tags.
				$meta_text = '<span class="footer-entry-meta-item">
								<i class="fa fa-fw fa-tags"></i> %2$s
							  </span>';

			} elseif ( ! empty( $category_list ) ) {

				// If we only have categories.
				$meta_text = '<span class="footer-entry-meta-item">
								<i class="fa fa-fw fa-folder-open"></i> %1$s
							  </span>';

			}
			// Display the cats/tags & the post link.
			printf(
				$meta_text,      // @codingStandardsIgnoreLine
				$category_list,  // @codingStandardsIgnoreLine
				$tag_list,       // @codingStandardsIgnoreLine
				get_permalink(), // @codingStandardsIgnoreLine
				the_title_attribute( array( 'echo' => false ) )
			);
		}
		edit_post_link( esc_attr__( 'Edit', 'yikes_starter' ), '<div class="edit-link"><i class="fa fa-fw fa-pencil" aria-hidden="true"></i> ', '</div>' );
		?>
	</footer><!-- .entry-meta -->
</div><!-- #post-## -->
