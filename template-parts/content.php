<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hayley
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- <div class="large-10 columns"> -->
		<article class="entry" id="entry">
			<?php if ( has_post_thumbnail() ) { 
				the_post_thumbnail();
			} ?>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>				
			
			<div class="single-post-meta">
					<?php echo esc_html( hayley_single_meta( $post->ID ) ); ?>
				</div>		
			<div class="entry-content-container">						
				<?php the_content(); ?>
				
				<?php
				 	$hayley_defaults = array(
				 		'before'			=> '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'hayley' ) . '</span>',
						'after'            	=> '</div>',
						'link_before'      	=> '',
						'link_after'       	=> '',
						'next_or_number'   	=> 'number',
						'separator'        	=> ' ',
						'nextpagelink'     	=> __( 'Next page', 'hayley' ),
						'previouspagelink' 	=> __( 'Previous page', 'hayley' ),
						'pagelink'         	=> '%',
						'echo'             	=> 1
					);
 
        			wp_link_pages( $hayley_defaults );
					?>
			</div>
		</article>
	<!-- </div> -->		
	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	?>
</article><!-- #post-## -->
