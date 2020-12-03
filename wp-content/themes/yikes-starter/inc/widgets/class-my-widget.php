<?php
/**
 * YIKES widget template
 *
 * @package YIKES Starter
 */

/**
 * Register recent posts widget
 */
class My_Widget extends WP_Widget {
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct(
			'my_widget', // Base ID.
			'My Awesome Widget', // Name.
			array( 'description' => __( 'My Awesome widget I made myself', 'yikes_starter' ) ) // Args.
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
		$before_widget = isset( $args['before_widget'] ) ? $args['before_widget'] : '';
		$after_widget  = isset( $args['after_widget'] ) ? $args['after_widget'] : '';
		$before_title  = isset( $args['before_title'] ) ? $args['before_title'] : '';
		$after_title   = isset( $args['after_title'] ) ? $args['after_title'] : '';

		// Get what's needed from $instanse array ($instance populated with user inputs from widget form).
		$title     = isset( $instance['title'] ) && ! empty( trim( $instance['title'] ) ) ? $instance['title'] : 'YIKES Example Widget';
		$title     = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$textarea  = isset( $instance['textarea'] ) && ! empty( trim( $instance['textarea'] ) ) ? $instance['textarea'] : '';
		$textarea2 = isset( $instance['textarea2'] ) && ! empty( trim( $instance['textarea2'] ) ) ? $instance['textarea2'] : '';

		/** Output widget HTML BEGIN */
		echo $before_widget;  // phpcs:ignore WordPress.Security.EscapeOutput
		echo '<ul>';

		// If the title is set.
		if ( $title ) {
			echo $before_title . esc_html( $title ) . $after_title;  // phpcs:ignore WordPress.Security.EscapeOutput
		}

		// If text is entered in the first textarea.
		if ( $textarea ) {
			echo '	<li>' . esc_html( $textarea ) . '</li>';
		}

		// If text is entered in the second textarea.
		if ( $textarea2 ) {
			echo '	<li>' . esc_html( $textarea2 ) . '</li>';
		}

		echo '</ul>';
		echo $after_widget;  // phpcs:ignore WordPress.Security.EscapeOutput
		/** Output widget HTML BEGIN */
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 */
	public function update( $new_instance, $old_instance ) {

		// Set old settings to new $instance array.
		$instance = $old_instance;

		// Update each setting to new values entered by user.
		$instance['title']     = wp_strip_all_tags( $new_instance['title'] );
		$instance['textarea']  = ( $new_instance['textarea'] );
		$instance['textarea2'] = ( $new_instance['textarea2'] );

		return $instance;
	}
	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? $instance['title'] : '';
		$textarea  = isset( $instance['textarea'] ) ? $instance['textarea'] : '';
		$textarea2 = isset( $instance['textarea2'] ) ? $instance['textarea2'] : '';
		?>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title (optional)' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>"><?php esc_html_e( 'Enter text below:' ); ?></label>
		<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'textarea' ) ); ?>"><?php echo esc_html( $textarea ); ?></textarea>
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'textarea2' ) ); ?>"><?php esc_html_e( 'Enter more text below:' ); ?></label>
		<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'textarea2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'textarea2' ) ); ?>"><?php echo esc_html( $textarea2 ); ?></textarea>
	</p>
		<?php
	}
}

/**
 * Register My_Widget widget.
 */
function register_my_widget() {
	register_widget( 'My_Widget' );
}
add_action( 'widgets_init', 'register_my_widget' );
?>
