<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Hayley
 */

get_header();?>
<div class="row section">
	<!-- POST ARCHIVE -->
	<section class="large-8 columns">
		<!-- <div class="large-10 columns"> -->
		<article class="entry" id="entry">
			<?php if ( have_posts() ) : ?>
	
				<header class="page-header">
					<h1 class="page-title"><?php
					// translators: %s The Query that has been searched
					printf( esc_html__( 'Search Results for: %s', 'hayley' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->
				
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
	
					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );
	
				endwhile;
				the_posts_navigation();
	
			else :
	
				get_template_part( 'template-parts/content', 'none' );
	
			endif; ?> 
		</article> 
		<!-- </div> -->
		<div class="clear"></div>
	</section>
	<?php get_sidebar(); ?>
</div><!-- row-->
<!-- FOOTER -->

<?php get_footer();?>
