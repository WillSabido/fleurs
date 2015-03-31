<?php
/**
 * The Header containing the header widget areas.
 *
 * @package webisabi-fleurs
 */
?>
	<div id="secondary" class="widget-area container-fluid" role="complementary">
	<div class="row">
		<?php if ( ! dynamic_sidebar( 'header-1' ) ) : ?>
<!--			<div class="col-xs-12 col-md-4"> -->
			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<aside id="meta" class="widget">
				<h1 class="widget-title"><?php _e( 'Meta', 'fleurs' ); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>
<!--			</div> End cols div-->

		<?php endif; // end header widget area ?>
	</div><!-- end row -->
	</div><!-- #secondary -->