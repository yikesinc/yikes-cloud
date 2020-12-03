<?php
/**
 * The template for displaying Archive pages.
 *
 * @package YIKES Starter
 */

get_header(); ?>

<div id="main" tabindex="-1" class="site-main" role="main">
	<div class="container">
		<div class="row">
			<div class="col">
				<div id="primary" class="content-area">
					<div id="content" class="site-content clearfix" role="main">
						<?php if ( have_posts() ) : ?>

							<header class="entry-header">
								<?php
									the_archive_title( '<h1 class="entry-title">', '</h1>' );
									the_archive_description( '<div class="taxonomy-description">', '</div>' );
								?>
							</header><!-- .entry-header -->

							<?php
							while ( have_posts() ) :
								the_post();
								?>

								<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

							<?php endwhile; ?>

							<?php echo yikes_starter_paging_nav(); // phpcs:ignore WordPress.Security.EscapeOutput ?>

						<?php else : ?>

							<?php get_template_part( 'template-parts/content', 'none' ); ?>

						<?php endif; ?>
					</div><!-- #content -->
				</div><!-- #primary -->
			</div><!-- .col-sm-12 -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #main -->

<?php get_footer(); ?>
