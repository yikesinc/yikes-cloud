<?php
/**
 * Woo Commerce functions and definitions
 *
 * @package YIKES Starter
 */

// WooCommerce support.
add_action( 'after_setup_theme', 'woocommerce_support' );

/**
 * Declare WooCommerce support
 * - Adds theme support for WooCommerce
 */
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}


// WooCommerce Loop Product Thumbs.
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );


if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
	/**
	 * WooCommerce Loop Product Thumbs
	 * - Custom product thumbnail markup
	 */
	function woocommerce_template_loop_product_thumbnail() {
		echo esc_url( woocommerce_get_product_thumbnail() );
	}
}


if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {

	/**
	 * WooCommerce Product Thumbnail Wrap
	 *
	 * @param array $size Thumbnail size.
	 * @param array $placeholder_width Thumbnail width.
	 * @param array $placeholder_height Thumbnail height.
	 */
	function woocommerce_get_product_thumbnail(
		$size = 'shop_catalog',
		$placeholder_width = 0,
		$placeholder_height = 0
	) {
		global $post, $woocommerce;

		if ( ! $placeholder_width ) {
			$placeholder_width = wc_get_image_size( 'shop_catalog_image_width' );
		}
		if ( ! $placeholder_height ) {
			$placeholder_height = wc_get_image_size( 'shop_catalog_image_height' );
		}

			$output = '<div class="product-image-wrapper">';
		if ( has_post_thumbnail() ) {
			$output .= get_the_post_thumbnail( $post->ID, $size );
		} else {
			$output .= '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';
		}
		$output .= '</div>';
		return $output;
	}
}

/**
 * WooCommerce Breadcrumbs
 */

add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
/**
 * Change the home link to a different URL.
 */
function woo_custom_breadrumb_home_url() {
	return '/shop/';
}

add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_home_text' );
/**
 * Change the ‘Home’ text.
 *
 * @param array $defaults Text for home breadcrumb.
 */
function jk_change_breadcrumb_home_text( $defaults ) {
	// Change the breadcrumb home text from 'Home' to 'Shop Home'.
	$defaults['home'] = 'Shop Home';
	return $defaults;
}


/**
 * Add new register fields for WooCommerce registration.
 * - Adds new First Name, Last Name, Phone and Customer Number fields to the registration form.
 *
 * @return string Register fields HTML.
 */
function wooc_extra_register_fields() {
	?>

	<p class="form-row form-row-first">
		<label for="reg_billing_first_name"><?php _e( 'First name', 'yikes_starter' ); ?> <span class="required">*</span></label>
		<input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) {
			esc_attr_e( $_POST['billing_first_name'] );} ?>" />
	</p>

	<p class="form-row form-row-last">
		<label for="reg_billing_last_name"><?php _e( 'Last name', 'yikes_starter' ); ?> <span class="required">*</span></label>
		<input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) { esc_attr_e( $_POST['billing_last_name'] );} ?>" />
	</p>

	<div class="clear"></div>

	<p class="form-row form-row-wide">
		<label for="reg_billing_phone"><?php _e( 'Phone', 'yikes_starter' ); ?> <span class="required">*</span></label>
		<input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) { esc_attr_e( $_POST['billing_phone'] );} ?>" />
	</p>

	<div class="clear"></div>

	<p class="form-row form-row-wide">
		<label for="customer_number"><?php _e( 'Customer Number', 'yikes_starter' ); ?> <span class="description">(optional)</span></label>
		<input type="text" class="input-text" name="customer_number" id="customer_number" value="<?php if ( ! empty( $_POST['customer_number'] ) ) { esc_attr_e( $_POST['customer_number'] );} ?>" />
		<div class="customer-number-text">
		Your customer # appears on the top line of your catalog address label. If you qualify for special teacher pricing we will make your account a teacher account within 2 business days.
	</div>
	</p>

	<?php
}

add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );


/**
 * Validate the extra register fields.
 * - Validate the inputs during registration process
 *
 * @param string $username Current username.
 * @param string $email Current email.
 * @param object $validation_errors WP_Error object.
 *
 * @return void
 */
function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
	if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
		$validation_errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'yikes_starter' ) );
	}

	if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
		$validation_errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'yikes_starter' ) );
	}

	if ( isset( $_POST['billing_phone'] ) && empty( $_POST['billing_phone'] ) ) {
		$validation_errors->add( 'billing_phone_error', __( '<strong>Error</strong>: Phone is required!.', 'yikes_starter' ) );
	}
}

add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );

