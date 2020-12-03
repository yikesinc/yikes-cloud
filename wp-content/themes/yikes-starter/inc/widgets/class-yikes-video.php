<?php
/**
 * YIKES video widget
 *
 * @package YIKES Starter
 */

/**
 * Register YIKES video widget
 */
class YIKES_Video extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'yikes_video_widget', // Base ID.
			'Video Widget', // Name.
			array( 'description' => __( 'A widget to display a Video', 'text_domain' ) ) // Args.
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );

		$videotitle = $instance['videotitle'];
		$video      = $instance['video'];
		$textarea   = $instance['textarea'];

		echo $before_widget; 

		echo '<div class="panel panel-default">';
		echo '<div class="panel-heading">';

		if ( $videotitle ) {
			echo '<h3 class="panel-title">' . $videotitle . '</h3>'; 
		}

		echo '</div>';
		echo '<div class="widget-video-container">';

		if ( $video ) {
			echo wp_video_shortcode( 
				array( 
					'src' => $video,
				)
			);
		}

		echo '</div>';
		echo '<div class="panel-body">';

		if ( $textarea ) {
			echo $textarea; 
		}

		echo '</div>';
		echo '</div>';

		echo $after_widget; 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance               = $old_instance;
		$instance['videotitle'] = ( $new_instance['videotitle'] );
		$instance['video']      = ( $new_instance['video'] );
		$instance['textarea']   = ( $new_instance['textarea'] );
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$videotitle = esc_attr( $instance['videotitle'] );
		$video      = esc_attr( $instance['video'] );
		$textarea   = esc_attr( $instance['textarea'] );
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( ' videotitle' ) ); ?>"><?php _e( ' Enter video title:' );  ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'videotitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'videotitle' ) ); ?>" type="text" value="<?php echo esc_attr( $videotitle ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_url( $this->get_field_id( ' video' ) ); ?>"><?php _e( 'Enter video link:' );  ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'video' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'video' ) ); ?>" type="text" value="<?php echo esc_attr( $video ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( ' textarea' );  ?>"><?php _e( ' Enter video description:' );  ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( ' textarea' );  ?>" name="<?php echo $this->get_field_name( ' textarea' );  ?>"><?php echo $textarea;  ?></textarea>
		</p>

		<?php
	}
}

/**
 * Register YIKES_Video.
 */
function register_yikes_video_widget() {
	register_widget( 'YIKES_Video' );
}
add_action( 'widgets_init', 'register_yikes_video_widget' );

?>
