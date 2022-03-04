<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hayley
 */

get_header();?>

<?php if ( have_posts() ) : ?>
	<div class="row section">
		<!-- POST ARCHIVE -->
		<section class="large-8 columns">
			<!-- <div class="large-10 columns"> -->
			<article class="entry" id="entry">
				<?php
				while ( have_posts() ) : the_post();
		
					get_template_part( 'template-parts/content', 'page' );
		
					// If comments are open or we have at least one comment, load up the comment template.
					// if ( comments_open() || get_comments_number() ) :
					// 	comments_template();
					// endif;
		
				endwhile; // End of the loop.
				?>
			</article>
			<div class="clear"></div>
		</section>
		<?php get_sidebar(); ?>
	</div><!-- row-->
<?php endif; ?>

<?php get_footer();?>
