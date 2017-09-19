(function($){
    "use strict";
    var page_metabox = {
        initialized: false,  
        imgSelectFrame: null, 

        init: function() {
            if ( this.initialized ) return;
            this.initialized = true;   
            this.image_upload();
        },
        //-- Manage image gallery
        image_upload: function() {
            var self = this;

            $('.aht_image_upload').on('click', 'a.button.add-images', function(e){
                e.preventDefault();
				var _imgPreviews = $(this).closest('.aht_image_upload').find('.aht_image'); 
				var _imgID = $(this).closest('.aht_image_upload').find('input.aht_img_upload'); 
                if ( self.imgSelectFrame ) self.imgSelectFrame.close();
                
                self.imgSelectFrame = wp.media.frames.imgSelectFrame = wp.media({
                    title: $(this).data('uploader-title'),
                    button: {
                        text: $(this).data('uploader-button-text'),
                    },
                    multiple: false
                });

                self.imgSelectFrame.on('select', function() {
                    var selection = self.imgSelectFrame.state().get('selection');

                    selection.map(function(attachment, i) {
                        attachment = attachment.toJSON();
                        if ( 'undefined' == typeof attachment.sizes ) {
                            alert( "Not supported type" );
                            return;
                        }
                        var attachmentThumbnailObj  = attachment.sizes.thumbnail;

                        if ( attachmentThumbnailObj == undefined ) {
                            attachmentThumbnailObj = attachment.sizes.full;
                        }
						_imgID.val(attachment.id);
						_imgPreviews.html('<img class="image-preview" src="' + attachmentThumbnailObj.url + '"/><a class="remove-image" href="#"><i class="dashicons dashicons-no"></i></a>');
					});
                });
 
                self.imgSelectFrame.open();
            });



            $('.aht_image_upload').on('click', 'a.remove-image', function(e) {
                e.preventDefault();
				var _imgPreviews = $(this).closest('.aht_image_upload').find('.aht_image'); 
				var _imgID = $(this).closest('.aht_image_upload').find('input.aht_img_upload'); 
                _imgPreviews.html('');
                _imgID.val('');
            });

        },

    };
    $(document).ready(function(){
        page_metabox.init(); 
		if($('.color-picker').length){
			$('.color-picker').iris({
				width: 250,
				hide: true,
				change: function(event, ui) {
					$(this).find('input').css( 'background', ui.color.toString());
					$(this).find('input').val(ui.color.toString());
				},
				palettes: true
			});
			$('.color-picker').click(function() {
				 $(this).find('.iris-picker').show();
					$(this).find('.iris-picker').toggleClass('show');
			});
		}
    });
})(jQuery);