<?php

/*

@package goa-theme
	==============================
		ADMIN PAGE
	==============================
*/

function goa_theme_add_admin_page() {

	add_menu_page( 'Goa Theme Options', 'Goa Theme', 'manage_options', 'goa-theme-options', 'goa_theme_create_page', get_template_directory_uri() . '/img/goa-theme-icon.png', 110 );
	
}
add_action( 'admin_menu','goa_theme_add_admin_page' );

function goa_theme_create_page() {
	//generation of our admin page
}

