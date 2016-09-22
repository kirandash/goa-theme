<?php

/*

@package goa-theme
	==============================
		ADMIN ENQUEUE FUNCTIONS
	==============================
*/

function goa_theme_load_admin_scripts( $hook ) {
	//echo $hook;
	if( 'toplevel_page_goa_theme' == $hook ){
	
        wp_register_style( 'goa_theme_admin', get_template_directory_uri() . '/css/goa-theme.admin.css', array(), '1.0.0', 'all' );

        wp_register_script( 'goa_theme_admin-script', get_template_directory_uri() . '/js/goa-theme.admin.js', array(), '1.0.0', true );

        wp_enqueue_style( 'goa_theme_admin' );
        wp_enqueue_script( 'goa_theme_admin-script' );

        wp_enqueue_media();	
        
    }elseif( 'goa-theme_page_goa_theme_css' == $hook ){
        
        wp_enqueue_style( 'ace', get_template_directory_uri() . '/css/goa-theme.ace.css', array(), '1.0.0', 'all' );
        
        wp_enqueue_script( 'ace', get_template_directory_uri() . '/js/ace/src/ace.js', array('jquery'), '1.2.5', true );
        wp_enqueue_script( 'goa-thme-custom-css-script', get_template_directory_uri() . '/js/goa_theme.custom_css.js', array('jquery'), '1.0.0', true );
        
    }else{
        
        return;
        
    }
	
}

add_action( 'admin_enqueue_scripts', 'goa_theme_load_admin_scripts' );

/*
	==============================
		FRONT-END ENQUEUE FUNCTIONS
	==============================
*/

function goa_theme_load_scripts(){
    
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7', 'all' );
    wp_enqueue_style( 'goa-theme', get_template_directory_uri() . '/css/goa-theme.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'raleway', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' );
    
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', false, '1.11.3', true );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.7', true );
    
}

add_action( 'wp_enqueue_scripts', 'goa_theme_load_scripts' );