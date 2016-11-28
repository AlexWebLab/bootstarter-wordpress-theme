<?php
// Let WordPress manage the document title.
add_theme_support( 'title-tag' );

// Enable support for Post Thumbnails on posts and pages.
add_theme_support( 'post-thumbnails' );

// Theme Menus
register_nav_menus( array(
	'primary' => esc_html__( 'Primary', 'bootstarter' ),
) );

// Switch default core markup for search form, comment form, and comments to output valid HTML5.
add_theme_support( 'html5', array(
	'search-form',
	'comment-form',
	'comment-list',
	'gallery',
	'caption',
) );

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Register Bootstrap Navigation Walker
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

// Disable Woocommerce Default Styling
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Disable Woocommerce Default Styling
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'woocommerce_support' );

// Custom CSS for WYSIWYG editor
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
