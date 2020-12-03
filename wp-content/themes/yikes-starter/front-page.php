<?php
/**
 * The static home page (in Reading settings) template file.
 *
 * @package YIKES Starter
 */

get_header(); ?>

<div id="main" tabindex="-1" class="site-main" role="main">

	<!-- If you want to make use of home page content -->
	<div class="container">
		<div class="row">
			<div class="col">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->
					</article><!-- #post-## -->

				<?php endwhile; ?>
			</div><!-- .col -->
		</div><!-- .row -->
	</div><!-- .container -->

	<!-- If you want to use home page content for an alert box -->
	<div class="container">
		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php
			if ( '' !== get_post()->post_content ) {
				?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span>
				</button>
				<span class="screen-reader-text">Alert Notice:</span>
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> 
				<?php the_content(); ?>
			</div>
		<?php } ?>

		<?php endwhile; ?>
	</div><!-- .container -->

	<!-- Sample home page boxes -->
	<section id="home-boxes">
		<div class="container site-loop">
			<div class="card-deck">
				<div class="card">
					<div class="card-header">
						Featured
					</div>
					<img class="card-img-top" src="https://cldup.com/lQHR05Qone.jpg" alt="">
					<div class="card-body">
						<h3 class="card-title">Card title</h3>
						<div class="card-text">
							<p>
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus.
							</p>
						</div>
					</div>
					<div class="card-footer">
						<a href="#" class="btn btn-primary btn-block">
							Read More <span class="screen-reader-text">about [title]</span>
						</a>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						Featured
					</div>
					<img class="card-img-top" src="https://cldup.com/lQHR05Qone.jpg" alt="">
					<div class="card-body">
						<h3 class="card-title">Card title</h3>
						<div class="card-text">
							<p>
								Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.
							</p>
						</div>
					</div>
					<div class="card-footer">
						<a href="#" class="btn btn-primary btn-block">
							Read More <span class="screen-reader-text">about [title]</span>
						</a>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						Featured
					</div>
					<img class="card-img-top" src="https://cldup.com/lQHR05Qone.jpg" alt="">
					<div class="card-body">
						<h3 class="card-title">Card title</h3>
						<div class="card-text">
							<p>
								Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. 
							</p>
						</div>
					</div>
					<div class="card-footer">
						<a href="#" class="btn btn-primary btn-block">
							Read More <span class="screen-reader-text">about [title]</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Sample home content sections -->
	<section id="home-blocks">
		<div class="container site-loop">
			<div class="card-group">
				<div class="card">
					<img class="card-img" src="https://cldup.com/lQHR05Qone.jpg" alt="">
					<div class="card-img-overlay"></div>
				</div>
				<div class="card">
					<div class="card-body">
						<h3 class="card-title">Card title</h3>
						<div class="card-text">
							<p>
								Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. Nam nulla quam, gravida non, commodo a, sodales sit amet, nisi.
							</p>
						</div>
						<a href="#" class="btn btn-primary btn-block">
							Read More <span class="screen-reader-text">about [title]</span>
						</a>
					</div>
				</div>
				<div class="card">
					<img class="card-img" src="https://cldup.com/lQHR05Qone.jpg" alt="">
					<div class="card-img-overlay"></div>
				</div>
				<div class="card">
					<div class="card-body">
						<h3 class="card-title">Card title</h3>
						<div class="card-text">
							<p>
								Pellentesque fermentum dolor. Aliquam quam lectus, facilisis auctor, ultrices ut, elementum vulputate, nunc.
							</p>
						</div>
						<a href="#" class="btn btn-primary btn-block">
							Read More <span class="screen-reader-text">about [title]</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

</div><!-- #main -->

<?php get_footer(); ?>
