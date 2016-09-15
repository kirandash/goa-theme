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
	
	wp_enqueue_style( 'goa_theme_admin' );
	
	
}
add_action( 'admin_enqueue_scripts', 'goa_theme_load_admin_scripts' );