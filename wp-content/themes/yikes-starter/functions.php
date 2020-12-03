<?php
/**
 * YIKES Starter functions and definitions
 *
 * @package YIKES Starter
 */

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function yikes_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'yikes_content_width', 1170 );
}
add_action( 'after_setup_theme', 'yikes_content_width', 0 );

// Versioning .
if ( ! defined( 'YIKES_THEME_VERSION' ) ) {
	$versions = array(
		'yikes-theme' => '1.0', // Bump this any time you make serious CSS changes.
	);
	define( 'YIKES_THEME_VERSION', $versions );
}

/**
 * YIKES Stuff
 */

// YIKES Setup theme constants These will be used for server and web paths so we don't have to reference functions every time.
if ( ! defined( 'YKS_THEME_PATH' ) ) {
	define( 'YKS_THEME_PATH', get_stylesheet_directory() );
}
if ( ! defined( 'YKS_THEME_URL' ) ) {
	define( 'YKS_THEME_URL', trailingslashit( get_stylesheet_directory_uri() ) );
}

// YIKES Configure the admin section.
require_once get_template_directory() . '/inc/config-admin.php';

/**
 * Get the title of the page defined for posts.
 */
function yikes_starter_blog_page_title() {
	if ( get_option( 'page_for_posts' ) ) {
		return get_the_title( get_option( 'page_for_posts' ) );
	}
}

/**
 * Get the featured image of the page defined for posts.
 *
 * @param mixed $image_size a valid image size value. Could be a string like 'full' or an array with height/width values.
 * See the wp_get_attachment_image_url() function documentation for more details.
 *
 * @return Image URL if found, else false
 */
function yikes_starter_blog_page_featured_image( $image_size = 'full' ) {
	$page_id_for_posts = get_option( 'page_for_posts' );
	if ( ! empty( $page_id_for_posts ) && has_post_thumbnail( $page_id_for_posts ) ) {
		$post_thumbnail_id = get_post_thumbnail_id( $page_id_for_posts );
		return esc_url( wp_get_attachment_image_url( $post_thumbnail_id, $image_size ) );
	}

	// If no image is found, return false.
	return false;
}


/**
 * Excerpts
 *
 * @param string $more set the more ellipsis.
 */
function yikes_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'yikes_excerpt_more' );

/**
 * Widgets
 */
// require_once get_template_directory() . '/inc/widgets/class-my-widget.php';


/**
 * Custom Post Types
 */
// require_once get_template_directory() . '/inc/cpt/cpt-example.php';
// require_once get_template_directory() . '/inc/cpt/cpt-example-groups.php';


/**
 * Theme Options
 */
// require_once get_template_directory() . '/inc/cpt/theme-options-example.php';

/**
 * REST API
 */
require_once get_template_directory() . '/inc/add-to-rest-api.php';

/**
 * Theme Logo
 */
function yikes_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}


/**
 * Images
 */

/**
 * Custom Thumbnail sizes.
 */
// add_image_size( 'featured-img', 400, 400 ); // soft proportional crop mode.
// add_image_size( 'other-img', 200, 269, true ); // hard crop mode.


/**
 * Get the ID of a page based on the template it's using.
 *
 * @param string $template The name of a template, e.g. page-home.php.
 * @param bool   $use_transient Whether we should set/check a transient value before querying.
 *
 * @return mixed Page ID if found, else false
 **/
function yikes_get_page_by_template( $template, $use_transient = false ) {

	if ( true === $use_transient ) {
		$page_id = get_transient( "wp_page_template_{$template}" );

		if ( ! empty( $page_id ) ) {
			return $page_id;
		}
	}

	if ( empty( $page_id ) ) {
		$pages = new WP_Query(
			array(
				'post_type'      => 'page',
				'posts_per_page' => '-1',
				'fields'         => 'ids',
			)
		);

		if ( $pages->have_posts() ) {
			foreach ( $pages->posts as $page_id ) {
				$pagetemplate = get_post_meta( $page_id, '_wp_page_template', true );
				if ( $pagetemplate === $template ) {

					if ( true === $use_transient ) {
						set_transient( "wp_page_template_{$template}", $page_id, 1 * HOUR_IN_SECONDS );
					}

					return $page_id;
				}
			}
			wp_reset_postdata();
		}
	}

	return false;
}


