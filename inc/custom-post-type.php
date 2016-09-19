<?php

/*

@package goa-theme
	==============================
		THEME CUSTOM POST TYPE
	==============================
*/

$contact = get_option( 'activate_contact' );

if( $contact == 1 ){
	add_action( 'init', 'goa_theme_contact_custom_post_type' );
    // manage_yourpost/page/customposttype_posts_columns
    add_filter( 'manage_goa-contact_posts_columns', 'goa_theme_set_contact_columns' );
    // manage_yourpost/page/customposttype_posts_custom_column , this is a loop that goes through every post
    // 10 - action executes after everything is ready, 2 is the number of arguments to pass,default is 1
    add_action( 'manage_goa-contact_posts_custom_column', 'goa_theme_custom_contact_column', 10, 2 );
}

/* CONTACT CPT */
function goa_theme_contact_custom_post_type() {
	$labels = array(
		'name' 				=> 'Messages',
		'singular_name'		=> 'Message',
		'menu_name'			=> 'Messages',
		'name_admin_bar'	=> 'Message'
	);
	
	$args = array(
		'labels' 			=> $labels,
		'show_ui'			=> true,
		'show_in_menu'		=> true,
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'menu_position'		=> 26,
		'menu_icon'			=> 'dashicons-email-alt',
		'supports'			=> array('title', 'editor', 'author')
	);
	
	register_post_type( 'goa-contact', $args );
}

function goa_theme_set_contact_columns($columns) {
    // unset( $columns['author'] );
    $newColumns = array();
    $newColumns['title'] = 'Full Name';
    $newColumns['message'] = 'Message';
    $newColumns['email'] = 'Email';
    $newColumns['date'] = 'Date';
    return $newColumns;
}

function goa_theme_custom_contact_column( $column, $post_id ) {
    switch( $column ){
        case 'message':
            // message column
            echo get_the_excerpt();
            break;
            
        case 'email':
            // email column
            echo 'Email address';
            break;
            
    }
}