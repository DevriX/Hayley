<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta content="width=device-width, initial-scale=1" name="viewport">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
$header_image = "";
if ( get_header_image() ) {
	$header_image = get_header_image();
}

$description = get_bloginfo( 'description', 'display' );
?>
<!-- HEADER -->
<header id="header" class="site-header" style="background-image: url(<?php echo esc_attr( $header_image ); ?>)">
	<div class="top-bar">
		<div class="row">
			<div class="top-menu small-12 large-7 columns">
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
                        <?php haley_social_media_icons(); ?>
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
				<?php if ( ! empty( $description ) || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; ?></p>
				<?php endif; ?>
			</hgroup>
		</div>
		<div class="small-12 large-4 columns search-box">
			<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ) ?>">
				<div>
					<input class="search-field" type="text" placeholder="Type and hit Enter to search" name="s" id="s" />
				</div>
			</form>
		</div>
	</div>
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<div class="row">
			<div class="small-12 columns">
				<div class="nav-title"><?php _e( 'Navigation Menu', 'hayley' ); ?></div>
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