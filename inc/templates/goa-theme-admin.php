<h1>Goa Theme Options</h1>
<?php settings_errors(); ?>
<?php
	$firstName = esc_attr( get_option( 'first_name' ) );
	$lastName = esc_attr( get_option( 'last_name' ) );
	$fullName = $firstName . ' ' . $lastName;
	$description = esc_attr( get_option( 'user_description' ) );
?>
<div class="goa-theme-sidebar-preview">
	<div class="goa-theme-sidebar">
    	<h1 class="goa-theme-username"><?php print $fullName; ?></h1>
        <h2 class="goa-theme-description"><?php print $description; ?></h2>
        <div class="icons-wrapper">
        	
        </div>
    </div>
</div>

<form method="post" action="options.php" class="goa-theme-general-form">
	<?php settings_fields( 'goa-theme-settings-group' ); ?>
    <?php do_settings_sections( 'goa_theme' ); ?>
    <?php submit_button(); ?>
</form>