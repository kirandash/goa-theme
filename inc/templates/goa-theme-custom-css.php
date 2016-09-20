<h1>Goa Custom CSS</h1>
<?php settings_errors(); ?>

<form id="save-custom-css-form" method="post" action="options.php" class="goa-theme-general-form">
	<?php settings_fields( 'goa-theme-custom-css-options' ); ?>
    <?php do_settings_sections( 'goa_theme_custom_css_page' ); ?>
    <?php submit_button(); ?>
</form>