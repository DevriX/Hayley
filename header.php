<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta content="width=device-width, initial-scale=1" name="viewport">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>

<body  <?php body_class(); ?>>
	<?php
    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    }
    ?>

<?php
$hayley_header_image = "";
if ( get_header_image() ) {
	$hayley_header_image = get_header_image();
}

$hayley_description = get_bloginfo( 'description', 'display' );
?>
<!-- HEADER -->
<header id="header" class="site-header" style="background-image: url(<?php echo esc_url( $hayley_header_image ); ?>)">
	<div class="skip-to-content"><a href="#entry">Skip to Content</a></div>
	<div class="top-bar">
		<div class="row">
			<div id="site-navigation-top" class="top-menu small-12 large-7 columns">
				<!-- if has menu -->
                    <?php
                    if ( has_nav_menu( 'top-menu' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'top-menu',
							'menu_class' => 'top-menu' 
						) );
                    }
					?>
                </div>
				<div class="small-12 large-5 columns">
					<div class="social-bar top-social">
                        <?php hayley_social_media_icons(); ?>
                    </div>
					<!-- .top-social -->
			</div>
		</div>
		<!-- row-->
	</div>
	<!-- end top-bar -->
	<div class="row">
		<div class="small-12 large-8 columns">
			<hgroup>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
				<?php if ( ! empty( $hayley_description ) || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo esc_html( empty( $hayley_description ) ? '' : $hayley_description ); ?></p>
				<?php endif; ?>
			</hgroup>
		</div>
		<div class="small-12 large-4 columns search-box">
			<?php get_search_form(); ?>
		</div>
	</div>
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<div class="row">
			<div class="small-12 columns">
				<div class="nav-title"><?php esc_html_e( 'Navigation Menu', 'hayley' ); ?></div>
				<!-- .nav-title -->
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-navicon"></i>
					</button>
                    <?php
                    if ( has_nav_menu( 'main-menu' ) ) {
	                    wp_nav_menu( array( 
	                    	'theme_location' => 'main-menu',
	                    	'menu_id' => 'main-menu' 
	                    ) );
                    }
                    ?>
                </div>
				<!-- </div> -->
		</div>
	</nav>
</header>