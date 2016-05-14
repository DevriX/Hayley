<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hayley
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<!-- RIGHT ASIDE WIDGETS-->
<aside class="large-4 columns aside-section">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- END RIGHT ASIDE -->
