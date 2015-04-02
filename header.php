<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 * cut fonts <link href='http://fonts.googleapis.com/css?family=Poiret+One|Petit+Formal+Script|La+Belle+Aurore|Waiting+for+the+Sunrise|Indie+Flower|Dancing+Script:400,700|Lobster+Two:400,400italic,700|Handlee|Oregano:400,400italic|Griffy|Spirax|Montserrat:400,700' rel='stylesheet' type='text/css'>
 * @package webisabi-fleurs
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Snippet|Poiret+One|Comfortaa:400,300,700|Spirax' rel='stylesheet' type='text/css'>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="<?php get_template_directory() . '/js/html5shiv.js' ?>"></script>
          <script src="<?php get_template_directory() . '/js/respond.min.js' ?>"></script>
        <![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="page" class="hfeed site">

		<header id="masthead" class="site-header" role="banner">
			<!-- meta/crellyslider on homepage, about, edibles pages, else header image -->
			<?php if ( is_home() || is_front_page() ) : if (!is_admin()) {
				echo do_shortcode('[crellyslider alias="homepage"]');
				}
				elseif ( is_page( 'about' ) || '8' == $post->post_parent ) {
				echo do_shortcode('[crellyslider alias="about"]');
				}
				elseif ( is_page( 'comestibles' ) || '10' == $post->post_parent ) {
				echo do_shortcode('[crellyslider alias="edibles"]');
				}
				else {
				echo do_shortcode('[crellyslider alias="other"]');
				}
				endif;
			?>
			<!-- END metaslider -->
  			<?php if ( get_header_image() ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="Des Heures Dehors header image">
			</a>
			<?php endif; // End header image check. ?>
  			<?php wp_nav_menu( array( 'theme_location' => 'language', 'fleurs', 'container_class' => 'language-menu' ) ); ?>
  			<?php dynamic_sidebar( 'header-1' ); ?>
<!-- END Header image -->
			<div class="site-branding">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
			<nav id="site-navigation" class="navbar navbar-default main-navigation" role="navigation">
				<h1 class="menu-toggle"><?php _e( 'Menu', 'fleurs' ); ?></h1>
				<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'fleurs' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				<aside id="search" class="pull-left widget_search">
					<?php get_search_form(); ?>
				</aside>
			</nav><!-- #site-navigation -->
		</header><!-- #masthead -->
	<div id="content" class="site-content">