jQuery(document).ready(function($) {
    var file_frame;

    $('.additional-user-image').live('click', function(event){
        event.preventDefault();

        if (file_frame) {
            file_frame.open();
            return;
        }

        file_frame = wp.media.frames.file_frame = wp.media({
            title: $(this).data('uploader_title'),
            button: {
                text: $(this).data('uploader_button_text'),
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        file_frame.on('select', function() {
            attachment = file_frame.state().get('selection').first().toJSON();

            $('#pmg_simple_user_avatar').attr('value', attachment.url);
        });

        file_frame.open();
    });
});
