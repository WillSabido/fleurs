<?php
/**
 * webisabi-fleurs functions and definitions
 *
 * @package webisabi-fleurs
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'ws_fleurs_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ws_fleurs_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on webisabi-fleurs, use a find and replace
	 * to change 'fleurs' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'fleurs', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'fleurs' ),
	) );
	
	// Enable support for featured images
	add_theme_support( 'post-thumbnails' ); 

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ws_fleurs_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // ws_fleurs_setup
add_action( 'after_setup_theme', 'ws_fleurs_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function ws_fleurs_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'fleurs' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s col-xs-12 col-md-4">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer', 'fleurs' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s col-xs-12 col-md-4">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'ws_fleurs_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ws_fleurs_scripts() {

	wp_enqueue_script( 'fleurs-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'popover', get_template_directory_uri() . '/js/popover.js', array(), null, true);
	wp_enqueue_script( 'mobile-nav', get_template_directory_uri() . '/js/navigation.js', array(), null, true);
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( is_front_page() ) {
		wp_enqueue_script( 'popover' );
	}
	if ( !is_admin() ) {
		wp_enqueue_script( 'mobile-nav' );
	}
}
add_action( 'wp_enqueue_scripts', 'ws_fleurs_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Enable Bootstrap, jQuery, Font Awesome
 */
// Only on front-end pages, NOT in admin area
if (!is_admin()) {

	// Load CSS
	add_action('wp_enqueue_scripts', 'twbs_load_styles', 11);
	function twbs_load_styles() {
		// Bootstrap
		wp_register_style('bootstrap-styles', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css', array(), null, 'all');
		wp_enqueue_style('bootstrap-styles');
		// Bootswatch Amelia styles
//		wp_register_style('bootswatch-styles', '//netdna.bootstrapcdn.com/bootswatch/3.1.0/amelia/bootstrap.min.css', array(), null, 'all');
//		wp_enqueue_style('bootswatch-styles');
		// Theme Styles
		wp_register_style('theme-styles', get_stylesheet_uri(), array(), null, 'all');
		wp_enqueue_style('theme-styles');
		// Font Awesome
		wp_register_style('font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array(), null, 'all');
		wp_enqueue_style('font-awesome');
	}

	// Load Javascript
	add_action('wp_enqueue_scripts', 'twbs_load_scripts', 12);
	function twbs_load_scripts() {
		// jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', array(), null, false);
		wp_enqueue_script('jquery');
		// Bootstrap
		wp_register_script('bootstrap-scripts', '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js', array('jquery'), null, true);
		wp_enqueue_script('bootstrap-scripts');
		// Popovers
		wp_register_script('popover', get_template_directory() . '/js/popover.js', array(), null, true);
		wp_enqueue_script('popover');
		// Navigation for mobile
//		wp_register_script('mobile-nav', get_template_directory() . '/js/navigation.js', array(), null, true);
//		wp_enqueue_script('mobile-nav');
	}

} // end if !is_admin
/**
 * Enable shortcodes in widgets for testimonial slider
 */
add_filter('widget_text', 'do_shortcode');