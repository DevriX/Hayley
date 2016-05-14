<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hayley
 */

?>

	</div><!-- #content -->

	<footer id="footer">
		<div class="row">
			<p class="columns entry">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'hayley' ) ); ?>" target="_blank" ><?php printf( esc_html__( 'Proudly powered by %s', 'hayley' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'hayley' ), 'hayley', '<a href="http://devrix.com" rel="designer" target="_blank" >DevriX</a>' ); ?>
			</p>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
