<?php
/**
 * ws_fleurs functions and definitions
 *
 * @package ws_fleurs
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

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */

	add_theme_support( 'post-thumbnails' ); 


	// This theme uses wp_nav_menu() for primary navigation and language switching.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'fleurs' ),
		'language'=> __( 'Language Menu', 'fleurs' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array( 
		'aside',
		'image',  
		'video', 
		'quote', 
		'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ws_fleurs_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}
endif; // ws_fleurs_setup
add_action( 'after_setup_theme', 'ws_fleurs_setup' );

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ws_fleurs, use a find and replace
	 * to change 'fleurs' to the name of your theme in all the template files
	 */

function fleurs_translate_theme() {
    // Load Theme textdomain
    load_theme_textdomain('fleurs', get_template_directory() . '/languages');

    // Include Theme text translation file
    $locale = get_locale();
    $locale_file = get_template_directory() . "/languages/$locale.php";
    if ( is_readable( $locale_file ) ) {
        require_once( $locale_file );
    }
}

add_action( 'after_setup_theme', 'fleurs_translate_theme' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function ws_fleurs_widgets_init() {
	$title_tag = ws_fleurs_get_option( 'widget_title_tag' );
	register_sidebar( array(
		'name'          => __( 'Header Left', 'fleurs' ),
		'id'            => 'header-1',
		'before_widget' => '<aside id="%1$s" class="widget header-widget-left %2$s col-xs-12 col-md-4 pull-left">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Header Right', 'fleurs' ),
		'id'            => 'header-2',
		'before_widget' => '<aside id="%1$s" class="widget header-widget-right %2$s col-xs-12 col-md-4 pull-right">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'fleurs' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s col-xs-12 col-md-4">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	$columns = ws_fleurs_get_option( 'boxes_columns' );
	if( 1 == $columns )
		$grid_class = 'onecol';
	elseif( 2 == $columns )
		$grid_class = 'twocol';
	elseif( 3 == $columns )
		$grid_class = 'threecol';
	elseif( 4 == $columns )
		$grid_class = 'fourcol';
	register_sidebar( array(
		'name' 			=> __( 'Boxes', 'fleurs' ),
		'id'			=> 'boxes',
		'before_widget' => '<div class="column ' . $grid_class . '"><aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> '</aside><!-- .widget --></div>',
		'before_title'	=> '<' . $title_tag . ' class="widget-title">',
		'after_title'	=> '</' . $title_tag . '>'
	) );
	register_sidebar( array(
		'name'          => __( 'Footer', 'fleurs' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s col-xs-12 col-md-4">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'ws_fleurs_widgets_init' );

if ( ! function_exists( 'ws_fleurs_default_options' ) ) :
/**
 * Returns an array of theme default options.
 *
 * @since Fleurs 0.2
 */
function ws_fleurs_default_options() {
	$options = array(
		'home_page_excerpts' => 2,
		'slider' => true,
		'location' => true,
		'retina_header' => false,
		'crop_thumbnails' => false,
		'lightbox' => true,
		'facebook_link' => '',
		'twitter_link' => '',
		'pinterest_link' => '',
		'flickr_link' => '',
		'youtube_link' => '',
		'vimeo_link' => '',
		'googleplus_link' => '',
		'dribble_link' => '',
		'linkedin_link' => '',
		'portfolio_cat' => -1,
		'portfolio_filter' => true,
		'portfolio_excerpts' => 0,
		'portfolio_archive_excerpts' => 0,
		'portfolio_columns' => 3,
		'portfolio_meta' => true,
		'blog_exclude_portfolio' => true,
		'location' => true,
		'archive_excerpts' => 0,
		'posts_nav' => 'infinite',
		'posts_nav_labels' => 'older/newer',
		'fancy_dropdowns' => true,
		'facebook' => true,
		'twitter' => true,
		'google' => true,
		'pinterest' => true,
		'author_box' => false,
		'copyright_notice' => '&copy; %year% %blogname%',
		'theme_credit_link' => false,
		'author_credit_link' => false,
		'wordpress_credit_link' => false,
		'page_background' => '#ffffff',
		'menu_background' => '#111',
		'submenu_background' => '#333',
		'sidebar_wide_background' => '#eee',
		'content_background' => '#fff',
		'post_meta_background' => '#fcfcfc',
		'footer_area_background' => '#222',
		'footer_background' => '#111',
		'layout' => 'content-sidebar',
		'layout_columns' => 3,
		'boxes_columns' => 3,
		'footer_columns' => 3,
		'hide_sidebar' => false,
		'hide_footer_area' => false,
		'user_css' => '',
		'body_font' => 'open-sans',
		'headings_font' => 'oswald',
		'content_font' => 'open-sans',
		'body_font_size' => '13',
		'body_font_size_unit' => 'px',
		'body_line_height' => '1.62',
		'body_line_height_unit' => 'em',
		'h1_font_size' => '36',
		'h1_font_size_unit' => 'px',
		'h2_font_size' => '32',
		'h2_font_size_unit' => 'px',
		'h3_font_size' => '24',
		'h3_font_size_unit' => 'px',
		'h4_font_size' => '18',
		'h4_font_size_unit' => 'px',
		'headings_line_height' => '1.62',
		'headings_line_height_unit' => 'em',
		'content_font_size' => '15',
		'content_font_size_unit' => 'px',
		'content_line_height' => '1.62',
		'content_line_height_unit' => 'em',
		'mobile_font_size' => '17',
		'mobile_font_size_unit' => 'px',
		'mobile_line_height' => '1.62',
		'mobile_line_height_unit' => 'em',
		'body_color' => '#333',
		'headings_color' => '#333',
		'content_color' => '#333',
		'links_color' => '#21759b',
		'links_hover_color' => '#d54e21',
		'menu_color' => '#f0f0f0',
		'menu_hover_color' => '#fff',
		'sidebar_color' => '#ccc',
		'sidebar_title_color' => '#ccc',
		'sidebar_links_color' => '#7597B9',
		'footer_color' => '#ccc',
		'footer_title_color' => '#e0e0e0',
		'copyright_color' => '#ccc',
		'copyright_links_color' => '#7597B9',
		'home_site_title_tag' => 'h1',
		'home_desc_title_tag' => 'div',
		'home_post_title_tag' => 'h2',
		'archive_site_title_tag' => 'div',
		'archive_desc_title_tag' => 'div',
		'archive_location_title_tag' => 'h1',
		'archive_post_title_tag' => 'h2',
		'single_site_title_tag' => 'div',
		'single_desc_title_tag' => 'div',
		'single_post_title_tag' => 'h1',
		'single_comments_title_tag' => 'h2',
		'single_respond_title_tag' => 'h2',
		'widget_title_tag' => 'h3',
	);
	return $options;
}
endif;

if ( ! function_exists( 'ws_fleurs_get_option' ) ) :
/**
 * Used to output theme options is an elegant way
 *
 * @uses get_option() To retrieve the options array
 *
 * @since Fleurs 0.2
 */
function ws_fleurs_get_option( $option ) {
	global $ws_fleurs_options, $ws_fleurs_default_options;
	if( ! isset( $ws_fleurs_default_options ) )
		$ws_fleurs_default_options = ws_fleurs_default_options();
	if( ! isset( $ws_fleurs_options ) )
		$ws_fleurs_options = get_option( 'ws_fleurs_theme_options', $ws_fleurs_default_options );
	if( ! isset( $ws_fleurs_options[ $option ] ) )
		return $ws_fleurs_default_options[ $option ];
	return $ws_fleurs_options[ $option ];
}
endif;

if ( ! function_exists( 'ws_fleurs_body_class' ) ) :
/**
 * Adds template names to body_class filter
 *
 * The custom layouts are shared with the custom templates
 * and use the same style declarations
 * @since Fleurs 0.2
 */
function ws_fleurs_body_class( $classes ) {
	if( ! is_page_template() ) {
		$default_options = ws_fleurs_default_options();
		if( ( 'full-width' == ws_fleurs_get_option( 'layout' ) ) || ( ! is_active_sidebar( 2 ) && ! is_active_sidebar( 3 ) && ! is_active_sidebar( 4 ) && ! is_active_sidebar( 5 ) ) )
			$classes[] = 'page-template-template-full-width-php';
		elseif( 'sidebar-content' == ws_fleurs_get_option( 'layout' ) )
			$classes[] = 'page-template-template-sidebar-content-php';
		elseif( 'sidebar-content-sidebar' == ws_fleurs_get_option( 'layout' ) )
			$classes[] = 'page-template-template-sidebar-content-sidebar-php';
		elseif( 'content-sidebar-half' == ws_fleurs_get_option( 'layout' ) )
			$classes[] = 'page-template-template-content-sidebar-half-php';
		elseif( 'sidebar-content-half' == ws_fleurs_get_option( 'layout' ) )
			$classes[] = 'page-template-template-sidebar-content-half-php';
		elseif( 'no-sidebars' == ws_fleurs_get_option( 'layout' ) )
			$classes[] = 'page-template-template-no-sidebars-php';
	}
	return $classes;
}
endif;

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
 * Uncomment to enable shortcodes in widgets for testimonial slider
 */
// add_filter('widget_text', 'do_shortcode');