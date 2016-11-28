<?php
/**
 * BootStarter Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BootStarter_Theme
 */

if ( ! function_exists( 'bootstarter_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bootstarter_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on BootStarter Theme, use a find and replace
	 * to change 'bootstarter' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'bootstarter', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'bootstarter' ),
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
	add_theme_support( 'custom-background', apply_filters( 'bootstarter_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'bootstarter_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bootstarter_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bootstarter_content_width', 640 );
}
add_action( 'after_setup_theme', 'bootstarter_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bootstarter_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bootstarter' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'bootstarter' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'bootstarter_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
// function bootstarter_scripts() {
// 	wp_enqueue_style( 'bootstarter-style', get_stylesheet_uri() );
//
// 	wp_enqueue_script( 'bootstarter-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
//
// 	wp_enqueue_script( 'bootstarter-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
//
// 	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
// 		wp_enqueue_script( 'comment-reply' );
// 	}
// }
// add_action( 'wp_enqueue_scripts', 'bootstarter_scripts' );

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
 * Register Bootstrap Navigation Walker
 */
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

/**
 * Disable Woocommerce Default Styling
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Custom CSS for WYSIWYG editor
 */
function custom_editor_style() {
	add_editor_style(get_template_directory_uri().'/css/style-wysiwyg-editor.css');
}
add_action('after_setup_theme', 'custom_editor_style');

// Add CSS to back end
function css_to_back_end() {
	if ( !current_user_can('manage_options') ) {
		echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/style-for-editors.css">';
	}
}
add_action('admin_head', 'css_to_back_end');

// Remove some unwanted submenu entries for editors
add_action( 'admin_menu', 'remove_entries_for_editors', 999 );
function remove_entries_for_editors() {
	if ( !current_user_can('manage_options') ) {
		remove_submenu_page( 'themes.php', 'themes.php' );
		remove_submenu_page( 'themes.php', 'widgets.php' );
		$customize_url_arr = array();
	    $customize_url_arr[] = 'customize.php'; // 3.x
	    $customize_url = add_query_arg( 'return', urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ), 'customize.php' );
	    $customize_url_arr[] = $customize_url; // 4.0 & 4.1
	    if ( current_theme_supports( 'custom-header' ) && current_user_can( 'customize') ) {
	        $customize_url_arr[] = add_query_arg( 'autofocus[control]', 'header_image', $customize_url ); // 4.1
	        $customize_url_arr[] = 'custom-header'; // 4.0
	    }
	    if ( current_theme_supports( 'custom-background' ) && current_user_can( 'customize') ) {
	        $customize_url_arr[] = add_query_arg( 'autofocus[control]', 'background_image', $customize_url ); // 4.1
	        $customize_url_arr[] = 'custom-background'; // 4.0
	    }
	    foreach ( $customize_url_arr as $customize_url ) {
	    	remove_submenu_page( 'themes.php', $customize_url );
	    }
	}
}

// customise the login
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
function my_login_logo_url_title() {
    return get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/css/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
