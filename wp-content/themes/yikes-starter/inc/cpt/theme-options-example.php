<?php
/**
 * Theme Options
 *
 * @package YIKES Starter
 */

add_filter( 'yks_option_pages', 'yks_page_options' );

/**
 * Create our Theme options page.
 *
 * @param array $option_pages Set the options for our page in the WordPress Admin.
 */
function yks_page_options( array $option_pages ) {
	$option_pages[] = array(
		'id'         => 'page_yks_page_options',
		'menu_title' => 'Theme Options',
		'page_title' => 'Manage Theme Options',
		'type'       => 'theme',  // options are  'plugin' as plugin page, 'theme' as theme option page, 'settings' as general settings page.
		'icon'       => 'dashicons-smiley',
		'position'   => '3',
	);

	return $option_pages;
}

// Metaboxes.
add_filter( 'yks_mbox_fields', 'yks_mbox_page_options' );

/**
 * Create our meta boxes.
 *
 * @param array $poboxs Set our metaboxes for our theme options page.
 */
function yks_mbox_page_options( array $poboxs ) {
	// prefix for all custom fields.
	$prefix = 'yks_';

	// First metabox.
	$poboxs[] = array(
		'id'         => 'page_options_metabox_1',
		'title'      => 'Theme Options Metabox',
		'page'       => 'page_yks_page_options',
		'context'    => 'normal',  // normal or side.  advanced not supported.
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
				'column'          => false, // Set to 'true' to enable columns for this field. Note if repeating fields is enabled this will not work as it's not supported.
				'sortable_column' => '', // Set to true to make columns sortable.
				'column_orderby'  => '', // Only for sortable columns. Default is by this field's meta value 'meta_value_num'. However, you can set to following options 'title', 'meta_value', 'author', 'id', 'date', 'modified', and 'rand'.
				'repeat_btn_text' => 'Another one',
			),

			// Text Medium - 'text_medium'.
			array(
				'name'            => 'Test Text Medium 1',
				'desc'            => 'field description (optional)',
				'id'              => $prefix . 'test_textmedium1',
				'type'            => 'text_medium',
				'repeating'       => false, // Ability to add and sort repeating fields.
				'column'          => false, // Set to 'true' to enable columns for this field. Note if repeating fields is enabled this will not work as it's not supported.
				'sortable_column' => '', // Set to true to make columns sortable.
				'column_orderby'  => '', // Only for sortable columns. Default is by this field's meta value 'meta_value_num'. However, you can set to following options 'title', 'meta_value', 'author', 'id', 'date', 'modified', and 'rand'.
				'repeat_btn_text' => 'Another one',
			),

			// Text Small - 'text_small'.
			array(
				'name'            => 'Test Text Small 1',
				'desc'            => 'field description (optional)',
				'id'              => $prefix . 'test_textsmall',
				'type'            => 'text_small',
				'repeating'       => false,
				'desc_type'       => 'block',
				'std'             => 'default text value, test text small 1',
				'column'          => false, // Set to 'true' to enable columns for this field. Note if repeating fields is enabled this will not work as it's not supported.
				'sortable_column' => '', // Set to true to make columns sortable.
				'column_orderby'  => '', // Only for sortable columns. Default is by this field's meta value 'meta_value_num'. However, you can set to following options 'title', 'meta_value', 'author', 'id', 'date', 'modified', and 'rand'.
				'repeat_btn_text' => 'Another one',
			),

			// Textarea - 'textarea'.
			array(
				'name'            => 'Test Text Area 1',
				'desc'            => 'field description (optional)',
				'id'              => $prefix . 'test_textarea1',
				'type'            => 'textarea',
				'repeating'       => false,
				'repeat_btn_text' => 'Another one',
			),

			// Textarea Small - 'textarea_small'.
			array(
				'name'            => 'Test Text Area Small 1',
				'desc'            => 'field description (optional)',
				'id'              => $prefix . 'test_textareasmall1',
				'type'            => 'textarea_small',
				'repeating'       => false,
				'repeat_btn_text' => 'Another one',
			),

			// Textarea Code - 'textarea_code'.
			array(
				'name'            => 'Test Text Area (allows code)',
				'desc'            => 'field description (optional)',
				'id'              => $prefix . 'test_textarea_code1_g2',
				'type'            => 'textarea_code',
				'repeating'       => true,
				'repeat_btn_text' => 'Another one',
			),

			// WYSIWYG - 'wysiwyg'.
			array(
				'name'      => 'Test wysiwyg 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_wysiwyg1',
				'type'      => 'wysiwyg',
				'options'   => array( 'textarea_rows' => 5 ),
				'desc_type' => 'block',
			),

			// Text Desc-Value - 'text_desc_value'.
			array(
				'name'      => 'Test Text Description/Value 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_desc_value1',
				'type'      => 'text_desc_value',
				'classes'   => array( array( 'yks_txt_small' ), array( 'yks_txt_medium' ) ),
				'repeating' => false, // Ability to add and sort repeating fields.
			),

			// Textarea Desc/Value - 'textarea_desc_value'.
			array(
				'name'      => 'Test Text Area Desc/Value 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_textarea_desc_value1',
				'type'      => 'textarea_desc_value',
				'repeating' => false,
			),

			// Questions - 'questions'.
			array(
				'name'      => 'Test Questions 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_questions1',
				'type'      => 'questions',
				'repeating' => false,
				'desc_type' => 'block',
			),

			// Text Three Fields - 'text_three_fields'.
			array(
				'name'      => 'Three Text Fields 1',
				'desc'      => 'Three text fields.',
				'id'        => $prefix . 'three_text_fields1',
				'type'      => 'text_three_fields',
				'classes'   => array( array( 'yks_txt_small' ), array( 'yks_txt_small' ), array( 'yks_txt_small' ) ),
				'repeating' => false,
			),

			// Text URL - 'text_url'.
			array(
				'name'      => 'Text URL 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_texturl1',
				'type'      => 'text_url',
				'repeating' => false,
			),

			// URL Link Text/URL - 'text_url_desc_value'.
			array(
				'name'      => 'Test URL Link Text/URL 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'text_urldescval',
				'type'      => 'text_url_desc_value',
				'desc_type' => 'block',
			),

			// Link Picker - 'link_picker'.
			array(
				'name'       => 'Test Link Picker 1',
				'desc'       => 'field description (optional)',
				'id'         => $prefix . 'test_link_picker1',
				'type'       => 'link_picker',
				'post-types' => array( 'any' ), // Always use an array, use array( 'any' ) for all post types.
				'repeating'  => true,
				'desc_type'  => 'block',
			),
			array(
				'name'      => 'Test Link Picker 2',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_link_picker2',
				'type'      => 'link_picker',
				'repeating' => true,
				'desc_type' => 'block',
			),

			// Menu Picker - 'select_menu'.
			array(
				'name'      => 'Test Select Menu 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_select_menu1',
				'type'      => 'select_menu',
				'desc_type' => 'block',
			),

			// Email - 'text_email'.
			array(
				'name'            => 'Test Email',
				'desc'            => 'field description (optional)',
				'id'              => $prefix . 'text_email',
				'type'            => 'text_email',
				'desc_type'       => 'block',
				'column'          => false, // Set to 'true' to enable columns for this field. Note if repeating fields is enabled this will not work as it's not supported.
				'sortable_column' => '', // Set to true to make columns sortable.
				'column_orderby'  => '', // Only for sortable columns. Default is by this field's meta value 'meta_value_num'. However, you can set to following options 'title', 'meta_value', 'author', 'id', 'date', 'modified', and 'rand'.
			),

			// Money - 'text_money'.
			array(
				'name'      => 'Test Money 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_textmoney1',
				'type'      => 'text_money',
				'repeating' => false,
			),

			// Text Number - 'text_number'.
			array(
				'name'      => 'Test Number 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_text_number1',
				'type'      => 'text_number',
				'repeating' => false,
			),

			// Text Phone Number - 'text_phone_number'.
			array(
				'name'      => 'phone 1',
				'desc'      => 'Phone ###',
				'id'        => $prefix . 'phone_number1',
				'type'      => 'text_phone_number',
				'repeating' => false,
			),
			// Zip Code 'zip_code'.
			array(
				'name'      => 'Zip Code 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_zipcode1',
				'type'      => 'zip_code',
				'repeating' => false,
			),

			// Zip Code US 'zip_code_us'.
			array(
				'name'      => 'Zip Code US 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_zipcode_us1',
				'type'      => 'zip_code_us',
				'repeating' => false,
			),

			// Text Time 'text_time'.
			array(
				'name'            => 'Test Time 1',
				'desc'            => 'field description (optional)',
				'id'              => $prefix . 'test_time1',
				'type'            => 'text_time',
				'repeating'       => false,
				'column'          => false, // Set to 'true' to enable columns for this field. Note if repeating fields is enabled this will not work as it's not supported.
				'sortable_column' => '', // Set to true to make columns sortable.
				'column_orderby'  => '', // Only for sortable columns. Default is by this field's meta value 'meta_value_num'. However, you can set to following options 'title', 'meta_value', 'author', 'id', 'date', 'modified', and 'rand'.
			),
			// Text Time Formatted 'text_time_formatted'.
			array(
				'name'            => 'Test Time Picker Dropdowns 1',
				'desc'            => 'field description (optional)',
				'id'              => $prefix . 'text_time_formatted1',
				'type'            => 'text_time_formatted',
				'repeating'       => false,
				'column'          => false, // Set to 'true' to enable columns for this field. Note if repeating fields is enabled this will not work as it's not supported.
				'sortable_column' => '', // Set to true to make columns sortable.
				'column_orderby'  => '', // Only for sortable columns. Default is by this field's meta value 'meta_value_num'. However, you can set to following options 'title', 'meta_value', 'author', 'id', 'date', 'modified', and 'rand'.
			),

			// End Text Time Formatted - 'end_text_time_formatted'.
			array(
				'name'            => 'Test End Text Time Formatted 1',
				'desc'            => 'field description (optional)',
				'id'              => $prefix . 'end_text_time_formatted1',
				'type'            => 'end_text_time_formatted',
				'repeating'       => false,
				'desc_type'       => 'block',
				'column'          => false, // Set to 'true' to enable columns for this field. Note if repeating fields is enabled this will not work as it's not supported.
				'sortable_column' => '', // Set to true to make columns sortable.
				'column_orderby'  => '', // Only for sortable columns. Default is by this field's meta value 'meta_value_num'. However, you can set to following options 'title', 'meta_value', 'author', 'id', 'date', 'modified', and 'rand'.
			),

			// Text Date - 'text_date'.
			array(
				'name'            => 'Test Date Picker 1',
				'desc'            => 'field description (optional)',
				'id'              => $prefix . 'test_textdate1',
				'type'            => 'text_date',
				'repeating'       => false,
				'column'          => false, // Set to 'true' to enable columns for this field. Note if repeating fields is enabled this will not work as it's not supported.
				'sortable_column' => '', // Set to true to make columns sortable.
				'column_orderby'  => '', // Only for sortable columns. Default is by this field's meta value 'meta_value_num'. However, you can set to following options 'title', 'meta_value', 'author', 'id', 'date', 'modified', and 'rand'.
			),

			// Text Date Year - 'text_date_year'.
			array(
				'name'            => 'Test Text Date Year 1',
				'desc'            => 'field description (optional)',
				'id'              => $prefix . 'text_date_year1',
				'type'            => 'text_date_year',
				'repeating'       => false,
				'desc_type'       => 'block',
				'column'          => false, // Set to 'true' to enable columns for this field. Note if repeating fields is enabled this will not work as it's not supported.
				'sortable_column' => '', // Set to true to make columns sortable.
				'column_orderby'  => '', // Only for sortable columns. Default is by this field's meta value 'meta_value_num'. However, you can set to following options 'title', 'meta_value', 'author', 'id', 'date', 'modified', and 'rand'.

			),
			// Text Date TimeStamp - 'text_date_timestamp'.
			array(
				'name'            => 'Test Date Picker (UNIX timestamp) 1',
				'desc'            => 'field description (optional)',
				'id'              => $prefix . 'test_date_timestamp1',
				'type'            => 'text_date_timestamp',
				'repeating'       => false,
				'desc_type'       => 'block',
				'column'          => false, // Set to 'true' to enable columns for this field. Note if repeating fields is enabled this will not work as it's not supported.
				'sortable_column' => '', // Set to true to make columns sortable.
				'column_orderby'  => '', // Only for sortable columns. Default is by this field's meta value 'meta_value_num'. However, you can set to following options 'title', 'meta_value', 'author', 'id', 'date', 'modified', and 'rand'.

			),
			// Text Date MySQL - 'text_date_mysql'.
			array(
				'name'            => 'Test Date Picker (MySQL date stamp) 1',
				'desc'            => 'field description (optional)',
				'id'              => $prefix . 'test_date_mysql1',
				'type'            => 'text_date_mysql',
				'repeating'       => false,
				'desc_type'       => 'block',
				'column'          => false, // Set to 'true' to enable columns for this field. Note if repeating fields is enabled this will not work as it's not supported.
				'sortable_column' => '', // Set to true to make columns sortable.
				'column_orderby'  => '', // Only for sortable columns. Default is by this field's meta value 'meta_value_num'. However, you can set to following options 'title', 'meta_value', 'author', 'id', 'date', 'modified', and 'rand'.
			),

			// Text DateTime Timestamp - 'text_datetime_timestamp'.
			array(
				'name'            => 'Test Date/Time Picker Combo (UNIX timestamp) 1',
				'desc'            => 'field description (optional)',
				'id'              => $prefix . 'test_datetime_timestamp1',
				'type'            => 'text_datetime_timestamp',
				'repeating'       => false,
				'desc_type'       => 'block',
				'column'          => false, // Set to 'true' to enable columns for this field. Note if repeating fields is enabled this will not work as it's not supported.
				'sortable_column' => '', // Set to true to make columns sortable.
				'column_orderby'  => '', // Only for sortable columns. Default is by this field's meta value 'meta_value_num'. However, you can set to following options 'title', 'meta_value', 'author', 'id', 'date', 'modified', and 'rand'.
			),

			// Text DateTime MySql - 'text_datetime_mysql'.
			array(
				'name'      => 'Test Date & Time Picker (MySQL date stamp) 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_datetime_mysql1',
				'type'      => 'text_datetime_mysql',
				'repeating' => false,
				'desc_type' => 'block',
			),

			// Address - 'address'.
			array(
				'name'      => 'Test Address 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_address1',
				'type'      => 'address',
				'repeating' => false,
				'desc_type' => 'block',
			),

			// Select State/Providence - 'select_state_providence'.
			array(
				'name'      => 'Test Select State/Providence 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_select_state_providence1',
				'type'      => 'select_state_providence',
				'repeating' => false,
				'desc_type' => 'block',
			),

			// Select Country - 'select_country'.
			array(
				'name'      => 'Test Country 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_select_country1',
				'type'      => 'select_country',
				'repeating' => false,
				'desc_type' => 'block',
			),

			// Select - 'select'.
			array(
				'name'      => 'Test Select 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_select1',
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
				'repeating' => false,
				'desc_type' => 'block',
			),

			// Radio - 'radio'.
			array(
				'name'      => 'Test Radio 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_radio1',
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
				'repeating' => false,
				'desc_type' => 'block',
			),

			// Radio Inline - 'radio_inline'.
			array(
				'name'      => 'Test Radio inline 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_radio_inline1',
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
				'name'            => 'Test Checkbox 1',
				'desc'            => 'field description (optional)',
				'id'              => $prefix . 'test_checkbox1',
				'value'           => '1', // place value you want to return.
				'type'            => 'checkbox',
				'repeating'       => false,
				'desc_type'       => 'block',
				'column'          => false, // Set to 'true' to enable columns for this field. Note if repeating fields is enabled this will not work as it's not supported.
				'sortable_column' => '', // Set to true to make columns sortable.
				'column_orderby'  => '', // Only for sortable columns. Default is by this field's meta value 'meta_value_num'. However, you can set to following options 'title', 'meta_value', 'author', 'id', 'date', 'modified', and 'rand'.
			),

			// Star Field - 'star' (Really a checkbox) but with custom stuff for sortable columns.
			array(
				'name'            => 'Star Example 1',
				'id'              => $prefix . 'star1',
				'type'            => 'star',
				'value'           => '1', // Default value is '1'. However, you can set to alternate value.
				'column'          => true, // Set to 'true' to enable columns for this field. Note if repeating fields is enabled this will not work as it's not supported.
				'sortable_column' => true, // Set to true to make columns sortable.
				'column_orderby'  => 'title', // Only for sortable columns. Default is by this field's meta value 'meta_value_num'. However, you can set to following options 'title', 'meta_value', 'author', 'id', 'date', 'modified', and 'rand'.
				'dashicon'        => '', // For sortable columsn only. Default is 'dashicon-star'.
				'dashicon-color'  => '', // You can set different color for dashicon icon. Otherwise default WP colors.
				'repeating'       => false,
				'desc_type'       => 'block',
			),

			// MultiCheck - 'multicheck'.
			array(
				'name'      => 'Test Multi Checkbox 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_multicheckbox1',
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
				'id'        => $prefix . 'youtube1',
				'type'      => 'youtube',
				'repeating' => false,
			),

			// oEmbed - 'oembed'.
			array(
				'name'      => 'oEmbed 1',
				'desc'      => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
				'id'        => $prefix . 'test_embed1',
				'type'      => 'oembed',
				'repeating' => false,
				'desc_type' => 'block',
			),

			// File - 'file'.
			array(
				'name'      => 'Test File 1',
				'desc'      => 'Upload an image or enter an URL.',
				'id'        => $prefix . 'test_file1',
				'type'      => 'file',
				'view'      => 'url',
				'repeating' => false,
				'desc_type' => 'block',
			),

			// Colorpicker - 'colorpicker'.
			array(
				'name'      => 'Test Color Picker 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_colorpicker1',
				'type'      => 'colorpicker',
				'std'       => '#ffffff',
				'repeating' => false,
				'desc_type' => 'inline',
			),

			// Colorpicker Select 'colorpicker_select'.
			array(
				'name'      => 'Test Color Picker 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_colorpicker_select1',
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
				'id'        => $prefix . 'test_hoursofoperation4',
				'type'      => 'hours_of_operation',
				'repeating' => false,
				'desc_type' => 'block',
			),

			// Select Post Type - 'select_post_type'.
			array(
				'name'      => 'Test Select Post Type 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_select_post_type1',
				'type'      => 'select_post_type',
				'post-type' => 'cpt_cat',
				'desc_type' => 'block',
			),

			// Multicheck Post Type - 'multicheck_post_type'.
			array(
				'name'      => 'Test Multicheck Post Type 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_multicheck_post_type1',
				'type'      => 'multicheck_post_type',
				'post-type' => 'cpt_cat',
				'desc_type' => 'block',
			),

			// Taxonomy Radio - 'taxonomy_radio'.
			array(
				'name'     => 'Test Taxonomy Radio 1',
				'desc'     => 'Description Goes Here',
				'id'       => $prefix . 'text_taxonomy_radio1',
				'type'     => 'taxonomy_radio',
				'taxonomy' => 'category',
			),

			// Taxonomy Select - 'taxonomy_select'.
			array(
				'name'      => 'Test Taxonomy Select 1',
				'desc'      => 'Description Goes Here',
				'id'        => $prefix . 'text_taxonomy_select1',
				'type'      => 'taxonomy_select',
				'taxonomy'  => 'category',
				'desc_type' => 'block',
			),

			// Taxonomy MultiCheck - 'taxonomy_multicheck'.
			array(
				'name'      => 'Test Taxonomy Multi Checkbox 1',
				'desc'      => 'field description (optional)',
				'id'        => $prefix . 'test_multitaxonomy1',
				'type'      => 'taxonomy_multicheck',
				'taxonomy'  => 'category',
				'desc_type' => 'block',
			),
		),
	);

	// A second side metabox.
	$poboxs[] = array(
		'id'         => 'page_options_metabox_2',
		'title'      => 'Side Options',
		'page'       => 'page_yks_page_options',
		'context'    => 'side',  // normal or side.  advanced not supported.
		'priority'   => 'high',
		'show_names' => false, // Show field names on the left.
		'fields'     => array(
			// to display messages only.
			array(
				'desc' => 'This is text only field to display only in messages',
				'type' => 'message',
			),
			// simple text field for form.
			array(
				'name' => 'Test Text',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_text_a',
				'type' => 'text',
			),

			// drop down select field.
			array(
				'name'    => 'Test Select',
				'desc'    => 'field description (optional)',
				'id'      => $prefix . 'test_select_d',
				'type'    => 'select',
				'options' => array(
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
			),
		),
	);

	// A third side metabox.
	$poboxs[] = array(
		'id'         => 'page_options_metabox_3',
		'title'      => 'Side Options 2',
		'page'       => 'page_yks_page_options',
		'context'    => 'side',  // normal or side.  advanced not supported.
		'priority'   => 'high',
		'show_names' => false, // Show field names on the left.
		'fields'     => array(
			// to display messages only.
			array(
				'desc' => '2 This is text only field to display only in messages',
				'type' => 'message',
			),
			// simple text field for form.
			array(
				'name' => 'Test Text 2',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_text_a_1',
				'type' => 'text',
			),

			// drop down select field.
			array(
				'name'    => 'Test Select 2',
				'desc'    => 'field description (optional)',
				'id'      => $prefix . 'test_select_d_1',
				'type'    => 'select',
				'options' => array(
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
			),
		),
	);

	// A fourth metabox.
	$poboxs[] = array(
		'id'         => 'page_options_metabox_4',
		'title'      => 'Bottom Options',
		'page'       => 'page_yks_page_options',
		'context'    => 'normal',  // normal or side.  advanced not supported.
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left.
		'fields'     => array(
			// to display messages only.
			array(
				'desc' => '2 This is text only field to display only in messages',
				'type' => 'message',
			),
			// simple text field for form.
			array(
				'name' => 'Test Text 2',
				'desc' => 'field description (optional)',
				'id'   => $prefix . 'test_text_a_1a',
				'type' => 'text',
			),

			// drop down select field.
			array(
				'name'    => 'Test Select 2',
				'desc'    => 'field description (optional)',
				'id'      => $prefix . 'test_select_d_1a',
				'type'    => 'select',
				'options' => array(
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
			),
		),
	);

	return $poboxs;

}
