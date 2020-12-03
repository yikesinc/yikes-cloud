<?php
/**
 * The Template for displaying all single posts.
 *
 * @package YIKES Starter
 */

get_header(); ?>

<div id="main" tabindex="-1" class="site-main" role="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="primary" class="content-area">
					<div id="content" class="site-content clearfix" role="main">
						<?php
						while ( have_posts() ) :
							the_post();
							?>

							<?php get_template_part( 'template-parts/content', 'single' ); ?>

							<?php echo yikes_starter_post_nav(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

							<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || '0' !== get_comments_number() ) {
								comments_template();
							}
							?>

						<?php endwhile; ?>
					</div><!-- #content -->
				</div><!-- #primary -->
			</div><!-- .col-sm-12 -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #main -->

<?php get_footer(); ?>
