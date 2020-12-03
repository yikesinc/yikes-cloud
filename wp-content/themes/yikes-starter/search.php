<?php
/**
 * The template for displaying Search Results pages.
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
						<?php if ( have_posts() ) : ?>

							<header class="page-header">
								<h1 class="page-title">									
									<?php
									/* translators: The search term is after the colon */
									printf( esc_attr__( 'Search Results for: %s', 'yikes_starter' ), '<span>' . get_search_query() . '</span>' );
									?>
								</h1> 
							</header>

							<?php
							while ( have_posts() ) :
								the_post();
								?>

								<?php get_template_part( 'template-parts/content', 'search' ); ?>

							<?php endwhile; ?>

							<?php yikes_starter_paging_nav(); ?>

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
