<?php

/*

@package goa-theme
	==============================
		THEME SUPPORT OPTIONS
	==============================
*/

$options = get_option( 'post_formats' );
$formats = array( 'aside', 'gallery', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
$output = array();
foreach( $formats as $format ) {
	$output[] = (  isset($options[$format]) && $options[$format] == 1 ? $format : '' );
}
if( !empty($options) ){
	add_theme_support( 'post-formats', $output );
}

$header = get_option('custom_header');
if($header==1){
	add_theme_support('custom-header');
}	

$background = get_option('custom_background');
if($background==1){
	add_theme_support('custom-background');
}	