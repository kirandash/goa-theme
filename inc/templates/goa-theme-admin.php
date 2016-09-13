<h1>Goa Theme Options</h1>
<?php settings_errors(); ?>
<form method="post" action="options.php">
	<?php settings_fields( 'goa-theme-settings-group' ); ?>
    <?php do_settings_sections( 'goa_theme' ); ?>
    <?php submit_button(); ?>
</form>