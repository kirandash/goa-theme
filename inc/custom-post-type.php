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
    add_action( 'add_meta_boxes', 'goa_theme_contact_add_meta_box' );
    add_action( 'save_post', 'goa_theme_save_contact_email_data' );
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
            $email = get_post_meta( $post_id, '_contact_email_value_key', true );
            echo '<a href="mailto:'.$email.'">'.$email.'</a>';
            break;
            
    }
}

/* CONTACT META BOXES */
function goa_theme_contact_add_meta_box() {
    add_meta_box( 'contact_email', 'User Email', 'goa_theme_contact_email_callback', 'goa-contact', 'side', 'default' );
}

function goa_theme_contact_email_callback( $post ) {
    // generate the nonce
    wp_nonce_field( 'goa_theme_save_contact_email_data', 'goa_theme_contact_email_meta_box_nonce' );
    
    // retrieve the saved value
    $value = get_post_meta( $post->ID, '_contact_email_value_key', true );
    
    // actual input of the meta box
    echo '<label for="goa_theme_contact_email_field">User Email Address: </label>';
    echo '<input type="email" id="goa_theme_contact_email_field" name="goa_theme_contact_email_field" value="'.esc_attr($value).'" size="25" />';
}

function goa_theme_save_contact_email_data( $post_id ) {
    if( ! isset( $_POST['goa_theme_contact_email_meta_box_nonce'] ) ) {
        return;
    }
    if( ! wp_verify_nonce( $_POST['goa_theme_contact_email_meta_box_nonce'], 'goa_theme_save_contact_email_data' ) ) {
        return;
    }
    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return;
        // remove this if you want the meta box also to autosave. better to not
    }
    if( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if( ! isset( $_POST['goa_theme_contact_email_field'] ) ) {
        return;
    }
    $my_data = sanitize_text_field( $_POST['goa_theme_contact_email_field'] );
    
    update_post_meta( $post_id, '_contact_email_value_key', $my_data );
}