/**
 * Save the extra register fields.
 * - Save the extra fields during new user registration
 *
 * @param int $customer_id Current customer ID.
 *
 * @return void
 */
function wooc_save_extra_register_fields( $customer_id ) {
	if ( isset( $_POST['billing_first_name'] ) ) {
		// WordPress default first name field.
		update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );

		// WooCommerce billing first name.
		update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
	}

	if ( isset( $_POST['billing_last_name'] ) ) {
		// WordPress default last name field.
		update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );

		// WooCommerce billing last name.
		update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
	}

	if ( isset( $_POST['billing_phone'] ) ) {
		// WooCommerce billing phone.
		update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
	}

	if ( isset( $_POST['customer_number'] ) ) {
		// WooCommerce customer number.
		update_user_meta( $customer_id, 'customer_number', sanitize_text_field( $_POST['customer_number'] ) );
	}
}

add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );


/**
 * Redirect the user back to the passed in referrer page (after login)
 * - Which should be the URL to the last viewed product before logging in
 */
function custom_woocommerce_login_redirect_back_to_product_page( $redirect, $user ) {
	if ( isset( $_POST['redirect-user'] ) ) {
		$redirect = esc_url( $_POST['redirect-user'] );
	}
	return $redirect;
}
add_filter( 'woocommerce_login_redirect', 'custom_woocommerce_login_redirect_back_to_product_page' );


/**
 * Add custom fields to the checkout
 * - Adds a 'Required Delivery Date' field during the checkout.
 */
add_action( 'woocommerce_checkout_fields', 'additional_info_checkout_fields' );

function additional_info_checkout_fields( $fields ) {

	$fields['billing']['order_comments'] = array(
		'type'        => 'textarea',
		'class'       => array( 'my-field-class orm-row-wide' ),
		'label'       => __( 'Order Notes' ),
		'placeholder' => __( 'Notes about your order, e.g. special notes for delivery.' ),
	);

	$fields['billing']['required_delivery_by_date'] = array(
		'type'        => 'text',
		'class'       => array( 'my-field-class orm-row-wide' ),
		'label'       => __( 'Required Delivery by Date <abbr class="required" title="required">*</abbr>' ),
		'placeholder' => __( 'Select the date you need this order in hand by.' ),
	);

	return $fields;

}

/**
 * Display field value on the order edit page
 * - Display 'Order Comments' field on the admin order page
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'additional_info_checkout_field_display_admin_order_meta', 10, 1 );
function additional_info_checkout_field_display_admin_order_meta( $order ) {
	echo '<p><strong>' . __( 'Required Delivery By' ) . ':</strong> ' . date( 'F jS, Y', strtotime( get_post_meta( $order->get_id(), 'required_delivery_by_date', true ) ) ) . '</p>';
	if ( get_post_meta( $order->get_id(), '_billing_order_comments', true ) ) {
		echo '<p><strong>' . __( 'Order Comments' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_billing_order_comments', true ) . '</p>';
	}
}


/**
 * Add our custom js scripts to the footer to init datepicker and stuff
 * - Enqueues custom scripts on the checkout page (using is_checkout() conditional)
 */
add_action( 'wp_footer', 'custom_date_picker_init' );
function custom_date_picker_init() {
	if ( is_checkout() ) {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-datepicker' );

		wp_enqueue_style(
			'jquery-datepicker-admin-ui-css',
			'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/smoothness/jquery-ui.css',
			false,
			'1.0',
			false,
		);
		wp_enqueue_style( 'datepicker-styles', get_stylesheet_directory_uri() . '/inc/css/datepicker-styles/datepicker.css', array( 'jquery-datepicker-admin-ui-css' ), 'all' );
		/**
		 * Optional Javascript to limit the field to a country. This one shows for italy only.
		 */
		?>
		<script type="text/javascript">
			jQuery( document ).ready( function() {
				jQuery( "#required_delivery_by_date" ).datepicker().attr( 'required', 'required' ).attr( 'autocomplete', 'off' );
			});
		</script>
		<?php
	}
}
/**
 * During WooCommerce checkout process, check if the 'Delivery Required by Date' is empty and display an error.
 */
add_action( 'woocommerce_checkout_process', 'additional_info_checkout_fields_process' );
function additional_info_checkout_fields_process() {

	// Check if set, if its not set add an error. This one is only requite for companies.
	if ( isset( $_POST['billing_company'] ) ) :
		if ( ! isset( $_POST['required_delivery_by_date'] ) || isset( $_POST['required_delivery_by_date'] ) && empty( $_POST['required_delivery_by_date'] ) ) :
			if ( function_exists( 'wc_add_notice' ) ) :
				wc_add_notice( __( 'Please enter the date that you need your order delivered by.' ), 'error' );
			endif;
		endif;
	endif;
}
/**
 * Update the order meta with field value
 * - Update our 'Delivery Required by Date' field with our value.
 */
