<?php
/**
 * YIKES recent posts widget
 *
 * @package YIKES Starter
 */

/**
 * Register recent posts widget
 */
class YIKES_Recent_Posts_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'yikes_recent_posts_widget', // Base ID.
			'YIKES Recent Posts', // Name.
			array( 'description' => __( 'Your site&#8217;s most recent posts with image thumbnails.', 'yikes_starter' ) ) // Args.
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		// Get widget title.
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );
		// Get number of posts.
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		// Get post title limit.
		$max = ( ! empty( $instance['max_length'] ) ) ? absint( $instance['max_length'] ) : 0;
		if ( ! $max ) {
			$max = 0;
		}
		// Get show date option.
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		// Perform query for posts.
		$query_args = array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		);
		$query      = new WP_Query( $query_args );
		if ( ! $query->have_posts() ) {
			return;
		}
		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		echo '<ul>';
		foreach ( $query->posts as $recent_post ) {
			$post_title        = get_the_title( $recent_post->ID );
			$post_title_length = strlen( $post_title );
			if ( $max ) {
				$post_title = trim( substr( $post_title, 0, $max ) );
				if ( $post_title_length > $max ) {
					$post_title .= '...';
				}
			}
			$post_link = get_the_permalink( $recent_post->ID );
			$post_img  = get_the_post_thumbnail_url( $recent_post->ID, 'thumbnail' );
			echo '<li>';
			echo '<img class="pull-left" src="' . $post_img . '">';
			echo '<p><a href="' . esc_url( $post_link ) . '">' . esc_html( $post_title ) . '</a></p>';
			if ( $show_date ) {
				echo '<p class="text-muted post-date">' . get_the_date( '', $recent_post->ID ) . '</p>';
			}
			echo '</li>';
		}
		echo '</ul>';
		echo $args['after_widget'];
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance               = $old_instance;
		$instance['title']      = sanitize_text_field( $new_instance['title'] );
		$instance['number']     = (int) $new_instance['number'];
		$instance['max_length'] = (int) $new_instance['max_length'];
		$instance['show_date']  = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title      = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number     = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$max_length = isset( $instance['max_length'] ) ? absint( $instance['max_length'] ) : 0;
		$show_date  = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'max_length' ) ); ?>"><?php esc_html_e( 'Post title char limit (0 for no limit):' ); ?></label>
		<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'max_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'max_length' ) ); ?>" type="number" step="1" min="0" value="<?php echo esc_attr( $max_length ); ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Display post date?' ); ?></label></p>
	<?php
	}
}

/**
 * Register YIKES_Recent_Posts_Widget.
 */
function register_yikes_recent_posts_widget() {
	register_widget( 'YIKES_Recent_Posts_Widget' );
}
add_action( 'widgets_init', 'register_yikes_recent_posts_widget' );
?>
