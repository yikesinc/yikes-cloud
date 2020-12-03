<?php
/**
 * YIKES social widget - Twitter
 *
 * @package YIKES Starter
 */

/**
 * Register social Twitter widget
 */
class YIKES_Socialt extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'yikes_socialt_widget', // Base ID.
			'Multi Twitter Account Widget', // Name.
			array(
				'description' => __( 'A social widget serving up feeds from multiple Twitter accounts', 'text_domain' ),
			)
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

		$title = apply_filters( 'widget_title', $instance['title'] );

		// Get any existing copy of our transient data.
		if ( false === (
			$twitter_data_array = get_transient( 'twitter_data_array' ) ) ) {
				$twitterurl = explode( ',', $instance['twitterurl'] );
				$twitterid  = explode( ',', $instance['twitterid'] );

			$twitter_url_length = count( $twitterurl );
			if ( $twitter_url_length > 0 ) {
				$random_int = wp_rand( 0, $twitter_url_length );
				if ( $random_int > 0 ) {
					$random_int = absint( $random_int - 1 );
				}
				$twitter_url  = trim( $twitterurl[ $random_int ] );
				$twitter_name = trim( $twitterid[ $random_int ] );
			} else {
				$twitter_url  = $twitterurl[0];
				$twitter_name = $twitterid[0];
			}
			$twitter_data_array = array(
				'url'  => $twitter_url,
				'name' => $twitter_name,
			);
			set_transient( 'twitter_data_array', $twitter_data_array, 2 * HOUR_IN_SECONDS );
		}

		echo wp_kses_post( $before_widget );

		// if the title is set.
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		?>
			<a class="twitter-timeline" data-height="439" href="https://twitter.com/<?php echo esc_attr( $twitter_data_array['url'] ); ?>">Tweets by <?php echo esc_attr( $twitter_data_array['name'] ); ?></a>
			<?php
			wp_register_script( 'twitter-init.js', '//platform.twitter.com/widgets.js', array(), true, true );
			wp_enqueue_script( 'twitter-init.js' );
			echo wp_kses_post( $after_widget );
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance               = $old_instance;
		$instance['title']      = wp_strip_all_tags( $new_instance['title'] );
		$instance['twitterurl'] = ( $new_instance['twitterurl'] );
		$instance['twitterid']  = ( $new_instance['twitterid'] );
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title      = esc_attr( $instance['title'] );
		$twitterurl = esc_attr( $instance['twitterurl'] );
		$twitterid  = esc_attr( $instance['twitterid'] );
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (optional)' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'twitterurl' ) ); ?>"><?php esc_attr_e( 'Enter Twitter Handle:' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitterurl' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitterurl' ) ); ?>" type="text" value="<?php echo esc_attr( $twitterurl ); ?>">
			</p>
		<?php
	}
}

/**
 * Register YIKES_Socialt widget.
 */
function register_yikes_socialt_widget() {
	register_widget( 'YIKES_Socialt' );
}
add_action( 'widgets_init', 'register_yikes_socialt_widget' );

?>