add_action( 'woocommerce_checkout_update_order_meta', 'additional_info_checkout_fields_update_order_meta' );
function additional_info_checkout_fields_update_order_meta( $order_id ) {
	if ( $_POST['order_comments'] ) {
		$order = array(
			'ID'           => $order_id,
			'post_excerpt' => esc_attr( $_POST['order_comments'] ),
		);
		wp_update_post( $order );
	}
	if ( $_POST['required_delivery_by_date'] ) {
		update_post_meta(
			$order_id,
			'required_delivery_by_date',
			esc_attr( $_POST['required_delivery_by_date'] ) 
		);
	}
}

/**
 * Add the field to order emails
 * - Add our additional fields to the 'New Order' email that is sent
 */
add_filter( 'woocommerce_email_order_meta_keys', 'additional_info_checkout_fields_order_meta_keys' );
function additional_info_checkout_fields_order_meta_keys( $keys ) {
	$keys[] = 'Special Notes';
	$keys[] = 'Required Delivery by Date';
	return $keys;
}

/**
 * Add search by sku ability
 * Resource: Search by SKU for WooCommerce (plugin)
 * From: http://plugins.svn.wordpress.org/search-by-sku-for-woocommerce/tags/0.6.1/wc-searchbysku-widget-compat.php
 *  - A drop in replacement of WC_Admin_Post_Types::product_search()
 *  - This essentially allows users to search for products by entered SKU.
 */
add_filter( 'posts_search', 'product_search_sku', 9 );
function product_search_sku( $where ) {
		global $pagenow, $wpdb, $wp;
		// VAR_DUMP(http_build_query(array('post_type' => array('product','boobs'))));die();
		$type = array( 'product', 'jam' );
		// var_dump(in_array('product', $wp->query_vars['post_type']));
	if ( (is_admin() && 'edit.php' !== $pagenow)
		|| ! is_search()
		|| ! isset( $wp->query_vars['s'] )
		// post_types can also be arrays.
		|| ( isset( $wp->query_vars['post_type'] ) && 'product' !== $wp->query_vars['post_type'] )
		|| ( isset( $wp->query_vars['post_type'] ) && is_array( $wp->query_vars['post_type'] ) && ! in_array( 'product', $wp->query_vars['post_type'] ) )
		) {
		return $where;
	}
		$search_ids = array();
		$terms      = explode( ',', $wp->query_vars['s'] );

	foreach ( $terms as $term ) {
		// Include the search by id if admin area.
		if ( is_admin() && is_numeric( $term ) ) {
			$search_ids[] = $term;
		}
		// search for variations with a matching sku and return the parent.
		$sku_to_parent_id = $wpdb->get_col( $wpdb->prepare( "SELECT p.post_parent as post_id FROM {$wpdb->posts} as p join {$wpdb->postmeta} pm on p.ID = pm.post_id and pm.meta_key='_sku' and pm.meta_value LIKE '%%%s%%' where p.post_parent <> 0 group by p.post_parent", wc_clean( $term ) ) );

		// Search for a regular product that matches the sku.
		$sku_to_id = $wpdb->get_col( $wpdb->prepare( "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key='_sku' AND meta_value LIKE '%%%s%%';", wc_clean( $term ) ) ); // WPCS: db call ok.

		$search_ids = array_merge( $search_ids, $sku_to_id, $sku_to_parent_id );
	}

		$search_ids = array_filter( array_map( 'absint', $search_ids ) );

	if ( sizeof( $search_ids ) > 0 ) {
		$where = str_replace( ')))', ") OR ({$wpdb->posts}.ID IN (" . implode( ',', $search_ids ) . '))))', $where );
	}

		remove_filters_for_anonymous_class( 'posts_search', 'WC_Admin_Post_Types', 'product_search', 10 );
		return $where;
}

/**
 * Generate a 'Continue Shopping' link on the checkout page
 *
 * @return mixed HTML content of the 'Continue Shopping' buttont
 */
add_action( 'woocommerce_after_cart_totals', 'generate_continue_shopping_button_on_checkout', 10 );
function generate_continue_shopping_button_on_checkout() {
	echo '<a href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '" class="continue-shopping-button button alt wc-forward">Continue Shopping</a>';
}
