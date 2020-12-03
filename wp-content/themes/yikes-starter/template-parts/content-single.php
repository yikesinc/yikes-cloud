<?php
/**
 * The template used for single page content
 *
 * @package YIKES Starter
 */

?>

<header class="post-header">
	<h1 class="entry-title"><?php the_title(); ?></h1>

	<div class="entry-meta">
		<?php yikes_starter_posted_on(); ?>
	</div><!-- .entry-meta -->
</header><!-- .entry-header -->

<div class="post-content">
	<?php the_content(); ?>
</div><!-- .entry-content -->

<footer class="entry-meta">
	<?php
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
					  </span> 
					  <span class="footer-entry-meta-item">
					  	<i class="far fa-fw fa-bookmark"></i> 
					  	<a href="%3$s" title="Permalink to %4$s" rel="bookmark">Post link</a>
					  </span>';

	} elseif ( ! empty( $tag_list ) ) {

		// If we only have tags.
		$meta_text = '<span class="footer-entry-meta-item">
						<i class="fa fa-fw fa-tags"></i> %2$s
					  </span> 
					  <span class="footer-entry-meta-item">
					  	<i class="far fa-fw fa-bookmark"></i> 
					  	<a href="%3$s" title="Permalink to %4$s" rel="bookmark">Post link</a>
					  </span>';

	} elseif ( ! empty( $category_list ) ) {

		// If we only have categories.
		$meta_text = '<span class="footer-entry-meta-item">
						<i class="fa fa-fw fa-folder-open"></i> %1$s
					  </span>
					  <span class="footer-entry-meta-item">
					  	<i class="far fa-fw fa-bookmark"></i> 
					  	<a href="%3$s" title="Permalink to %4$s" rel="bookmark">Post link</a>
					  </span>';

	} else {

		// If we have neither categories nor tags.
		$meta_text = '<span class="footer-entry-meta-item">
					  	<i class="far fa-fw fa-bookmark"></i> 
					  	<a href="%3$s" title="Permalink to %4$s" rel="bookmark">Post link</a>
					  </span>';

	}

	// Display the cats/tags & the post link.
	printf(
		$meta_text,      // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		$category_list,  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		$tag_list,       // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		get_permalink(), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		the_title_attribute( array( 'echo' => false ) )
	);
	?>
</footer><!-- .entry-meta -->
