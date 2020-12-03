<?php
/**
 * Post Options
 *
 * @package YIKES Starter
 */

// BEGIN Function to create and register custom fields for default posts.
add_filter( 'yks_mboxes', 'yks_cpt_posts_metaboxes' );

/**
 * Create our Post options.
 *
 * @param array $mboxs Set our additional metaboxes for Posts.
 */
function yks_cpt_posts_metaboxes( array $mboxs ) {

	// prefix for all custom fields.
	$prefix = 'posts_';

	// get the ID of the home page.
	$frontpage_id = get_option( 'page_on_front' );
	// get the ID of the blog page.
	$blogpage_id = get_option( 'page_for_posts' );

	// A first metabox.
	$mboxs[] = array(
		'id'         => 'cpt_posts_metabox', // rename with site namespace.
		'title'      => 'Post Details',
		'pages'      => array( 'post' ), // Post type - post or page.
		'hide_on'    => array(
			'key'   => 'id',
			'value' => array( $frontpage_id ), // Or use show_on if you only want to show on the home page.
		),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left.
		'fields'     => array(
			// Title, to display titles only - 'title'.
			array(
				'name' => 'Test Title Weeeee',
				'desc' => 'This field is simply a title. Nothing more.',
				'id'   => $prefix . 'test_title',
				'type' => 'title',
			),

			// Message, to display messages only - 'message'.
			array(
				'desc' => 'This field is simply a message. Nothing more.',
				'type' => 'message',
				'id'   => $prefix . 'message_test',
			),

			// Text - 'text'.
			array(
				'name'            => 'Test Text 1',
				'desc'            => 'field description (optional)',
				'id'              => $prefix . 'test_text1',
				'type'            => 'text',
				'repeating'       => false,
				'desc_type'       => 'block',
				'std'             => 'test text 1 std',
				'column'          => true, // Set to 'true' to enable columns for this field. Note if repeating fields is enabled this will not work as it's not supported.
				'sortable_column' => 'true', // Set to true to make columns sortable.
				'column_orderby'  => '', // Only for sortable columns. Default is by this field's meta value 'meta_value_num'. However, you can set to following options 'title', 'meta_value', 'author', 'id', 'date', 'modified', and 'rand'.
				'repeat_btn_text' => 'Another one',
			),
		),
	);

	return $mboxs;
}

// END Function to create and register custom fields for custom post type.
