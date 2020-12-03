<?php
/**
 * The template for displaying search forms in YIKES Starter
 *
 * @package YIKES Starter
 */

?>

<form role="search" class="form-inline search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
	<div class="input-group">
		<label class="screen-reader-text" for="search">
			<?php _ex( 'Search for:', 'label', 'yikes_starter' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</label>
		<input type="text" name="s" id="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'yikes_starter' ); ?>" value="<?php the_search_query(); ?>" title="<?php _ex( 'Search for:', 'label', 'yikes_starter' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" />
		<div class="input-group-append">
			<button type="submit" class="btn btn-primary search-submit">
				<i class="fal fa-search"></i> <span class="screen-reader-text"><?php echo esc_attr_x( 'Search', 'submit button', 'yikes_starter' ); ?></span>				
			</button>
		</div>
	</div>
</form>
