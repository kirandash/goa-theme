<?php

/*

@package goa-theme
	==============================
		ADMIN PAGE
	==============================
*/

function goa_theme_add_admin_page() {
	
	// Generate Goa Theme Admin Page
	add_menu_page( 'Goa Theme Options', 'Goa Theme', 'manage_options', 'goa_theme', 'goa_theme_create_page', get_template_directory_uri() . '/img/goa-theme-icon.png', 110 );
	
	// Generate Goa Theme Admin Sub Pages
	add_submenu_page( 'goa_theme', 'Goa Theme Options', 'Settings', 'manage_options', 'goa_theme', 'goa_theme_create_page' );
	add_submenu_page( 'goa_theme', 'Goa Theme CSS Options', 'Custom CSS', 'manage_options', 'goa_theme_css', 'goa_theme_settings_page' );
	
	// Activate custom settings
	add_action('admin_init','goa_theme_custom_settings');
	
}
add_action( 'admin_menu','goa_theme_add_admin_page' );

function goa_theme_custom_settings() {
	
	register_setting( 'goa-theme-settings-group', 'first_name' );
	register_setting( 'goa-theme-settings-group', 'last_name' );
	register_setting( 'goa-theme-settings-group', 'twitter_handler', 'goat_theme_sanitize_twitter_handler' );
	register_setting( 'goa-theme-settings-group', 'facebook_handler' );
	register_setting( 'goa-theme-settings-group', 'gplus_handler' );
	
	add_settings_section( 'goa-theme-sidebar-options', 'Sidebar Options', 'goa_theme_sidebar_options', 'goa_theme' );
	
	add_settings_field( 'sidebar-name', 'Full Name', 'goa_theme_sidebar_name', 'goa_theme', 'goa-theme-sidebar-options' );
	add_settings_field( 'sidebar-twitter', 'Twitter Handler', 'goa_theme_sidebar_twitter', 'goa_theme', 'goa-theme-sidebar-options' );
	add_settings_field( 'sidebar-facebook', 'Facebook Handler', 'goa_theme_sidebar_facebook', 'goa_theme', 'goa-theme-sidebar-options' );
	add_settings_field( 'sidebar-gplus', 'Google+ Handler', 'goa_theme_sidebar_gplus', 'goa_theme', 'goa-theme-sidebar-options' );
	
}

function goa_theme_sidebar_options() {
	echo 'Cutsomize your sidebar Information';
}

function goa_theme_sidebar_name() {
	$firstName = esc_attr( get_option( 'first_name' ) );
	$lastName = esc_attr( get_option( 'last_name' ) );
	
	echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name"> <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name">';
}

function goa_theme_sidebar_twitter() {
	$twitter = esc_attr( get_option( 'twitter_handler' ) );
	
	echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter Handler"><p class="description">Input your twitter username without the @ character</p>';
}

function goa_theme_sidebar_facebook() {
	$facebook = esc_attr( get_option( 'facebook_handler' ) );
	
	echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook Handler">';
}

function goa_theme_sidebar_gplus() {
	$gplus = esc_attr( get_option( 'gplus_handler' ) );
	
	echo '<input type="text" name="gplus_handler" value="'.$gplus.'" placeholder="Google+ Handler">';
}

// Sanitization settings
function goat_theme_sanitize_twitter_handler( $input ) {
	$output = sanitize_text_field($input);
	$output = str_replace('@','',$output);
	return $output;
}

function goa_theme_create_page() {
	// generation of our admin page
	require_once( get_template_directory() . '/inc/templates/goa-theme-admin.php');
}

function goa_theme_settings_page() {
	// generation of our admin page
	echo '<h1>Goa Custom CSS</h1>';
}