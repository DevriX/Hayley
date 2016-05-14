<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hayley
 */

get_header(); ?>

<div class="row section">
	<section class="large-8 columns">
		<article class="entry">
			<?php if ( have_posts() ) : ?>
				<header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->
				<?php  
				/* Start the Loop */
				while ( have_posts() ) : the_post(); 
					if ( has_post_thumbnail() ) { ?>
						<figure>
							<?php the_post_thumbnail(); ?>
						</figure>
					<?php } ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="single-post-meta">
						<?php echo hayley_sinlge_meta( $post->ID ); ?>
					</div>
					<div class="entry-content-container">
						<?php the_excerpt(); ?>
						<ul class="continue-reading">
							<li><a class="button read-more red" href="<?php the_permalink(); ?>"><?php _e('Countinue Reading', 'hayley'); ?></a></li> 
							<li class="comments"><?php comments_number(); ?></li>
						</ul>
					</div>
				<?php endwhile; ?>
				<?php the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>
		</article>
		<div class="clear"></div>
	</section>
	<?php get_sidebar(); ?>
</div><!-- #primary -->

<?php get_footer(); ?>
