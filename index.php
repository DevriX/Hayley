<?php get_header();?>

<?php if ( have_posts() ) : ?>
	<div class="row section">
		<!-- POST ARCHIVE -->
		<section class="small-12 large-8 columns">
			<!-- <div class="large-10 columns"> -->
			<article class="entry" id="entry">
				<?php  while ( have_posts() ) : the_post(); 
					if ( has_post_thumbnail() ) { ?>
						<a href="<?php the_permalink(); ?>"><figure>
							<?php the_post_thumbnail(); ?>
						</figure></a>
					<?php } ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="single-post-meta">
						<?php echo esc_html( hayley_single_meta( $post->ID ) );  ?>
					</div>
					<div class="entry-content-container">
						<?php the_excerpt(); ?>
						<ul class="continue-reading">
							<li><a class="button read-more red" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Countinue Reading', 'hayley' ); ?></a></li> 
							<li class="comments"><?php comments_number(); ?></li>
						</ul>
					</div>
				<?php endwhile; ?>
			</article>
			<?php the_posts_navigation(); ?>
		<!-- </div> -->
		<div class="clear"></div>	
		</section>
		<?php get_sidebar(); ?>
	</div><!-- row-->
<?php endif; ?>

<?php get_footer();?>
