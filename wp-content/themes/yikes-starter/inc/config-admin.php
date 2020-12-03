<?php
/**
 * Customize wp-admin.
 *
 * @package YIKES Starter
 */

// Custom CSS for admin logo and layout.
add_action( 'login_head', 'yks_admin_styles' );
add_action( 'admin_head', 'yks_admin_styles' );

/**
 * Enqueue our custom style sheet.
 */
function yks_admin_styles() {
	wp_enqueue_style( 'yikes-bootstrap-style', get_template_directory_uri() . '/inc/css/style-admin.css', array(), 'all' );
}


// Re-order admin panel.
add_filter( 'custom_menu_order', 'yks_reorder_admin_menu' );
add_filter( 'menu_order', 'yks_reorder_admin_menu' );

/**
 * Create our custom menu order.
 *
 * @param array $__return_true Set our order for menu items in wp-admin.
 */
function yks_reorder_admin_menu( $__return_true ) {
	return array(
		'index.php',                     // This represents the dashboard link.
		'edit.php?post_type=page',       // This is the default page menu.
		'edit.php',                      // This is the default POST admin menu.
		// 'edit.php?post_type=cpt_cat', // This is for a CPT.
		'edit-comments.php',             // Comments.
		'separator1',                    // First separator.
		'themes.php',                    // Appearance.
		'upload.php',                    // Media tab.
	);
}
