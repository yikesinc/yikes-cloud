<?php
/**
 * YIKES social widget - Facebook
 *
 * @package YIKES Starter
 */

/**
 * Register social Facebook widget
 */
class YIKES_Socialfb extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'yikes_socialfb_widget', // Base ID.
			'Multi Facebook Page Widget', // Name.
			array(
				'description' => __( 'A social widget serving up feeds from multiple Facebook pages', 'text_domain' ),
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
			$facebook_data_array = get_transient( 'facebook_data_array' ) ) ) {
				$facebookurl         = explode( ',', $instance['facebookurl'] );
				$facebook_url_length = count( $facebookurl );
			if ( $facebook_url_length > 0 ) {
				$random_int = wp_rand( 0, $facebook_url_length );
				if ( $random_int > 0 ) {
					$random_int = absint( $random_int - 1 );
				}
				$facebook_url = trim( $facebookurl[ $random_int ] );
			} else {
				$facebook_url = $facebookurl[0];
			}
			$facebook_data_array = array(
				'url' => $facebook_url,
			);
			set_transient( 'facebook_data_array', $facebook_data_array, 2 * HOUR_IN_SECONDS );
		}

		echo wp_kses_post( $before_widget );

		// if the title is set.
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		echo "<div id='fb-root'></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = '//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5';
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>";

		echo '<div class="fb-page" data-href="https://www.facebook.com/' . esc_attr( $facebook_data_array['url'] ) . '/" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false" height="300"><div class="fb-xfbml-parse-ignore">
					<blockquote cite="https://www.facebook.com/' . esc_attr( $facebook_data_array['url'] ) . '/">
						<a href="https://www.facebook.com/' . esc_attr( $facebook_data_array['url'] ) . '/">' . esc_attr( $facebook_data_array['url'] ) . '</a>
					</blockquote>
				</div>
			</div>';

		echo wp_kses_post( $after_widget );
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
		$instance['facebookurl'] = ( $new_instance['facebookurl'] );
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title       = esc_attr( $instance['title'] );
		$facebookurl = esc_attr( $instance['facebookurl'] );
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (optional)' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'facebookurl' ) ); ?>"><?php esc_attr_e( 'Enter Facebook Page Usernames separated by commas:' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebookurl' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebookurl' ) ); ?>" type="text" value="<?php echo esc_attr( $facebookurl ); ?>">
			</p>
		<?php
	}
}

/**
 * Register YIKES_Socialfb.
 */
function register_yikes_socialfb_widget() {
	register_widget( 'YIKES_Socialfb' );
}
add_action( 'widgets_init', 'register_yikes_socialfb_widget' );

?>
