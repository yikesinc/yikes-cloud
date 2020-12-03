<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package YIKES Starter
 */

?>
<div id="main" tabindex="-1" class="site-main" role="main">
	<header class="entry-header">
		<div class="container">
			<div class="row">
				<div class="col" 
					<?php if ( ( get_post_meta( $post->ID, 'page_header_bg_image', true ) ) ) { ?>
						style="background: url( <?php echo esc_url( get_post_meta( $post->ID, 'page_header_bg_image', true ) ); ?> ) no-repeat center top fixed;"
					<?php } ?>	
				>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</div><!-- .col-sm-12 -->
			</div><!-- .row -->
		</div><!-- .container -->
	</header><!-- .entry-header -->

	<div id="primary" class="content-area">
		<div id="content" class="site-content clearfix" role="main">		
			<div class="container">
				<div class="row">
					<div class="col">
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="entry-content">
								<?php
								if ( function_exists( 'yoast_breadcrumb' ) ) {
									yoast_breadcrumb( '<div class="breadcrumb">', '</div>' );
								}
								?>
								<?php the_content(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-## -->
					</div><!-- .col-sm-12 -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main -->	
