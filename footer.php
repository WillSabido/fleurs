<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package ws_fleurs
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<p class="credits twocol pull-left"><?php echo '&copy;' . date('Y') . '&nbsp;' . get_bloginfo ( 'name' ); ?> N<sup>o.</sup> Siret 491 068 060 00020. Tous les droits sont réservés.</p>
			<p class="credits twocol pull-right">
				<?php echo 'Le développement web et hébergement par  <a href="http://webisabihosting.co.uk" target="_blank">WebiSabi</a>'; ?>
			</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<!-- fade in nav, here to avoid page load rejumble -->
			<nav id="fade-in-site-navigation" class="navbar main-navigation fade-in" role="navigation" data-spy="affix" data-offset-top="262">
				<div id="menu-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img id="menu-image" src="<?php header_image(); ?>" width="auto" height="50px" alt="<?php echo bloginfo('name'); ?> logo">
					</a>
				</div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				<aside id="menu-search" class="pull-left widget_search">
					<?php get_search_form(); ?>
				</aside>
			</nav>
<!-- END fade-in nav -->
<?php wp_footer(); ?>

<!-- Carousel autoplay fix -->
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('.carousel').carousel({
  		interval: 10000	
  	})
});
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<!-- END Carousel autoplay fix -->
</body>
</html>