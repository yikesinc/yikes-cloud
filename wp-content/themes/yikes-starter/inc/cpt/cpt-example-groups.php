<?php
/**
 * Custom Post Types with grouped meta
 *
 * @package YIKES Starter
 */

/** BEGIN Function to create and register custom post type **/
function yks_register_cpt_kitten() {
	// All the labels.
	$names = array(
		'name'                     => 'Cats',
		'singular_name'            => 'Cat',
		'add_new'                  => 'Add New',
		'add_new_item'             => 'Add New Cat',
		'edit_item'                => 'Edit Cat',
		'new_item'                 => 'New Cat',
		'view_item'                => 'View Cat',
		'search_items'             => 'Search Cats',
		'not_found'                => 'No Cats found',
		'not_found_in_trash'       => 'No Cats found in Trash',
		'parent_item_colon'        => '',
		'all_items'                => 'All Cats',
		'menu_name'                => 'Cats',
		'featured_image'           => 'Cat Photo',
		'set_featured_image'       => 'Set Cat Photo',
		'remove_featured_image'    => 'Remove Cat Photo',
		'use_featured_image'       => 'Use as Cat Photo',
		'archives'                 => 'Cat Archives', /* "Post Archives" (archive label in nav menus). */
		'insert_into_item'         => 'Insert into Cat', /* "Insert into post" (inserting media into a post) */
		'uploaded_to_this_item'    => 'Uploaded to this Cat', /* "Uploaded to this post" (media attached to post). */
		'filter_items_list'        => 'Filter Cats list', /* "Filter posts list" (Screen Reader text for filter links) */
		'items_list_navigation'    => 'Cats list navigation', /* "Posts list navigation" (Screen Reader text for pagination)  */
		'items_list'               => 'Cats list', /* "Posts list" (Screen Reader text for items list heading)  */
		'item_published'           => 'Cat published.',  /* “Post published.” (notice after publishing a post) */
		'item_published_privately' => 'Cat published privately.',  /* “Post published.” (notice after publishing a private post) */
		'item_reverted_to_draft'   => 'Cat reverted to draft.',  /* “Post reverted to draft.” (notice after reverting a post to draft) */
		'item_scheduled'           => 'Cat scheduled.',  /* “Post scheduled.” (notice after scheduling a post) */
		'item_updated'             => 'Cat updated.',  /* “Post updated.” (notice after updating a post) */
	);
	// CPT's parameters.
	$args = array(
		'labels'              => $names,
		'description'         => 'A short descriptive summary of what the post type is.',
		'public'              => true,
		'hierarchical'        => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-smiley',
		'capability_type'     => 'post',
		'query_var'           => true,
		'has_archive'         => true,
		'rewrite'             => array( 'slug' => 'cats' ),
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'trackbacks', 'page-attributes' ),
		'show_in_rest'        => true, // Use true if you want the editor to use Gutenberg.
	);
	// register CPT.
	register_post_type( 'cpt_kitten', $args );
}
// initiate CPT.
add_action( 'init', 'yks_register_cpt_kitten' );

/** END Function to create and register custom post type */


/** BEGIN Function to create and register custom fields for custom post type */
add_filter( 'yks_mboxes', 'yks_cpt_kitten_metaboxes' );

/**
 * Create our meta boxes.
 *
 * @param array $mboxs Set our metaboxes for our theme options page.
 */
