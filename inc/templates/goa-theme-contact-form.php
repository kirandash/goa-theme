<h1>Goa Contact Form</h1>
<?php settings_errors(); ?>

<form method="post" action="options.php" class="goa-theme-general-form">
	<?php settings_fields( 'goa-theme-contact-options' ); ?>
    <?php do_settings_sections( 'goa_theme_contact' ); ?>
    <?php submit_button(); ?>
</form>