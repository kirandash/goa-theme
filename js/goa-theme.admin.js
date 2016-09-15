jQuery(document).ready(function($) {
    
	var mediaUploader;
	
	$('#upload-button').on('click', function(e){

		e.preventDefault();
		
		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose a Profile Picture',
			button: {
				text: 'Choose Picture',
			},
			multiple: false
		});

		mediaUploader.on('select', function(){
			var attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#profile-picture').val(attachment.url);
			$('#profile-picture-preview').css('background-image','url('+attachment.url+')');
		});
		
		mediaUploader.open();
					
		if( mediaUploader ) {
			mediaUploader.open();
			return;
		}
		

		
	});
	
});