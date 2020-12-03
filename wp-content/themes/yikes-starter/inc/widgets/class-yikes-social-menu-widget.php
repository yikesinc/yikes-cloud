<?php
/**
 * YIKES social menu widget
 *
 * @package YIKES Starter
 */

/**
 * Register social menu widget
 */
class YIKES_Social_Menu_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'yikes_social_menu_widget', // Base ID.
			'YIKES Social Menu', // Name.
			array( 'description' => __( 'Display social media menu with flexibility', 'yikes_starter' ) ) // Args.
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		// Get menu ID for Social Nav Menu.
		$menu_name = 'social_menu';
		$locations = get_nav_menu_locations();
		$menu_id   = isset( $locations[ $menu_name ] ) ? $locations[ $menu_name ] : '';

		if ( empty( $menu_id ) ) {
			echo '<p style="color:red;">YIKES Social Menu Widget Error: Please assign a menu to the Social Menu location for this widget to work properly.</p>';
			return;
		}

		// Get title.
		$title = isset( $instance['title'] ) && ! empty( trim( $instance['title'] ) ) ? $instance['title'] : 'Social';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		// Get orientation.
		$orientation = isset( $instance['orientation'] ) && ! empty( trim( $instance['orientation'] ) ) ? $instance['orientation'] : '';

		/**
		 * Display nav menu
		 */

		// Get $before_widget attribute set on selected widget area (register_sidebar) and display.
		$before_widget = isset( $args['before_widget'] ) ? $args['before_widget'] : '';
		echo $before_widget;

		// Check if hide_text option is set.
		$hide_text = isset( $instance['hide_text'] ) && ! empty( trim( $instance['hide_text'] ) ) ? 'class="widget-hide-text"' : '';

		// Set arguments to display social menu with additional options.
		$nav_menu_args = array(
			'fallback_cb' => '',
			'menu'        => $menu_id,
			'link_before' => "<span {$hide_text}>",
			'link_after'  => '</span>',
			'menu_class'  => $orientation,
		);

		// Display widget title.
		$before_title = isset( $args['before_title'] ) ? $args['before_title'] : '';
		$after_title  = isset( $args['after_title'] ) ? $args['after_title'] : '';
		echo $before_title . $title . $after_title; 

		wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $menu_id, $args, $instance ) );

		// Get $after_widget attribute set on selected widget area (register_sidebar) and display.
		$after_widget = isset( $args['after_widget'] ) ? $args['after_widget'] : '';
		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                = $old_instance;
		$instance['title']       = wp_strip_all_tags( $new_instance['title'] );
		$instance['hide_text']   = $new_instance['hide_text'] ? 1 : 0;
		$instance['orientation'] = $new_instance['orientation'];
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title       = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$hide        = isset( $instance['hide_text'] ) ? $instance['hide_text'] : 0;
		$orientation = isset( $instance['orientation'] ) ? $instance['orientation'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title (optional)' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $hide ); ?> id="<?php echo esc_attr( $this->get_field_id( 'hide_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_text' ) ); ?>" /> <label for="<?php echo esc_attr( $this->get_field_id( 'hide_text' ) ); ?>"><?php esc_html_e( 'Hide Text' ); ?></label>
		</p>
		<p>
			<input type="radio" id="stacked" name="<?php echo esc_attr( $this->get_field_name( 'orientation' ) ); ?>" value="stacked" 
			<?php
			if ( 'stacked' === $orientation ) {
				echo 'checked';
			}
			?>
			>
			<label for="stacked">Stacked</label>
			<input type="radio" id="inline" name="<?php echo esc_attr( $this->get_field_name( 'orientation' ) ); ?>" value="inline" 
			<?php
			if ( 'inline' === $orientation ) {
				echo 'checked';
			}
			?>
			>
			<label for="inline">Inline</label>
		</p>

	<?php
	}
}

/**
 * Register YIKES_Social_Menu_Widget widget.
 */
function register_yikes_social_menu_widget() {
	register_widget( 'YIKES_Social_Menu_Widget' );
}
add_action( 'widgets_init', 'register_yikes_social_menu_widget' );

?>
