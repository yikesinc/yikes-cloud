<?php
/**
 * Widget API: YIKES_Card_Widget
 *
 * @package YIKES Starter
 */

/**
 * Custom class that implements a Card widget.
 *
 * @see WP_Widget_Media_Image
 */
class YIKES_Card_Widget extends WP_Widget_Media_Image {

	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->id_base         = 'yikes_card';
		$this->name            = __( 'YIKES Card Widget', 'custom' );
		$this->registered      = false;
		$this->option_name     = 'widget_' . $this->id_base;
		$this->widget_options  = array_merge(
			$this->widget_options,
			array(
				'description' => __( 'A widget that displays content and a link in a card style.', 'yikes_starter' ),
				'classname'   => $this->option_name,
			)
		);
		$this->control_options = array( 'id_base' => $this->id_base );
	}

	/**
	 * Get schema for properties of a widget instance (item).
	 *
	 * @see WP_REST_Controller::get_item_schema()
	 * @see WP_REST_Controller::get_additional_fields()
	 * @link https://core.trac.wordpress.org/ticket/35574
	 * @return array Schema for properties.
	 */
	public function get_instance_schema() {
		return array_merge(
			array(
				'text_area' => array(
					'type'                  => 'string',
					'default'               => '',
					'sanitize_callback'     => 'sanitize_text_field',
					'description'           => __( 'Content' ),
					'should_preview_update' => false,
				),
				'link_url'  => array(
					'type'                  => 'string',
					'default'               => '',
					'format'                => 'uri',
					'media_prop'            => 'linkUrl',
					'description'           => __( 'URL' ),
					'should_preview_update' => false,
				),
				'link_text' => array(
					'type'                  => 'string',
					'default'               => '',
					'sanitize_callback'     => 'sanitize_text_field',
					'description'           => __( 'Button Text' ),
					'should_preview_update' => false,
				),
				'badge'     => array(
					'type'                  => 'string',
					'default'               => '',
					'sanitize_callback'     => 'sanitize_text_field',
					'description'           => __( 'Badge Text' ),
					'should_preview_update' => false,
				),
			),
			parent::get_instance_schema()
		);
	}

	/**
	 * Display widget.
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		// Get what's needed from $args array ($args populated with options from widget area register_sidebar function).
		$before_title = isset( $args['before_title'] ) ? $args['before_title'] : '';
		$after_title  = isset( $args['after_title'] ) ? $args['after_title'] : '';

		// Get what's needed from $instanse array ($instance populated with user inputs from widget form).
		$title    = isset( $instance['title'] ) && ! empty( trim( $instance['title'] ) ) ? $instance['title'] : 'YIKES Card Widget';
		$title    = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$textarea = isset( $instance['text_area'] ) && ! empty( trim( $instance['text_area'] ) ) ? $instance['text_area'] : '';
		$linktext = isset( $instance['link_text'] ) && ! empty( trim( $instance['link_text'] ) ) ? $instance['link_text'] : '';
		$link     = isset( $instance['link_url'] ) && ! empty( trim( $instance['link_url'] ) ) ? $instance['link_url'] : '';
		$badge    = isset( $instance['badge'] ) && ! empty( trim( $instance['badge'] ) ) ? $instance['badge'] : '';
		$image_id = isset( $instance['attachment_id'] ) && 0 !== $instance['attachment_id'] ? $instance['attachment_id'] : '';
		$image    = $image_id ? wp_get_attachment_image_src( $image_id, 'large' )[0] : '';

		echo '<aside class="widget yikes-card yikes-card-widget" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(' . esc_url( $image ) . ');">';

		// If the badge is set.
		if ( $badge ) {
			echo '<span class="badge badge-pill badge-primary">' . esc_html( $badge ) . '</span>';
		}

		// If the title is set.
		if ( $title ) {
			echo '<h3 class="yikes-card-title yikes-card-widget-title">' . esc_html( $title ) . $after_title; // phpcs:ignore WordPress.Security.EscapeOutput
		}

		// If text is entered in the  textarea.
		if ( $textarea ) {
			echo '	<div class="yikes-card-text yikes-card-widget-text">' . esc_html( $textarea ) . '</div>';
		}

		// If text is entered for the button link.
		if ( $linktext ) {
			echo '	<a href="' . esc_url( $link ) . '" class="btn btn-outline-light">' . esc_html( $linktext ) . '</a>';
		}

		// Closing div.
		echo '</aside>';
	}

	/**
	 * Render the media on the frontend.
	 *
	 * @since 4.8.0
	 *
	 * @param array $instance Widget instance props.
	 * @return void
	 */
	public function render_media( $instance ) {}

	/**
	 * Loads the required media files for the media manager and scripts for media widgets.
	 */
	public function enqueue_admin_scripts() {
		wp_enqueue_media();
		wp_enqueue_script( 'media-widgets' );

		$handle = 'yikes-card-widget';
		wp_enqueue_script( $handle, get_template_directory_uri() . '/inc/js/widgets/yikes-card-widget.js', array(), '1.0.0', false );

		$exported_schema = array();
		foreach ( $this->get_instance_schema() as $field => $field_schema ) {
			$exported_schema[ $field ] = wp_array_slice_assoc( $field_schema, array( 'type', 'default', 'enum', 'minimum', 'format', 'media_prop', 'should_preview_update' ) );
		}
		wp_add_inline_script(
			$handle,
			sprintf(
				'wp.mediaWidgets.modelConstructors[ %s ].prototype.schema = %s;',
				wp_json_encode( $this->id_base ),
				wp_json_encode( $exported_schema )
			)
		);

		wp_add_inline_script(
			$handle,
			sprintf(
				'
					wp.mediaWidgets.controlConstructors[ %1$s ].prototype.mime_type = %2$s;
					wp.mediaWidgets.controlConstructors[ %1$s ].prototype.l10n = _.extend( {}, wp.mediaWidgets.controlConstructors[ %1$s ].prototype.l10n, %3$s );
				',
				wp_json_encode( $this->id_base ),
				wp_json_encode( $this->widget_options['mime_type'] ),
				wp_json_encode( $this->l10n )
			)
		);
	}


	/**
	 * Render form template scripts.
	 *
	 * @since 4.8.0
	 */
	public function render_control_template_scripts() {
		parent::render_control_template_scripts();
		?>
		<script type="text/html" id="tmpl-wp-media-widget-yikes-card-fields">
			<# var elementIdPrefix = 'el' + String( Math.random() ) + '_'; #>
			<p>
				<label for="{{ elementIdPrefix }}textArea"><?php esc_html_e( 'Card content:' ); ?></label>
				<textarea id="{{ elementIdPrefix }}textArea" class="widefat textarea" rows="5"></textarea>
			</p>
			<p>
				<label for="{{ elementIdPrefix }}linkText"><?php esc_html_e( 'Link Text' ); ?></label>
				<input id="{{ elementIdPrefix }}linkText" class="widefat linktext" type="text" />
			</p>
			<p>
				<label for="{{ elementIdPrefix }}linkUrl"><?php esc_html_e( 'Link URL' ); ?></label>
				<input id="{{ elementIdPrefix }}linkUrl" class="widefat linkurl" type="text" />
			</p>
			<p>
				<label for="{{ elementIdPrefix }}badge"><?php esc_html_e( 'Badge Text (optional)' ); ?></label>
				<input for="{{ elementIdPrefix }}badge" class="widefat badge" type="text" />
			</p>

		</script>
		<?php
	}
}

/**
 * Register YIKES_Cardwidget widget.
 */
function register_yikes_cardwidget() {
	register_widget( 'YIKES_Card_Widget' );
}

add_action( 'widgets_init', 'register_yikes_cardwidget' );
