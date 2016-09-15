<?php

/*

@package goa-theme
	==============================
		ADMIN ENQUEUE FUNCTIONS
	==============================
*/

function goa_theme_load_admin_scripts( $hook ) {
	
	if( 'toplevel_page_goa_theme' != $hook ){
		return;
	}
	
	wp_register_style( 'goa_theme_admin', get_template_directory_uri() . '/css/goa-theme.admin.css', array(), '1.0.0', 'all' );
	
	wp_register_script( 'goa_theme_admin-script', get_template_directory_uri() . '/js/goa-theme.admin.js', array(), '1.0.0', true );
	
	wp_enqueue_style( 'goa_theme_admin' );
	wp_enqueue_script( 'goa_theme_admin-script' );
	
	wp_enqueue_media();	
	
}
add_action( 'admin_enqueue_scripts', 'goa_theme_load_admin_scripts' );