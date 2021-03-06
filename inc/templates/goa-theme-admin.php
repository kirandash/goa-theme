<h1>Goa Theme Sidebar Options</h1>
<?php settings_errors(); ?>
<?php
	$picture = esc_attr( get_option( 'profile_picture' ) );
	$firstName = esc_attr( get_option( 'first_name' ) );
	$lastName = esc_attr( get_option( 'last_name' ) );
	$fullName = $firstName . ' ' . $lastName;
	$description = esc_attr( get_option( 'user_description' ) );
?>
<div class="goa-theme-sidebar-preview">
	<div class="goa-theme-sidebar">
    	<div class="image-container">
        	<div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print($picture); ?>); "></div>
        </div>
        <h1 class="goa-theme-username"><?php print $fullName; ?></h1>
        <h2 class="goa-theme-description"><?php print $description; ?></h2>
        <div class="icons-wrapper">
        	
        </div>
    </div>
</div>

<form method="post" action="options.php" class="goa-theme-general-form">
	<?php settings_fields( 'goa-theme-settings-group' ); ?>
    <?php do_settings_sections( 'goa_theme' ); ?>
    <?php submit_button( 'Save Changes', 'primary', 'btnSubmit' ); // To avoid js submit conflict ?>
</form>