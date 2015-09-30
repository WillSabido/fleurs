<?php
/*
Template Name: Sidebar / Content Half
*/
?><?php get_header(); ?>
	<div id="container">
		<section id="content" class="column twocol">
			<?php if( have_posts() ) : the_post(); ?>
				<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
					<div class="entry">
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header><!-- .entry-header -->
						<div class="entry-content">
							<?php the_content(); ?>
							<div class="clear"></div>
						</div><!-- .entry-content -->
						<?php wp_link_pages( array( 'before' => '<footer class="entry-utility"><p class="post-pagination">' . __( 'Pages:', 'fleurs' ), 'after' => '</p></footer><!-- .entry-utility -->' ) ); ?>
					</div><!-- .entry -->
					<?php comments_template(); ?>
				</article><!-- .post -->
			<?php else : ?>
				<?php ws_fleurs_404(); ?>
			<?php endif; ?>
		</section><!-- #content -->
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div><!-- #container -->
<?php get_footer(); ?>
