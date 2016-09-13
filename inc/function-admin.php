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
	
	// Generate Goa Theme Admin Sub Pages
	add_submenu_page( 'goa_theme', 'Goa Theme CSS Options', 'Custom CSS', 'manage_options', 'goa_theme_css', 'goa_theme_settings_page' );
	
}
add_action( 'admin_menu','goa_theme_add_admin_page' );

function goa_theme_create_page() {
	//generation of our admin page
	require_once( get_template_directory() . '/inc/templates/goa-theme-admin.php');
}

function goa_theme_settings_page() {
	//generation of our admin page
	echo '<h1>Goa Custom CSS</h1>';
}