<?php
/**
 * The Template for displaying category pages.
 *
 * @package webisabi-fleurs
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php if (is_category('Edibles')) : ?>
			<p>Edible plants and flowers from the garden</p>
			<?php elseif (is_category('Gardening')) : ?>
			<p>Gardening and landscaping services</p>
			<?php else : ?>
			<p>Miscellaneous</p>
		<?php endif; ?>
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<?php $query = new WP_Query( 'cat=-1' ); ?>
 		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

 		<div class="post">
 
 <!-- Display the Title as a link to the Post's permalink. -->
 			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

 <!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->
 			<small><?php the_time( 'F jS, Y' ); ?> by <?php the_author_posts_link(); ?></small>
 
  			<div class="entry">
  				<?php the_content(); ?>
  			</div>

 			<p class="postmetadata"><?php _e( 'Posted in' ); ?> <?php the_category( ', ' ); ?></p>
 		</div> <!-- closes the first div box -->

 		<?php endwhile; 
 			wp_reset_postdata();
 			else : ?>
 		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
 		<?php endif; ?>
<!--new loop-->
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php ws_fleurs_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>