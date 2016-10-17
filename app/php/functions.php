<?php
/**
 * feature-lights functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package feature-lights
 */

if ( ! function_exists( 'feature_lights_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function feature_lights_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on feature-lights, use a find and replace
		 * to change 'feature-lights' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'feature-lights', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'feature-lights' ),
		) );

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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'feature_lights_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
	}
endif;
add_action( 'after_setup_theme', 'feature_lights_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function feature_lights_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'feature_lights_content_width', 640 );
}

add_action( 'after_setup_theme', 'feature_lights_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function feature_lights_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'feature-lights' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'feature-lights' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'feature_lights_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function feature_lights_scripts() {
	wp_enqueue_style( 'feature-lights-style', get_stylesheet_uri() );
	wp_enqueue_script( 'bundle', get_template_directory_uri(). '/js/bundle.js', array( 'jquery' ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'feature_lights_scripts' );

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

/**
 * WooCommerce
 *
 * Unhook sidebar
 */
//remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

$menu_default = array(
	'theme_location'  => '',
	'menu'            => 'menu',
	'container'       => 'div',
	'container_class' => 'menu-{menu slug}-container',
	'menu_class'      => 'menu',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'depth'           => 0,
);

function my_custom_body_class($classes) {
	// add 'my-class' to the default autogenerated classes, for this we need to modify the $classes array.
	$classes[] = 'woocommerce';
	// return the modified $classes array
	return $classes;
}

// add my custom class via body_class filter
add_filter('body_class','my_custom_body_class');

function custom_shop_item_class($classes) {
	// add 'my-class' to the default autogenerated classes, for this we need to modify the $classes array.
	$classes[] = 'shop-products__item';
	// return the modified $classes array
	return $classes;
}

add_filter('post_class','custom_shop_item_class');

function wpb_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'wpb' ),
		'id' => 'sidebar-1',
		'description' => __( 'The main sidebar appears on the right on each page except the front page template', 'wpb' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );

}

add_action( 'widgets_init', 'wpb_widgets_init' );

/*PUT THIS IN YOUR CHILD THEME FUNCTIONS FILE*/

/*STEP 1 - REMOVE ADD TO CART BUTTON ON PRODUCT ARCHIVE (SHOP) */

function remove_loop_button(){
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}
add_action('init','remove_loop_button');



/*STEP 2 -ADD NEW BUTTON THAT LINKS TO PRODUCT PAGE FOR EACH PRODUCT */
add_action('woocommerce_after_shop_loop_item','replace_add_to_cart');
function replace_add_to_cart() {
	global $product;
	$link = $product->get_permalink();
	echo do_shortcode('<a class="button add_to_cart_button" href="' . esc_attr($link) . '"]>Select options</a>');
}

