<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Hayley
 */

get_header();?>

<div class="row section">
	<!-- POST ARCHIVE -->
	<section class="large-8 columns">
		<!-- <div class="large-10 columns"> -->
		<article class="entry" id="entry">
		<?php
		while ( have_posts() ) : the_post();
		
			get_template_part( 'template-parts/content', get_post_format() );
			
		endwhile; // End of the loop.
		?>
		</article>
		<!-- </div> -->
		<div class="clear"></div>
	</section>
	<?php get_sidebar(); ?>
</div><!-- row-->
<!-- FOOTER -->

<?php get_footer();?>