function yks_cpt_kitten_metaboxes( array $mboxs ) {

	// prefix for all custom fields.
	$prefix = 'kittens_';

	// A test metabox.
	$mboxs[] = array(
		'id'         => 'cpt_kitten_metabox_1',
		'title'      => 'More Kitten Details ++ Groups???',
		'pages'      => array( 'cpt_kitten' ), // Post type.
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left.
		'group'      => true,
		'fields'     => array(

			array(
				'name' => 'Test Text -1',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_text_box_12100',
				'type' => 'text',
			),

			array(
				'name'   => 'Group 1',
				'desc'   => 'description for group 1',
				'id'     => $prefix . 'group1',
				'type'   => 'group',
				'fields' => array(
					array(
						'name' => 'Test Text 1',
						'desc' => 'field description (optional)',
						'id'   => $prefix . 'test_text_box_111',
						'type' => 'text',
					),
					array(
						'name' => 'Test Text 2',
						'desc' => 'field description (optional)',
						'id'   => $prefix . 'test_text_box_222',
						'type' => 'text',
					),
					array(
						'name' => 'Test Text 3',
						'desc' => 'field description (optional)',
						'id'   => $prefix . 'test_text_box_333',
						'type' => 'text',
					),
					array(
						'name' => 'Test Text 4',
						'desc' => 'field description (optional)',
						'id'   => $prefix . 'test_text_box_444',
						'type' => 'text',
					),
				),
			),

			array(
				'name'   => 'Group 2',
				'desc'   => 'description for group 2',
				'id'     => $prefix . 'group2',
				'type'   => 'group',
				'fields' => array(
					array(
						'name' => 'Test Text 5',
						'desc' => 'field description (optional)',
						'id'   => $prefix . 'test_text_box_555',
						'type' => 'text',
					),
					array(
						'name' => 'Test Text 6',
						'desc' => 'field description (optional)',
						'id'   => $prefix . 'test_text_box_666',
						'type' => 'text',
					),
					array(
						'name' => 'Test Text 7',
						'desc' => 'field description (optional)',
						'id'   => $prefix . 'test_text_box_777',
						'type' => 'text',
					),
					array(
						'name' => 'Test Text 8',
						'desc' => 'field description (optional)',
						'id'   => $prefix . 'test_text_box_888',
						'type' => 'text',
					),
				),
			),

			array(
				'name' => 'Test Text 9',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_text_box_121',
				'type' => 'text',
			),
			array(
				'name' => 'Test Text 10',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_text_box_232',
				'type' => 'text',
			),
			array(
				'name' => 'Test Text 11',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_text_box_343',
				'type' => 'text',
			),
			array(
				'name' => 'Test Text 12',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_text_box_454',
				'type' => 'text',
			),
		),
	);

	// A second metabox.
	$mboxs[] = array(
		'id'         => 'cpt_kitten_metabox_2',
		'title'      => 'Kitten Details',
		'pages'      => array( 'cpt_kitten' ), // Post type.
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left.
		'group'      => true,
		'fields'     => array(
			array(
				'name'   => 'Group 1',
				'desc'   => 'description for group 1',
				'id'     => $prefix . 'group2_1',
				'type'   => 'group',
				'fields' => array(

					// Message, to display messages only - 'message'.
					array(
						'desc' => 'This field is simply a message. Nothing more.',
						'type' => 'message',
						'id'   => $prefix . 'message_test_g1',
					),
				),
			),
			array(
				'name'   => 'Group 2',
				'desc'   => 'description for group 2',
				'id'     => $prefix . 'group2_2',
				'type'   => 'group',
				'fields' => array(

					// Message, to display messages only - 'message'.
					array(
						'desc' => 'This field is simply a message. Nothing more.',
						'type' => 'message',
						'id'   => $prefix . 'message_test_g2',
					),

					// Text - 'text'.
					array(
						'name'      => 'Test Text 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_text1_g2',
						'type'      => 'text',
						'repeating' => true,
						'desc_type' => 'block',
						'std'       => 'test text 1 std',
					),

					// Text 2 - 'text'.
					array(
						'name'      => 'Test Text 2',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_text2_g2',
						'type'      => 'text',
						'repeating' => true,
						'desc_type' => 'block',
						'std'       => 'test text 2 std',
					),

					// Text Medium - 'text_medium'.
					array(
						'name'      => 'Test Text Medium 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_textmedium1_g2',
						'type'      => 'text_medium',
						'repeating' => true,
					),

					// Text Small - 'text_small'.
					array(
						'name'      => 'Test Text Small 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_textsmall_g2',
						'type'      => 'text_small',
						'repeating' => true,
						'desc_type' => 'block',
						'std'       => 'default text value, test text small 1',
					),

					// Textarea - 'textarea'.
					array(
						'name'      => 'Test Text Area 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_textarea1_g2',
						'type'      => 'textarea',
						'repeating' => true,
					),

					// Textarea Small - 'textarea_small'.
					array(
						'name'      => 'Test Text Area Small 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_textareasmall1_g2',
						'type'      => 'textarea_small',
						'repeating' => true,
					),

					// Textarea Code - 'textarea_code'.
					array(
						'name'      => 'Test Text Area (allows code)',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_textarea_code1_g2',
						'type'      => 'textarea_code',
						'repeating' => true,
					),

					// WYSIWYG - 'wysiwyg'.
					array(
						'name'      => 'Test wysiwyg 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_wysiwyg1_g2',
						'type'      => 'wysiwyg',
						'options'   => array( 'textarea_rows' => 5 ),
						'desc_type' => 'block',
					),

					// Text Desc-Value - 'text_desc_value'.
					array(
						'name'      => 'Test Text Description/Value 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_desc_value1_g2',
						'type'      => 'text_desc_value',
						'classes'   => array( array( 'yks_txt_small' ), array( 'yks_txt_medium' ) ),
						'repeating' => true, // Ability to add and sort repeating fields.
					),

					// Textarea Desc/Value - 'textarea_desc_value'.
					array(
						'name'      => 'Test Text Area Desc/Value 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_textarea_desc_value1_g2',
						'type'      => 'textarea_desc_value',
						'repeating' => true,
					),

					// Questions - 'questions'.
					array(
						'name'      => 'Test Questions 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_questions1_g2',
						'type'      => 'questions',
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Text Three Fields - 'text_three_fields'.
					array(
						'name'      => 'Three Text Fields 1',
						'desc'      => 'Three text fields.',
						'id'        => $prefix . 'three_text_fields1_g2',
						'type'      => 'text_three_fields',
						'classes'   => array( array( 'yks_txt_small' ), array( 'yks_txt_small' ), array( 'yks_txt_small' ) ),
						'repeating' => true,
					),

					// Text URL - 'text_url'.
					array(
						'name'      => 'Text URL 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_texturl1_g2',
						'type'      => 'text_url',
						'repeating' => true,
					),

					// URL Link Text/URL - 'text_url_desc_value'.
					array(
						'name'      => 'Test URL Link Text/URL 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'text_urldescval_g2',
						'type'      => 'text_url_desc_value',
						'desc_type' => 'block',
						'repeating' => true,
					),

					// Link Picker - 'link_picker'.
					array(
						'name'       => 'Test Link Picker 1',
						'desc'       => 'field description (optional)',
						'id'         => $prefix . 'test_link_picker1_g2',
						'type'       => 'link_picker',
						'post-types' => array( 'any' ), // Always use an array, use array( 'any' ) for all post types.
						'repeating'  => true,
						'desc_type'  => 'block',
					),
					array(
						'name'      => 'Test Link Picker 2',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_link_picker2_g2',
						'type'      => 'link_picker',
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Menu Picker - 'select_menu'.
					array(
						'name'      => 'Test Select Menu 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_select_menu1_g2',
						'type'      => 'select_menu',
						'desc_type' => 'block',
					),

					// Email - 'text_email'.
					array(
						'name'      => 'Test Email',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'text_email_g2',
						'type'      => 'text_email',
						'desc_type' => 'block',
						'repeating' => true,
					),

					// Money - 'text_money'.
					array(
						'name'      => 'Test Money 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_textmoney1_g2',
						'type'      => 'text_money',
						'repeating' => true,
					),

					// Text Number - 'text_number'.
					array(
						'name'      => 'Test Number 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_text_number1_g2',
						'type'      => 'text_number',
						'repeating' => true,
					),

					// Text Phone Number - 'text_phone_number'.
					array(
						'name'      => 'phone 1',
						'desc'      => 'Phone ###',
						'id'        => $prefix . 'phone_number1_g2',
						'type'      => 'text_phone_number',
						'repeating' => true,
					),

					// Zip Code 'zip_code'.
					array(
						'name'      => 'Zip Code 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_zipcode1_g2',
						'type'      => 'zip_code',
						'repeating' => true,
					),

					// Zip Code US 'zip_code_us'.
					array(
						'name'      => 'Zip Code US 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_zipcode_us1_g2',
						'type'      => 'zip_code_us',
						'repeating' => true,
					),

					// Text Time 'text_time'.
					array(
						'name'      => 'Test Time 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_time1_g2',
						'type'      => 'text_time',
						'repeating' => true,
					),

					// Text Time Formatted 'text_time_formatted'.
					array(
						'name'      => 'Test Time Picker Dropdowns 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'text_time_formatted1_g2',
						'type'      => 'text_time_formatted',
						'repeating' => true,
					),

					// End Text Time Formatted - 'end_text_time_formatted'.
					array(
						'name'      => 'Test End Text Time Formatted 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'end_text_time_formatted1_g2',
						'type'      => 'end_text_time_formatted',
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Text Date - 'text_date'.
					array(
						'name'      => 'Test Date Picker 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_textdate1_g2',
						'type'      => 'text_date',
						'repeating' => true,
					),

					// Text Date Year - 'text_date_year'.
					array(
						'name'      => 'Test Text Date Year 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'text_date_year1_g2',
						'type'      => 'text_date_year',
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Text Date TimeStamp - 'text_date_timestamp'.
					array(
						'name'      => 'Test Date Picker (UNIX timestamp) 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_date_timestamp1_g2',
						'type'      => 'text_date_timestamp',
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Text Date MySQL - 'text_date_mysql'.
					array(
						'name'      => 'Test Date Picker (MySQL date stamp) 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_date_mysql1_g2',
						'type'      => 'text_date_mysql',
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Text DateTime Timestamp - 'text_datetime_timestamp'.
					array(
						'name'      => 'Test Date/Time Picker Combo (UNIX timestamp) 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_datetime_timestamp1_g2',
						'type'      => 'text_datetime_timestamp',
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Text DateTime MySql - 'text_datetime_mysql'.
					array(
						'name'      => 'Test Date & Time Picker (MySQL date stamp) 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_datetime_mysql1_g2',
						'type'      => 'text_datetime_mysql',
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Address - 'address'.
					array(
						'name'            => 'Test Address 1',
						'desc'            => 'field description (optional)',
						'id'              => $prefix . 'test_address1_g2',
						'type'            => 'address',
						'repeating'       => true,
						'desc_type'       => 'block',
						'repeat_btn_text' => 'Add an Address',
					),

					// Select State/Providence - 'select_state_providence'.
					array(
						'name'      => 'Test Select State/Providence 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_select_state_providence1_g2',
						'type'      => 'select_state_providence',
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Select Country - 'select_country'.
					array(
						'name'      => 'Test Country 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_select_country1_g3',
						'type'      => 'select_country',
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Select - 'select'.
					array(
						'name'      => 'Test Select 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_select1_g3',
						'type'      => 'select',
						'options'   => array(
							array(
								'name'  => 'Option One',
								'value' => 'standard',
							),
							array(
								'name'  => 'Option Two',
								'value' => 'custom',
							),
							array(
								'name'  => 'Option Three',
								'value' => 'none',
							),
						),
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Radio - 'radio'.
					array(
						'name'      => 'Test Radio 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_radio1_g3',
						'type'      => 'radio',
						'options'   => array(
							array(
								'name'  => 'Option One',
								'value' => 'standard',
							),
							array(
								'name'  => 'Option Two',
								'value' => 'custom',
							),
							array(
								'name'  => 'Option Three',
								'value' => 'none',
							),
						),
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Radio Inline - 'radio_inline'.
					array(
						'name'      => 'Test Radio inline 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_radio_inline1_g3',
						'type'      => 'radio_inline',
						'options'   => array(
							array(
								'name'  => 'Option One',
								'value' => 'standard',
							),
							array(
								'name'  => 'Option Two',
								'value' => 'custom',
							),
							array(
								'name'  => 'Option Three',
								'value' => 'none',
							),
						),
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Checkbox - 'checkbox'.
					array(
						'name'      => 'Test Checkbox 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_checkbox1_g3',
						'value'     => '1', // place value you want to return.
						'type'      => 'checkbox',
						'repeating' => true,
						'desc_type' => 'block',
					),

					// MultiCheck - 'multicheck'.
					array(
						'name'      => 'Test Multi Checkbox 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_multicheckbox1_g3',
						'type'      => 'multicheck',
						'options'   => array(
							'check1' => 'Check One',
							'check2' => 'Check Two',
							'check3' => 'Check Three - A long checkbox name!! ++ hi',
						),
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Youtube - 'youtube'.
					array(
						'name'      => 'YouTube 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'youtube1_g3',
						'type'      => 'youtube',
						'repeating' => true,
					),

					// oEmbed - 'oembed'.
					array(
						'name'      => 'oEmbed 1',
						'desc'      => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
						'id'        => $prefix . 'test_embed1_g3',
						'type'      => 'oembed',
						'repeating' => true,
						'desc_type' => 'block',
					),

					// File - 'file'.
					array(
						'name'      => 'Test File 1',
						'desc'      => 'Upload an image or enter an URL.',
						'id'        => $prefix . 'test_file1_g3',
						'type'      => 'file',
						'view'      => 'url',
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Colorpicker - 'colorpicker'.
					array(
						'name     ' => 'Test Color Picker 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_colorpicker1_g3',
						'type'      => 'colorpicker',
						'std'       => '#ffffff',
						'repeating' => true,
						'desc_type' => 'inline',
					),

					// Colorpicker Select 'colorpicker_select'.
					array(
						'name'      => 'Test Color Picker 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_colorpicker_select1_g3',
						'type'      => 'colorpicker_select',
						'options'   => array(
							array(
								'name'  => '#cdb854',
								'color' => '#cdb854',
							),
							array(
								'name'  => '#60695b',
								'color' => '#60695b',
							),
							array(
								'name'  => '#da532e',
								'color' => '#da532e',
							),
							array(
								'name'  => '#79001f',
								'color' => '#79001f',
							),
							array(
								'name'  => '#1484c0',
								'color' => '#1484c0',
							),
							array(
								'name'  => '#07366a',
								'color' => '#07366a',
							),
							array(
								'name'  => '#a78d5f',
								'color' => '#a78d5f',
							),
							array(
								'name'  => '#333333',
								'color' => '#333333',
							),
							array(
								'name'  => '#110912',
								'color' => '#110912',
							),
							array(
								'name'  => '#7d4199',
								'color' => '#7d4199',
							),
							array(
								'name'  => '#53085d',
								'color' => '#53085d',
							),
						),
						'std'       => '#333333',
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Hours of Operation - 'hours_of_operation'.
					array(
						'name'      => 'Test Hours of Operation 4',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_hoursofoperation4_g3',
						'type'      => 'hours_of_operation',
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Select Post Type - 'select_post_type'.
					array(
						'name'      => 'Test Select Post Type 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_select_post_type1_g3',
						'type'      => 'select_post_type',
						'post-type' => 'cpt_kitten',
						'desc_type' => 'block',
					),

					// Multicheck Post Type - 'multicheck_post_type'.
					array(
						'name'      => 'Test Multicheck Post Type 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_multicheck_post_type1_g3',
						'type'      => 'multicheck_post_type',
						'post-type' => 'cpt_kitten',
						'desc_type' => 'block',
					),

					// Taxonomy Radio - 'taxonomy_radio'.
					array(
						'name'     => 'Test Taxonomy Radio 1',
						'desc'     => 'Description Goes Here',
						'id'       => $prefix . 'text_taxonomy_radio1_g3',
						'type'     => 'taxonomy_radio',
						'taxonomy' => 'category',
					),

					// Taxonomy Select - 'taxonomy_select'.
					array(
						'name'      => 'Test Taxonomy Select 1',
						'desc'      => 'Description Goes Here',
						'id'        => $prefix . 'text_taxonomy_select1_g3',
						'type'      => 'taxonomy_select',
						'taxonomy'  => 'category',
						'desc_type' => 'block',
					),

					// Taxonomy Select - 'taxonomy_select'.
					array(
						'name'      => 'Test Taxonomy Select 1',
						'desc'      => 'Description Goes Here',
						'id'        => $prefix . 'text_taxonomy_select1_g3',
						'type'      => 'taxonomy_select',
						'taxonomy'  => 'category',
						'desc_type' => 'block',
					),
				),
			),
			array(
				'name'   => 'Group 3',
				'desc'   => 'description for group 3',
				'id'     => $prefix . 'group2_3',
				'type'   => 'group',
				'fields' => array(

					// Message, to display messages only - 'message'.
					array(
						'desc' => 'This field is simply a message. Nothing more.',
						'type' => 'message',
						'id'   => $prefix . 'message_test_g3',
					),

					// Title, to display titles only - 'title'.
					array(
						'name' => 'Test Title Weeeee',
						'desc' => 'This field is simply a title. Nothing more.',
						'id'   => $prefix . 'test_title_g3',
						'type' => 'title',
					),

					// Text - 'text'.
					array(
						'name'      => 'Test Text 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_text1_g3',
						'type'      => 'text',
						'repeating' => false,
						'desc_type' => 'block',
						'std'       => 'test text 1 std',
					),

					// Text Medium - 'text_medium'.
					array(
						'name'      => 'Test Text Medium 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_textmedium1_g3',
						'type'      => 'text_medium',
						'repeating' => false, // Ability to add and sort repeating fields.
					),

					// Text Small - 'text_small'.
					array(
						'name'      => 'Test Text Small 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_textsmall_g3',
						'type'      => 'text_small',
						'repeating' => false,
						'desc_type' => 'block',
						'std'       => 'default text value, test text small 1',
					),

					// Textarea - 'textarea'.
					array(
						'name'      => 'Test Text Area 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_textarea1_g3',
						'type'      => 'textarea',
						'repeating' => false,
					),

					// Textarea Small - 'textarea_small'.
					array(
						'name'      => 'Test Text Area Small 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_textareasmall1_g3',
						'type'      => 'textarea_small',
						'repeating' => false,
					),

					// WYSIWYG - 'wysiwyg'.
					array(
						'name'      => 'Test wysiwyg 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_wysiwyg1_g3',
						'type'      => 'wysiwyg',
						'options'   => array( 'textarea_rows' => 5 ),
						'desc_type' => 'block',
					),

					// Text Desc-Value - 'text_desc_value'.
					array(
						'name'      => 'Test Text Description/Value 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_desc_value1_g3',
						'type'      => 'text_desc_value',
						'classes'   => array( array( 'yks_txt_small' ), array( 'yks_txt_medium' ) ),
						'repeating' => false, // Ability to add and sort repeating fields.
					),

					// Textarea Desc/Value - 'textarea_desc_value'.
					array(
						'name'      => 'Test Text Area Desc/Value 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_textarea_desc_value1_g3',
						'type'      => 'textarea_desc_value',
						'repeating' => false,
					),

					// Questions - 'questions'.
					array(
						'name'      => 'Test Questions 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_questions1_g3',
						'type'      => 'questions',
						'repeating' => false,
						'desc_type' => 'block',
					),

					// Text Three Fields - 'text_three_fields'.
					array(
						'name'      => 'Three Text Fields 1',
						'desc'      => 'Three text fields.',
						'id'        => $prefix . 'three_text_fields1_g3',
						'type'      => 'text_three_fields',
						'classes'   => array( array( 'yks_txt_small' ), array( 'yks_txt_small' ), array( 'yks_txt_small' ) ),
						'repeating' => false,
					),

					// Text URL - 'text_url'.
					array(
						'name'      => 'Text URL 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_texturl1_g3',
						'type'      => 'text_url',
						'repeating' => false,
					),

					// URL Desc/Value - 'text_url_desc_value'.
					array(
						'name'      => 'Test URL Desc/Val 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'text_urldescval_g3',
						'type'      => 'text_url_desc_value',
						'desc_type' => 'block',
					),

					// Link Picker - 'link_picker'.
					array(
						'name'       => 'Test Link Picker 1',
						'desc'       => 'field description (optional)',
						'id'         => $prefix . 'test_link_picker1_g3',
						'type'       => 'link_picker',
						'post-types' => array( 'any' ), // Always use an array, use array( 'any' ) for all post types.
						'repeating'  => false,
						'desc_type'  => 'block',
					),
					array(
						'name'      => 'Test Link Picker 2',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_link_picker2_g3',
						'type'      => 'link_picker',
						'repeating' => false,
						'desc_type' => 'block',
					),

					// Menu Picker - 'select_menu'.
					array(
						'name'      => 'Test Select Menu 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_select_menu1_g3',
						'type'      => 'select_menu',
						'desc_type' => 'block',
					),

					// Email - 'text_email'.
					array(
						'name'      => 'Test Email',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'text_email_g3',
						'type'      => 'text_email',
						'desc_type' => 'block',
					),

					// Money - 'text_money'.
					array(
						'name'      => 'Test Money 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_textmoney1_g3',
						'type'      => 'text_money',
						'repeating' => false,
					),

					// Text Number - 'text_number'.
					array(
						'name'      => 'Test Number 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_text_number1_g3',
						'type'      => 'text_number',
						'repeating' => false,
					),

					// Area Code - 'textarea_code'.
					array(
						'name'      => 'Test Area Code 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_textarea_code1_g3',
						'type'      => 'textarea_code',
						'repeating' => false,
					),

					// Text Phone Number - 'text_phone_number'.
					array(
						'name'      => 'phone 1',
						'desc'      => 'Phone ###',
						'id'        => $prefix . 'phone_number1_g3',
						'type'      => 'text_phone_number',
						'repeating' => false,
					),

					// Zip Code 'zip_code'.
					array(
						'name'      => 'Zip Code 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_zipcode1_g3',
						'type'      => 'zip_code',
						'repeating' => false,
					),

					// Zip Code US 'zip_code_us'.
					array(
						'name'      => 'Zip Code US 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_zipcode_us1_g3',
						'type'      => 'zip_code_us',
						'repeating' => false,
					),

					// Text Time 'text_time'.
					array(
						'name'      => 'Test Time 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_time1_g3',
						'type'      => 'text_time',
						'repeating' => false,
					),

					// Text Time Formatted 'text_time_formatted'.
					array(
						'name'      => 'Test Time Picker Dropdowns 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'text_time_formatted1_g3',
						'type'      => 'text_time_formatted',
						'repeating' => false,
					),

					// End Text Time Formatted - 'end_text_time_formatted'.
					array(
						'name'      => 'Test End Text Time Formatted 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'end_text_time_formatted1_g3',
						'type'      => 'end_text_time_formatted',
						'repeating' => false,
						'desc_type' => 'block',
					),

					// Text Date - 'text_date'.
					array(
						'name'      => 'Test Date Picker 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_textdate1_g3',
						'type'      => 'text_date',
						'repeating' => false,
					),

					// Text Date Year - 'text_date_year'.
					array(
						'name'      => 'Test Text Date Year 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'text_date_year1_g3',
						'type'      => 'text_date_year',
						'repeating' => false,
						'desc_type' => 'block',
					),

					// Text Date TimeStamp - 'text_date_timestamp'.
					array(
						'name'      => 'Test Date Picker (UNIX timestamp) 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_date_timestamp1_g3',
						'type'      => 'text_date_timestamp',
						'repeating' => false,
						'desc_type' => 'block',
					),

					// Text Date MySQL - 'text_date_mysql'.
					array(
						'name'      => 'Test Date Picker (MySQL date stamp) 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_date_mysql1_g3',
						'type'      => 'text_date_mysql',
						'repeating' => false,
						'desc_type' => 'block',
					),

					// Text DateTime Timestamp - 'text_datetime_timestamp'.
					array(
						'name'      => 'Test Date/Time Picker Combo (UNIX timestamp) 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_datetime_timestamp1_g3',
						'type'      => 'text_datetime_timestamp',
						'repeating' => false,
						'desc_type' => 'block',
					),

					// Text DateTime MySql - 'text_datetime_mysql'.
					array(
						'name'      => 'Test Date & Time Picker (MySQL date stamp) 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_datetime_mysql1_g3',
						'type'      => 'text_datetime_mysql',
						'repeating' => false,
						'desc_type' => 'block',
					),

					// Address - 'address'.
					array(
						'name'      => 'Test Address 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_address1_g3',
						'type'      => 'address',
						'repeating' => false,
						'desc_type' => 'block',
					),

					// Select State/Providence - 'select_state_providence'.
					array(
						'name'      => 'Test Select State/Providence 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_select_state_providence1_g3',
						'type'      => 'select_state_providence',
						'repeating' => false,
						'desc_type' => 'block',
					),

					// Select Country - 'select_country'.
					array(
						'name'      => 'Test Country 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_select_country1_g3',
						'type'      => 'select_country',
						'repeating' => false,
						'desc_type' => 'block',
					),

					// Select - 'select'.
					array(
						'name'      => 'Test Select 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_select1_g3',
						'type'      => 'select',
						'options'   => array(
							array(
								'name'  => 'Option One',
								'value' => 'standard',
							),
							array(
								'name'  => 'Option Two',
								'value' => 'custom',
							),
							array(
								'name'  => 'Option Three',
								'value' => 'none',
							),
						),
						'repeating' => true,
						'desc_type' => 'block',
					),

					// Radio - 'radio'.
					array(
						'name'            => 'Test Radio 1',
						'desc'            => 'field description (optional)',
						'id'              => $prefix . 'test_radio1_g3',
						'type'            => 'radio',
						'options'         => array(
							array(
								'name'  => 'Option One',
								'value' => 'standard',
							),
							array(
								'name'  => 'Option Two',
								'value' => 'custom',
							),
							array(
								'name'  => 'Option Three',
								'value' => 'none',
							),
						),
						'repeating'       => true,
						'desc_type'       => 'block',
						'repeat_btn_text' => 'Another one',
					),

					// Radio Inline - 'radio_inline'.
					array(
						'name'      => 'Test Radio inline 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_radio_inline1_g3',
						'type'      => 'radio_inline',
						'options'   => array(
							array(
								'name'  => 'Option One',
								'value' => 'standard',
							),
							array(
								'name'  => 'Option Two',
								'value' => 'custom',
							),
							array(
								'name'  => 'Option Three',
								'value' => 'none',
							),
						),
						'repeating' => false,
						'desc_type' => 'block',
					),

					// Checkbox - 'checkbox'.
					array(
						'name'      => 'Test Checkbox 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_checkbox1_g3',
						'value'     => '1', // place value you want to return.
						'type'      => 'checkbox',
						'repeating' => false,
						'desc_type' => 'block',
					),

					// MultiCheck - 'multicheck'.
					array(
						'name'      => 'Test Multi Checkbox 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_multicheckbox1_g3',
						'type'      => 'multicheck',
						'options'   => array(
							'check1' => 'Check One',
							'check2' => 'Check Two',
							'check3' => 'Check Three - A long checkbox name!! ++ hi',
						),
						'repeating' => false,
						'desc_type' => 'block',
					),

					// Youtube - 'youtube'.
					array(
						'name'      => 'YouTube 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'youtube1_g3',
						'type'      => 'youtube',
						'repeating' => false,
					),

					// oEmbed - 'oembed'.
					array(
						'name'      => 'oEmbed 1',
						'desc'      => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
						'id'        => $prefix . 'test_embed1_g3',
						'type'      => 'oembed',
						'repeating' => false,
						'desc_type' => 'block',
					),

					// File - 'file'.
					array(
						'name'      => 'Test File 1',
						'desc'      => 'Upload an image or enter an URL.',
						'id'        => $prefix . 'test_file1_g3',
						'type'      => 'file',
						'view'      => 'url',
						'repeating' => false,
						'desc_type' => 'block',
					),

					// Colorpicker - 'colorpicker'.
					array(
						'name'      => 'Test Color Picker 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_colorpicker1_g3',
						'type'      => 'colorpicker',
						'std'       => '#ffffff',
						'repeating' => false,
						'desc_type' => 'inline',
					),

					// Colorpicker Select 'colorpicker_select'.
					array(
						'name'      => 'Test Color Picker 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_colorpicker_select1_g3',
						'type'      => 'colorpicker_select',
						'options'   => array(
							array(
								'name'  => '#cdb854',
								'color' => '#cdb854',
							),
							array(
								'name'  => '#60695b',
								'color' => '#60695b',
							),
							array(
								'name'  => '#da532e',
								'color' => '#da532e',
							),
							array(
								'name'  => '#79001f',
								'color' => '#79001f',
							),
							array(
								'name'  => '#1484c0',
								'color' => '#1484c0',
							),
							array(
								'name'  => '#07366a',
								'color' => '#07366a',
							),
							array(
								'name'  => '#a78d5f',
								'color' => '#a78d5f',
							),
							array(
								'name'  => '#333333',
								'color' => '#333333',
							),
							array(
								'name'  => '#110912',
								'color' => '#110912',
							),
							array(
								'name'  => '#7d4199',
								'color' => '#7d4199',
							),
							array(
								'name'  => '#53085d',
								'color' => '#53085d',
							),
						),
						'std'       => '#333333',
						'repeating' => false,
						'desc_type' => 'block',
					),

					// Hours of Operation - 'hours_of_operation'.
					array(
						'name'      => 'Test Hours of Operation 4',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_hoursofoperation4_g3',
						'type'      => 'hours_of_operation',
						'repeating' => false,
						'desc_type' => 'block',
					),

					// Select Post Type - 'select_post_type'.
					array(
						'name'      => 'Test Select Post Type 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_select_post_type1_g3',
						'type'      => 'select_post_type',
						'post-type' => 'cpt_kitten',
						'desc_type' => 'block',
					),

					// Multicheck Post Type - 'multicheck_post_type'.
					array(
						'name'      => 'Test Multicheck Post Type 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_multicheck_post_type1_g3',
						'type'      => 'multicheck_post_type',
						'post-type' => 'cpt_kitten',
						'desc_type' => 'block',
					),

					// Taxonomy Radio - 'taxonomy_radio'.
					array(
						'name'     => 'Test Taxonomy Radio 1',
						'desc'     => 'Description Goes Here',
						'id'       => $prefix . 'text_taxonomy_radio1_g3',
						'type'     => 'taxonomy_radio',
						'taxonomy' => 'category',
					),

					// Taxonomy Select - 'taxonomy_select'.
					array(
						'name'      => 'Test Taxonomy Select 1',
						'desc'      => 'Description Goes Here',
						'id'        => $prefix . 'text_taxonomy_select1_g3',
						'type'      => 'taxonomy_select',
						'taxonomy'  => 'category',
						'desc_type' => 'block',
					),

					// Taxonomy MultiCheck - 'taxonomy_multicheck'.
					array(
						'name'      => 'Test Taxonomy Multi Checkbox 1',
						'desc'      => 'field description (optional)',
						'id'        => $prefix . 'test_multitaxonomy1_g3',
						'type'      => 'taxonomy_multicheck',
						'taxonomy'  => 'category',
						'desc_type' => 'block',
					),
				),
			),
		),
	);

	// A third metabox.
	$mboxs[] = array(
		'id'         => 'cpt_kitten2_metabox',
		'title'      => 'More Kitten Details',
		'pages'      => array( 'cpt_kitten' ), // Post type.
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left.
		'fields'     => array(
			array(
				'name' => 'Test Text',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_text_box_2_101',
				'type' => 'text',
			),
		),
	);

	// Add other metaboxes as needed using "$meta_boxes[]....".
	return $mboxs;
}

/** END Function to create and register custom fields for custom post type **/


/** BEGIN Filter to change the default "Enter title here" Text */

/**
 * Title Placeholder.
 *
 * @param array $title Change the default title placeholder text.
 */
function change_title_for_cpt_kitten( $title ) {
	$screen = get_current_screen();

	if ( 'cpt_kitten' === $screen->post_type ) {
		$title = 'Enter Kitten Name';
	}

	return $title;
}

add_filter( 'enter_title_here', 'change_title_for_cpt_kitten' );

/** END Filter to change the default "Enter title here" Text */
