<h1>Goa Theme Support</h1>
<?php settings_errors(); ?>
<?php
	//$picture = esc_attr( get_option( 'profile_picture' ) );
?>


<form method="post" action="options.php" class="goa-theme-general-form">
	<?php settings_fields( 'goa-theme-support' ); ?>
    <?php do_settings_sections( 'goa_theme_support' ); ?>
    <?php submit_button(); ?>
</form>