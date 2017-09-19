(function($){
    "use strict";
    var post_metabox = {
        initialized: false,
        container: null,
        child_box: null,
        post_type_select: null,
        selected_post_type: null,
        imgSelectFrame: null,
        imgPreviews: null,

        init: function() {
            if ( this.initialized ) return;
            this.initialized = true;
            this.container = $('#post-metabox');
            this.child_box = $('.post-metabox-child');
            this.post_type_select = $('input[name="post_format"]');
            this.selected_post_type = $('input[name="post_format"]:checked');
            this.imgPreviews = $('#post-metabox ul.images-list').first();

            if ( ! this.container.length || ! this.child_box.length || ! this.post_type_select.length
                || ! this.selected_post_type.length || ! this.imgPreviews ) return;

            this.metabox_switches();
            this.metabox_gallery();
            this.video_upload();
            this.audio_upload();
            this.image_upload();
        },

        //-- Switch between formats
        metabox_switches: function() {
            var self = this;
            self.post_type_select.on('change', function(e){
                self.switch_box($(this).val());
            });
        },

        //-- Proceed switches
        switch_box: function(value) {
            var self = this;
            switch(value) {
                case 'gallery':
                    self.container.fadeIn(300)
                        .find('[data-post-format="gallery"]').fadeIn(300).siblings().hide();
                    break;
                case 'image':
                    self.container.fadeIn(300)
                        .find('[data-post-format="image"]').fadeIn(300).siblings().hide();
                    break;
                case 'link':
                    self.container.fadeIn(300)
                        .find('[data-post-format="link"]').fadeIn(300).siblings().hide();
                    break;
                case 'quote':
                    self.container.fadeIn(300)
                        .find('[data-post-format="quote"]').fadeIn(300).siblings().hide();
                    break;
                case 'video':
                    self.container.fadeIn(300)
                        .find('[data-post-format="video"]').fadeIn(300).siblings().hide();
                    break;
                case 'audio':
                    self.container.fadeIn(300)
                        .find('[data-post-format="audio"]').fadeIn(300).siblings().hide();
                    break;

                default:
                    self.container.hide();
                    break;
            }
        },

        //-- Manage image gallery
        metabox_gallery: function() {
            var self = this;

            $('#post-metabox').on('click', 'a.button.add-images', function(e){
                e.preventDefault();
                var _imgPreviews = $(this).closest('.post-metabox-child').find('ul.images-list');
                var _postformat = $(this).closest('.post-metabox-child').attr('data-post-format');
                if ( self.imgSelectFrame ) self.imgSelectFrame.close();

                self.imgSelectFrame = wp.media.frames.imgSelectFrame = wp.media({
                    title: $(this).data('uploader-title'),
                    button: {
                        text: $(this).data('uploader-button-text'),
                    },
                    multiple: true
                });

                self.imgSelectFrame.on('select', function() {
                    var listIndex = _imgPreviews.children('li:last').index(),
                        selection = self.imgSelectFrame.state().get('selection');

                    selection.map(function(attachment, i) {
                        attachment = attachment.toJSON();

                        if ( 'undefined' == typeof attachment.sizes ) {
                            alert( "Not supported type" );
                            return;
                        }
                        var index                   = listIndex + (i + 1),
                            attachmentThumbnailObj  = attachment.sizes.thumbnail;

                        if ( attachmentThumbnailObj == undefined ) {
                            attachmentThumbnailObj = attachment.sizes.full;
                        }
                        if(_postformat == 'gallery'){
                            _imgPreviews.append('<li>'
                                + '<input type="hidden" name="post_gallery_id[' + index + ']" value="' + attachment.id + '"/>'
                                + '<img class="image-preview" src="' + attachmentThumbnailObj.url + '"/>'
                                + '<a class="change-image" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image"><i class="dashicons dashicons-edit"></i></a>'
                                + '<a class="remove-image" href="#"><i class="dashicons dashicons-no"></i></a>'
                            + '</li>');
                        }else if(_postformat == 'image'){
                            _imgPreviews.append('<li>'
                                + '<input type="hidden" name="post_image_id[' + index + ']" value="' + attachment.id + '"/>'
                                + '<img class="image-preview" src="' + attachmentThumbnailObj.url + '"/>'
                                + '<a class="change-image" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image"><i class="dashicons dashicons-edit"></i></a>'
                                + '<a class="remove-image" href="#"><i class="dashicons dashicons-no"></i></a>'
                            + '</li>');
                        }
                    });
                });

                self.make_sortable();

                self.imgSelectFrame.open();
            });


            $('#post-metabox').on('click', 'a.change-image', function(e) {
                e.preventDefault();

                var _this = $(this);

                if ( self.imgSelectFrame ) self.imgSelectFrame.close();

                self.imgSelectFrame = wp.media.frames.imgSelectFrame = wp.media({
                    title: $(this).data('uploader-title'),
                    button: {
                        text: $(this).data('uploader-button-text'),
                    },
                    multiple: false
                });

                self.imgSelectFrame.on( 'select', function() {
                    var attachment              = self.imgSelectFrame.state().get('selection').first().toJSON(),
                        attachmentThumbnailObj  = attachment.sizes.thumbnail;

                    if ( attachmentThumbnailObj == undefined ) {
                        attachmentThumbnailObj = attachment.sizes.full;
                    }

                    var selection = self.imgSelectFrame.state().get('selection');

                    _this.parent().find('input:hidden').attr('value', attachment.id);
                    _this.parent().find('img.image-preview').attr('src', attachmentThumbnailObj.url);
                });

                self.imgSelectFrame.on( 'open', function(){
                    var selected = wp.media.attachment( _this.parent().find('input:hidden').attr('value') );
                    var selection = self.imgSelectFrame.state().get('selection');
                    selection.add( selected ? [selected] : [] );
                });

                self.imgSelectFrame.open();

            });

            $('#post-metabox').on('click', 'a.remove-image', function(e) {
                e.preventDefault();

                $(this).parents('li').animate({ opacity: 0 }, 200, function() {
                    $(this).remove();
                    self.reset_index();
                });
            });

        },

        //-- Reset index after sort
        reset_index: function() {
            this.imgPreviews.children('li').each(function(i) {
                $(this).find('input:hidden').attr('name', 'post_gallery_id[' + i + ']');
            });
        },

        //-- Make image gallery sortable
        make_sortable: function() {
            this.imgPreviews.sortable({
                opacity: 0.6,
                stop: function() {
                    self.reset_index();
                }
            });
        },

        //-- Video upload
        video_upload: function() {
            var self = this;
            $('#post-metabox').on('click', 'a.button.add-video', function(e){
                e.preventDefault();

                var _this = $(this);

                if ( self.imgSelectFrame ) self.imgSelectFrame.close();

                self.imgSelectFrame = wp.media.frames.imgSelectFrame = wp.media({
                    title: $(this).data('uploader-title'),
                    button: {
                        text: $(this).data('uploader-button-text'),
                    },
                    multiple: false
                });

                self.imgSelectFrame.on( 'select', function() {
                    var attachment  = self.imgSelectFrame.state().get('selection').first().toJSON(),
                        ext         = attachment.filename.substr(attachment.filename.lastIndexOf('.')+1);

                    console.log(ext);
                    //var arr = ["mp3","m4a","ogg","wav"];
                    var arr = ["mp4","m4v","webm","ogv","wmv","flv"];
                    if ($.inArray(ext,arr)!= 0){
                        alert( "Not supported type" );
                        return;
                    }
                    if ( 'undefined' != typeof attachment.sizes ) {
                        alert( "Not supported type" );
                        return;
                    }

                    var selection = self.imgSelectFrame.state().get('selection');

                    _this.closest('.post-metabox-child').find('input[name="post_video_url"]').val(attachment.url);
                });

                self.imgSelectFrame.on( 'open', function(){
                    var selected = wp.media.attachment( _this.parent().find('input:hidden').attr('value') );
                    var selection = self.imgSelectFrame.state().get('selection');
                    selection.add( selected ? [selected] : [] );
                });

                self.imgSelectFrame.open();
            });
        },
        //-- Video upload
        audio_upload: function() {
            var self = this;
            $('#post-metabox').on('click', 'a.button.add-audio', function(e){
                e.preventDefault();

                var _this = $(this);

                if ( self.imgSelectFrame ) self.imgSelectFrame.close();

                self.imgSelectFrame = wp.media.frames.imgSelectFrame = wp.media({
                    title: $(this).data('uploader-title'),
                    button: {
                        text: $(this).data('uploader-button-text'),
                    },
                    multiple: false
                });

                self.imgSelectFrame.on( 'select', function() {
                    var attachment  = self.imgSelectFrame.state().get('selection').first().toJSON(),
                        ext         = attachment.filename.substr(attachment.filename.lastIndexOf('.')+1);

                    console.log(ext);
                    var arr = ["mp3","m4a","ogg","wav"];
                    //var arr = ["mp4","m4v","mov","wmv","avi","mpg","ogv","3gp","3g2"];
                    if ($.inArray(ext,arr)!= 0){
                        alert( "Not supported type" );
                        return;
                    }
                    if ( 'undefined' != typeof attachment.sizes ) {
                        alert( "Not supported type" );
                        return;
                    }

                    var selection = self.imgSelectFrame.state().get('selection');

                    _this.closest('.post-metabox-child').find('input[name="post_audio_url"]').val(attachment.url);
                });

                self.imgSelectFrame.on( 'open', function(){
                    var selected = wp.media.attachment( _this.parent().find('input:hidden').attr('value') );
                    var selection = self.imgSelectFrame.state().get('selection');
                    selection.add( selected ? [selected] : [] );
                });

                self.imgSelectFrame.open();
            });
        },


        //-- Image upload
        image_upload: function() {

        }
    };

    $(document).ready(function(){
        post_metabox.init();
        post_metabox.switch_box(post_metabox.selected_post_type.val());
        post_metabox.make_sortable();
    });
})(jQuery);