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
	add_submenu_page( 'goa_theme', 'Goa Theme Sidebar Options', 'Sidebar', 'manage_options', 'goa_theme', 'goa_theme_create_page' );
	add_submenu_page( 'goa_theme', 'Goa Theme Options', 'Theme Options', 'manage_options', 'goa_theme_support', 'goa_theme_support_page' );
	add_submenu_page( 'goa_theme', 'Goa Theme Contact Form', 'Contact Form', 'manage_options', 'goa_theme_contact', 'goa_theme_contact_form_page' );
	add_submenu_page( 'goa_theme', 'Goa Theme CSS Options', 'Custom CSS', 'manage_options', 'goa_theme_css', 'goa_theme_settings_page' );
	
	// Activate custom settings
	add_action('admin_init','goa_theme_custom_settings');
	
}
add_action( 'admin_menu','goa_theme_add_admin_page' );

function goa_theme_custom_settings() {
	// Sidebar Options
	register_setting( 'goa-theme-settings-group', 'profile_picture' );
	register_setting( 'goa-theme-settings-group', 'first_name' );
	register_setting( 'goa-theme-settings-group', 'last_name' );
	register_setting( 'goa-theme-settings-group', 'user_description' );
	register_setting( 'goa-theme-settings-group', 'twitter_handler', 'goat_theme_sanitize_twitter_handler' );
	register_setting( 'goa-theme-settings-group', 'facebook_handler' );
	register_setting( 'goa-theme-settings-group', 'gplus_handler' );
	
	add_settings_section( 'goa-theme-sidebar-options', 'Sidebar Options', 'goa_theme_sidebar_options', 'goa_theme' );
	
	add_settings_field( 'sidebar-profile-picture', 'Profile Picture', 'goa_theme_sidebar_profile', 'goa_theme', 'goa-theme-sidebar-options' );
	add_settings_field( 'sidebar-name', 'Full Name', 'goa_theme_sidebar_name', 'goa_theme', 'goa-theme-sidebar-options' );
	add_settings_field( 'sidebar-description', 'Description', 'goa_theme_sidebar_description', 'goa_theme', 'goa-theme-sidebar-options' );
	add_settings_field( 'sidebar-twitter', 'Twitter Handler', 'goa_theme_sidebar_twitter', 'goa_theme', 'goa-theme-sidebar-options' );
	add_settings_field( 'sidebar-facebook', 'Facebook Handler', 'goa_theme_sidebar_facebook', 'goa_theme', 'goa-theme-sidebar-options' );
	add_settings_field( 'sidebar-gplus', 'Google+ Handler', 'goa_theme_sidebar_gplus', 'goa_theme', 'goa-theme-sidebar-options' );
	
	// Theme Support Options
	register_setting( 'goa-theme-support', 'post_formats', 'goa_theme_post_formats_callback' );
	register_setting( 'goa-theme-support', 'custom_header' );
	register_setting( 'goa-theme-support', 'custom_background' );
	
	add_settings_section( 'goa-theme-support-options', 'Support Options', 'goa_theme_support_options', 'goa_theme_support' );
	
	add_settings_field( 'post-formats', 'Post Formats', 'goa_theme_post_formats', 'goa_theme_support', 'goa-theme-support-options' );
	add_settings_field( 'custom-header', 'Custom Header', 'goa_theme_custom_header', 'goa_theme_support', 'goa-theme-support-options' );
	add_settings_field( 'custom-background', 'Custom Background', 'goa_theme_custom_background', 'goa_theme_support', 'goa-theme-support-options' );
	
	// Contact Form Options
	register_setting( 'goa-theme-contact-options', 'activate_contact' );
	
	add_settings_section( 'goa-theme-contact-section', 'Contact Form', 'goa_theme_contact_section', 'goa_theme_contact' );
	add_settings_field( 'activate-form', 'Activate Contact Form', 'goa_theme_activate_contact', 'goa_theme_contact', 'goa-theme-contact-section' );
}

// Post Formats Callback Function
function goa_theme_post_formats_callback( $input ) {
	return $input;
}

function goa_theme_support_options() {
	echo 'Activate and Deactivate specific Theme Support Options';
}

function goa_theme_contact_section() {
	echo 'Activate and Deactivate the built in contact form';
}

function goa_theme_post_formats() {
	$options = get_option( 'post_formats' );
	$formats = array( 'aside', 'gallery', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
	$output = '';
	foreach( $formats as $format ) {
		$checked = (  isset($options[$format]) && $options[$format] == 1 ? 'checked' : '' );
		$output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.'>'.$format.'</label><br>';
	}
	echo $output;
}

function goa_theme_activate_contact() {
	$options = get_option( 'activate_contact' );
	$checked = ( $options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="activate_contact" name="activate_contact" value="1" '.$checked.'></label>';
}

function goa_theme_custom_header() {
	$options = get_option( 'custom_header' );
	$checked = ( $options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.'>Activate the Custom Header</label>';
}

function goa_theme_custom_background() {
	$options = get_option( 'custom_background' );
	$checked = ( $options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.'>Activate the Custom Background</label>';
}

// Sidebar Options Functions
function goa_theme_sidebar_options() {
	echo 'Cutsomize your sidebar Information';
}

function goa_theme_sidebar_profile() {
	$picture = esc_attr( get_option( 'profile_picture' ) );
	
	if(empty($picture)){
		echo '<input type="button" class="button button-secondary" id="upload-button" value="Upload Profile Picture"/><input type="hidden" id="profile-picture" name="profile_picture">';
	}else{
		echo '<input type="button" class="button button-secondary" id="upload-button" value="Change Profile Picture" /><input type="hidden" id="profile-picture" name="profile_picture" value="'.$picture.'"> <input type="button" class="button button-secondary" id="remove-picture" value="Remove">';
	}
	
}

function goa_theme_sidebar_name() {
	$firstName = esc_attr( get_option( 'first_name' ) );
	$lastName = esc_attr( get_option( 'last_name' ) );
	
	echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name"> <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name">';
}

function goa_theme_sidebar_description() {
	$description = esc_attr( get_option( 'user_description' ) );
	
	echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description"><p class="write something smart.</p>"';
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

// Template submenu functions
function goa_theme_create_page() {
	// generation of our admin page
	require_once( get_template_directory() . '/inc/templates/goa-theme-admin.php');
}

function goa_theme_support_page() {
	// generation of our admin page
	require_once( get_template_directory() . '/inc/templates/goa-theme-support.php');
}

function goa_theme_contact_form_page() {
	// generation of our contact page
	require_once( get_template_directory() . '/inc/templates/goa-theme-contact-form.php');
}

function goa_theme_settings_page() {
	// generation of our admin page
	echo '<h1>Goa Custom CSS</h1>';
}