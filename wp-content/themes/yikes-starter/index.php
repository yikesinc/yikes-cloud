<?php
/**
 * The main template file.
 *
 * @package YIKES Starter
 */

if ( ! function_exists( 'get_header' ) ) {
	exit;
}

get_header(); ?>

<div id="main" tabindex="-1" class="site-main" role="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<div id="primary" class="content-area">
					<div id="content" class="site-content clearfix" role="main">
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<h1 class="entry-title"><?php echo esc_html( yikes_starter_blog_page_title() ); ?></h1>
							</header><!-- .entry-header -->

							<div class="entry-content">
								<?php if ( have_posts() ) : ?>

									<?php
									while ( have_posts() ) :
										the_post();
										?>

										<?php get_template_part( 'template-parts/content', 'posts' ); ?>

									<?php endwhile; ?>

									<!-- Next / Previous pagination without numbers is yikes_starter_paging_nav(); -->
									<?php echo wp_bootstrap_pagination(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

								<?php else : ?>

									<?php get_template_part( 'template-parts/content', 'none' ); ?>

								<?php endif; ?>
							</div>
						</article><!-- #post-## -->
					</div><!-- #content -->
				</div><!-- #primary -->
			</div><!-- .col-sm-9 -->

			<div class="col-sm-3">

				<?php get_sidebar(); ?>

			</div><!-- .col-sm-3 -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #main -->

<?php get_footer(); ?>
