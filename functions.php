<?php
/**
 * Hayley functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Hayley
 */

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


if ( ! function_exists( 'hayley_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hayley_setup() {
	if ( ! isset( $content_width ) ) {
		$content_width = 640; /* pixels */
	}

	wp_link_pages( array(
		'before' => '<div class="page-links">' . __( 'Pages:', 'hayley' ),
		'after'  => '</div>',
	) );
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Hayley, use a find and replace
	 * to change 'hayley' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'hayley', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array( 'top-menu' 	=> __( 'Top Menu', 'hayley' ) ) );
	register_nav_menus( array( 'main-menu' 	=> __( 'Main Menu', 'hayley' ) ) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'hayley_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'hayley_setup' );

function hayley_customizer_social_media_array() {
	/* store social site names in array */
	$social_sites = array(
		'twitter', 
		'facebook', 
		'google-plus', 
		'github', 
		'rss', 
		'flickr', 
		'pinterest', 
		'youtube', 
		'tumblr', 
		'dribbble', 
		'linkedin', 
		'instagram'
	);
 
	return $social_sites;
}

/* add settings to create various social media text areas. */
add_action( 'customize_register', 'hayley_add_social_sites_customizer' );
 
function hayley_add_social_sites_customizer($wp_customize) {
 
	$wp_customize->add_section( 'hayley_social_settings', array(
		'title'    => __('Social Media Icons', 'hayley'),
		'priority' => 35,
	) );
 
	$social_sites = hayley_customizer_social_media_array();
	$priority = 5;
 
	if ( ! empty( $social_sites ) ) {
		foreach( $social_sites as $social_site ) {
			$wp_customize->add_setting( $social_site, array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			) );
		
			$wp_customize->add_control( $social_site, array(
				'label'    => $social_site . " url:",
				'section'  => 'hayley_social_settings',
				'type'     => 'text',
				'priority' => $priority,
			) );
		
			$priority += 5;
		}	
	}
}

function hayley_social_media_icons() {
 
    $social_sites = hayley_customizer_social_media_array();
    
    if ( ! empty( $social_sites ) ) {
	    foreach ( $social_sites as $social_site ) {
	        if( strlen( get_theme_mod( $social_site ) ) > 0 ) {
	            $active_sites[] = $social_site;
	        }
	    }
    }
    
    if ( ! empty( $active_sites ) ) {
        echo "<ul>";
        foreach ( $active_sites as $active_site ) {
	        $class = 'fa fa-' . $active_site;
			?>
            <li>
                <a class="<?php echo esc_attr( $active_site ); ?>" target="_blank" href="<?php echo esc_url( get_theme_mod( $active_site) ); ?>">
                    <span class="fa-stack fa-lg">
                    	<i class="fa fa-circle fa-stack-2x"></i>
                    	<i class="<?php echo esc_attr( $class ); ?> fa-stack-1x fa-inverse" title="<?php
                    	// translators: Social media icon
                    	printf(esc_html__('%s icon', 'hayley'), esc_html( $active_site ) ); ?>"></i>
                	</span>
                </a>
            </li>
            <?php
        }
        echo "</ul>";
    }
}


function hayley_customizer_live_preview() {
	wp_enqueue_script("hayley-themecustomizer", get_template_directory_uri() . "/js/theme-customizer.js", array("jquery", "customize-preview"), '',  true);
}

add_action("customize_preview_init", "hayley_customizer_live_preview");

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

/**
 * Sidebar
 */

function hayley_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hayley' ),
		'id'            => 'sidebar-1',
		'description' => __( 'Widgets in this area will be shown on the sidebar.', 'hayley' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'hayley_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hayley_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'hayley-style', get_template_directory_uri() . '/assets/css/master.css' );
	wp_enqueue_script( 'hayley-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20160514', true );
	wp_enqueue_script( 'hayley-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160514', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hayley_scripts' );

function google_fonts() {
	$query_args = array(
		'family' => 'Noto+Sans:400,700|Noto+Serif:400,700',
		'subset' => 'latin,latin-ext',
	);
	wp_register_style( 'google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
}
            
add_action('wp_enqueue_scripts', 'google_fonts');

function hayley_single_meta( $post_id = null ) {
	if ( empty( $post_id ) ) {
		return;
	}
	
	echo '<div class="single-line-meta">';
		esc_html_e( 'Posted on: ', 'hayley' );
		echo get_the_date() . esc_html__( ' by ', 'hayley' );
		the_author();
		echo '<div class="category">';
			echo esc_html( hayley_category( $post_id, true ) , 'hayley' );
		echo '</div>';
		
		echo '<div class="category">';
			echo esc_html( hayley_tags( $post_id, true ), 'hayley' );
		echo '</div>';
	echo '</div>';
}

function hayley_category( $post_id = null, $echo = false ) {
	if ( empty( $post_id ) ) {
		return;
	}
	
	$output = '';
	$separator = ', ';
	// Get all categories for this post
	$categories = get_the_category( $post_id );
	
	if ( ! empty( $categories ) && is_array( $categories ) ) {
		$last_array_item = count( $categories ) - 1;
		$output = '<span class="single-categories">' . __( 'Categories: ', 'hayley' ) . '</span>';
		foreach ( $categories as $key => $category ) {
			$cat_name = $category->name;
			$cat_url = get_category_link( $category->term_id );
			$output .= '<a href="'. esc_url( $cat_url ) .'">'. esc_attr ($cat_name ) . '</a>';
			if ( $key != $last_array_item ) {
				$output .= $separator;
			}
		}
	}
	
	if ( $echo === true ) {
		echo  $output;
	} else {
		return $output;
	}
}

function hayley_tags( $post_id = null, $echo = false ) {
	if ( empty( $post_id ) ) {
		return;
	}
	
	$output = '';
	$separator = ', ';
	// Get all categories for this post
	$posttags = get_the_tags( $post_id );
	
	if ( ! empty( $posttags ) && is_array( $posttags ) ) {
		$last_array_item = count( $posttags ) - 1;
		$output = '<span class="single-tags">' . __( 'Tags: ', 'hayley' ) . '</span>';
		foreach ( $posttags as $key => $tag ) {
			$tag_name = $tag->name;
			$tag_url = get_tag_link( $tag->term_id );
			$output .=  '<a href="'. $tag_url .'">'. $tag_name .'</a>';
			if ( $key != $last_array_item ) {
				$output .= $separator;
			}
		}
	}
	
	if ( $echo === true ) {
		echo $output;
	} else {
		return $output;
	}
}


/**
 * Set the Excerpt to 30 symbols
 */

function hayley_excerpt_length( $length ) {
	if ( is_admin() ) {
            return $length;
       }
    return 30;
}
add_filter( 'excerpt_length', 'hayley_excerpt_length');