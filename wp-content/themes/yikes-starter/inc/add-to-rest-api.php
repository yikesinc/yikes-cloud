<?php
/**
 * Add Meta to REST API
 *
 * @package   YIKES_Starter
 * @author    Ebonie Butler
 * @license   GPL2
 */

add_action( 'rest_api_init', 'yks_register_meta_api' );

/**
 * Add the meta fields to REST API responses for posts read and write.
 */
function yks_register_meta_api() {

	// Post types with meta fields that need to be added to API.
	$post_types = array(
		'cptcat',
	);

	// Meta fields that should be added to the API.
	$meta_fields = array(
		'cats_star1',
	);

	foreach( $post_types as $post_type ) {
		foreach ( $meta_fields as $field ) {
			register_rest_field(
				$post_type,
				$field,
				array(
					'get_callback'    => 'yks_get_meta_for_rest',
					'update_callback' => 'yks_update_meta_for_rest',
					'schema'          => null,
				)
			);
		}
	}
}



/**
 * Handler for getting custom field data.
 * 
 * @param array  $object The object from the response.
 * @param string $field_name Name of field.
 *
 * @return mixed
 */
function yks_get_meta_for_rest( $object, $field_name ) {
	return get_post_meta( $object['id'], $field_name, true );
}

/**
 * Handler for updating custom field data.
 *
 * @param mixed  $value The value of the field.
 * @param object $object The object from the response.
 * @param string $field_name Name of field.
 *
 * @return bool|int
 */
function yks_update_meta_for_rest( $value, $object, $field_name ) {
	return update_post_meta( $object->ID, $field_name, $value );
}