/**
 * Ability to display featured image captions
 * echo yikes_post_thumbnail_caption()
 */
function yikes_post_thumbnail_caption() {
	global $post;
	// Get the thumbnail ID for the given post.
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	// Get the attachment for this post.
	$thumbnail_image = get_posts(
		array(
			'p'         => $thumbnail_id,
			'post_type' => 'attachment',
		)
	);
	// If the thumbnail image exists.
	if ( $thumbnail_image && isset( $thumbnail_image[0] ) ) {
		$caption = $thumbnail_image[0]->post_excerpt;
	}
	return $caption;
}

/**
 * Woo Commerce
 */
// require_once get_template_directory() . '/inc/woo-functions.php';


/**
 * Comments
 */
require_once get_template_directory() . '/inc/class-new-walker-comment.php';


/**
 * Archives
 *
 * @param string $title get rid of the “Category:”, “Tag:”, “Author:”, “Archives:”
 *  and “Other taxonomy name:” in the archive title.
 */
function yikes_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}

	return $title;
}

add_filter( 'get_the_archive_title', 'yikes_archive_title' );


/**
 * Theme Setup
 */
if ( ! function_exists( 'yikes_starter_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features. */
	function yikes_starter_setup() {

		/**
		 * Set up Nav menus */
		register_nav_menus(
			array(
				'primary'     => __( 'Primary Menu', 'yikes_starter' ),
				'social_menu' => __( 'Social Menu', 'yikes_starter' ),
			)
		);

		/*
		Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on yikes starter, use a find and replace
		 * to change 'yikes_starter' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'yikes_starter', get_template_directory() . '/languages' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Enable support for a Theme Logo
		 */
		add_theme_support( 'custom-logo' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', 
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
	}
}

add_action( 'after_setup_theme', 'yikes_starter_setup' );

/**
 * Enable Gutenberg -- VIP Go Specific Function
 */
if ( function_exists( 'gutenberg_ramp_load_gutenberg' ) ) {
	gutenberg_ramp_load_gutenberg(
		array(
			'post_types' => array(
				'post',
				'page',
			),
		)
	);
}


/**
 * Register widgetized areas and update sidebar with default widgets
 */
function yikes_starter_widgets_init() {
	// Primary Widget.
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'yikes_starter' ),
			'id'            => 'sidebar-1',
			'description'   => 'The primary sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	// Footer Widget 1.
	register_sidebar(
		array(
			'name'          => __( 'Footer Widget Area One', 'yikes_starter' ),
			'id'            => 'footer-1',
			'description'   => 'The first footer widget area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	// Footer Widget 2.
	register_sidebar(
		array(
			'name'          => __( 'Footer Widget Area Two', 'yikes_starter' ),
			'id'            => 'footer-2',
			'description'   => 'The second footer widget area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	// Footer Widget 3.
	register_sidebar(
		array(
			'name'          => __( 'Footer Widget Area Three', 'yikes_starter' ),
			'id'            => 'footer-3',
			'description'   => 'The third footer widget area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	// Footer Widget 4.
	register_sidebar(
		array(
			'name'          => __( 'Footer Widget Area Four', 'yikes_starter' ),
			'id'            => 'footer-4',
			'description'   => 'The fourth footer widget area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'yikes_starter_widgets_init' );

/**
 * Bootstrap Stuff
 */

// Navigation Walker.
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

/**
 * Pagination
 *
 * @usage
 * 1) setup your WP_Query with a $paged variable (https://codex.wordpress.org/Pagination#Adding_the_.22paged.22_parameter_to_a_query)
 * 2) Wherever you'd like the pagination to appear, add <?php echo page_navi( $query ); ?> where $query is the entire $query setup in the previous step
 */
require_once get_template_directory() . '/inc/wp-bootstrap-pagination.php';

// Add classes to “next_post_link” and “previous_post_link”.
add_filter( 'next_post_link', 'post_link_attributes' );
add_filter( 'previous_post_link', 'post_link_attributes' );

/**
 * Pagination
 *
 * @param string $output add classes to links.
 */
function post_link_attributes( $output ) {
	$code = 'class="page-link"';
	return str_replace( '<a href=', '<a ' . $code . ' href=', $output );
}

add_filter( 'next_posts_link_attributes', 'posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'posts_link_attributes' );

/**
 * Pagination
 *
 * Add classes to links.
 */
function posts_link_attributes() {
	return 'class="page-link"';
}

/**
 *  Scripts and styles
 */

/**
 * Add GA code after the open body tag
 */
function yikes_body_code() {
	echo "<!-- Global site tag (gtag.js) - Google Analytics - updated 3/19/18 -->
<script async src='https://www.googletagmanager.com/gtag/js?id=UA-xxxxxx-1'></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-xxxxxx-1');
</script>";
}

add_action( 'wp_body_open', 'yikes_body_code' );

/**
 * Async load.
 *
 * @param string $url the script URL.
 */
function yikes_async_scripts( $url ) {
	if ( strpos( $url, '#asyncload' ) === false ) {
		return $url;
	} elseif ( is_admin() ) {
		return str_replace( '#asyncload', '', $url );
	} else {
		return str_replace( '#asyncload', '', $url ) . "' async='async";
	}
}

add_filter( 'clean_url', 'yikes_async_scripts', 11, 1 );

/**
 * Enqueue scripts and styles
 */
function yikes_starter_scripts() {
	$get_theme_vers = YIKES_THEME_VERSION;
	$yikes_theme    = $get_theme_vers['yikes-theme'];

	wp_enqueue_style( 'yikes-starter-style', get_stylesheet_directory_uri() . '/style.min.css', array(), $yikes_theme );

	// combined + minified.
	// navigation.js & skip-link-focus-fix.js.
	wp_enqueue_script( 'yikes-starter-navigation', get_template_directory_uri() . '/inc/js/yikes-theme-scripts.min.js', array(), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'yikes-bootstrap-style', get_template_directory_uri() . '/inc/bootstrap/css/bootstrap.min.css', array(), 'all' );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,600,700', array(), 'all', false );
	if ( ! is_customize_preview() ) {
		wp_enqueue_script( 'yikes-fontawesome-script', get_template_directory_uri() . '/inc/js/fontawesome-all.min.js#asyncload', array(), 'all', true );
	}
	wp_enqueue_script( 'yikes-bootstrap-script', get_template_directory_uri() . '/inc/bootstrap/js/bootstrap.min.js', array( 'jquery' ), 'all', true );

	/**
	 * Styles & Scripts to make tables stack on mobile (optional)
	 * Reference: https://github.com/filamentgroup/tablesaw
	 *
	 * wp_enqueue_style( 'yikes-tablesaw-style', get_template_directory_uri() . '/inc/css/tablesaw.min.css', array(), 'all' );
	 * wp_enqueue_script( 'yikes-tablesaw-script', get_template_directory_uri() . '/inc/js/tablesaw.min.js', array( 'jquery' ) );
	 * wp_enqueue_script( 'yikes-tablesaw-init-script', get_template_directory_uri() . '/inc/js/tablesaw-init.min.js', array( 'jquery' ) );
	 */
}

add_action( 'wp_enqueue_scripts', 'yikes_starter_scripts' );

/**
 * Enqueue block styles in the editor.
 */
function yikes_block_editor_styles() {
	wp_enqueue_style( 'yikes-block-editor-styles', get_theme_file_uri( '/style-editor.min.css' ), false, '1.0', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'yikes_block_editor_styles' );

/**
 * Enable pseudo elements for FA icons.
 *
 * @param string $tag the parameter to add pseudo elements.
 * @param string $handle the script ID.
 */
function yikes_fa_pseudo_elements( $tag, $handle ) {
	if ( 'yikes-fontawesome-script' !== $handle ) {
		return $tag;
	}
	return str_replace( ' src', ' data-search-pseudo-elements src', $tag );
}

add_filter( 'script_loader_tag', 'yikes_fa_pseudo_elements', 10, 2 );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates. */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Optional Items
 */

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Remove custom background support */
remove_theme_support( 'custom-background' );
