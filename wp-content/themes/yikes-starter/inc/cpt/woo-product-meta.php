<?php
/**
 * Woo Product Meta
 *
 * @package YIKES Starter
 */

// BEGIN Function to create and register custom post type Taxonomies.
add_action( 'init', 'create_product_occ_taxonomies', 0 );

/**
 * Create our Theme options page.
 *
 * Create Occasions taxonomy for the post type "product".
 * hook into the init action and call create_product_occ_taxonomies when it fires.
 */
function create_product_occ_taxonomies() {
	// Add new taxonomy, make it hierarchical (like CATEGORIES).
	// Labels for the new taxonomy.
	$names_occasions = array(
		'name'                  => _x( 'Occasions', 'taxonomy general name' ),
		'singular_name'         => _x( 'Occasion', 'taxonomy singular name' ),
		'search_items'          => __( 'Search Occasions' ),
		'all_items'             => __( 'All Occasions' ),
		'parent_item'           => __( 'Parent Occasion' ),
		'parent_item_colon'     => __( 'Parent Occasion:' ),
		'edit_item'             => __( 'Edit Occasion' ),
		'view_item'             => __( 'View Occasion' ),
		'update_item'           => __( 'Update Occasion' ),
		'add_new_item'          => __( 'Add New Occasion' ),
		'new_item_name'         => __( 'New Occasion Name' ),
		'menu_name'             => __( 'Occasions' ),
		'not_found'             => __( 'No Occasions found.' ),
		'no_terms'              => __( 'No occasions' ), /* Used when indiCATing no terms in given taxonomy. Default “No tags”/”No CATegories”. */
		'items_list_navigation' => __( 'Occasions list navigation' ), /* SR text for pagination on term listing screen. Default “Tags list navigation”/”CATegories list navigation” */
		'items_list'            => __( 'Occasions list' ), /* SR text for items list on term listing screen. Default “Tags list”/”CATegories list” */
	);
	// parameters for the new taxonomy.
	$args_occasions = array(
		'hierarchical'      => true,
		'labels'            => $names_occasions,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'occasions' ),
	);

	register_taxonomy( 'occasion', array( 'product' ), $args_occasions );
}

/** END Function to create and register custom post type Taxonomies. */

// BEGIN Function to create and register custom fields for custom post type.
add_filter( 'yks_mboxes', 'woo_product_metaboxes' );

/**
 * Create our meta boxes.
 *
 * @param array $mboxes Set our metaboxes for our products.
 */
function woo_product_metaboxes( array $mboxes ) {

	// prefix for all custom fields.
	$prefix = 'woo_product_';

	$mboxes[] = array(
		'id'         => 'woo_product_metabox',
		'title'      => 'Additional Product Details',
		'pages'      => array( 'product' ), // Post type.
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left.
		'fields'     => array(
			// simple medium text field for form.
			array(
				'name'      => 'Weight',
				'id'        => $prefix . 'weight',
				'type'      => 'text_medium',
				'repeating' => false, // Ability to add and sort repeating fields.
			),
		),
	);

	return $mboxes;
}

/** END Function to create and register custom fields for custom post type */



