<?php
/**
 * The template used for general content
 *
 * @package YIKES Starter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h1>

		<div class="entry-meta">
			<?php yikes_starter_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_attr__( 'Pages:', 'yikes_starter' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_attr__( ', ', 'yikes_starter' ) );
			if ( $categories_list && yikes_starter_categorized_blog() ) {
				?>
				<span class="cat-links">
					<?php echo 'Posted in ' . esc_html( $categories_list ); ?>
				</span>
				<?php
			}

			$tags_list = get_the_tag_list( '', esc_attr__( ', ', 'yikes_starter' ) );

			if ( $tags_list ) {
				?>
				<span class="tags-links">
					<?php
					echo 'Tagged ' . esc_html( $tags_list );
					?>
				</span>
				<?php
			}
		}

		if ( ! post_password_required() && ( comments_open() || '0' !== get_comments_number() ) ) {
			?>
			<span class="comments-link">
				<?php comments_popup_link( esc_attr__( 'Leave a comment', 'yikes_starter' ), esc_attr__( '1 Comment', 'yikes_starter' ), esc_attr__( '% Comments', 'yikes_starter' ) ); ?>
			</span>
			<?php
		}

		edit_post_link( esc_attr__( 'Edit', 'yikes_starter' ), '<div class="edit-link"><i class="fa fa-pencil" aria-hidden="true"></i>', '</div>' );
		?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
