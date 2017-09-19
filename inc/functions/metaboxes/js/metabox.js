jQuery(function($){
	
	if($("input[name='special_skin']").length){
		if(!$("input[name='special_skin']").is(':checked')) {
			if($('.metabox[data-name="skin"]').length){
				$('.metabox[data-name="skin"]').hide();
			}
		}
		$("input[name='special_skin']").change(function() {
			if(!this.checked) {
				if($('.metabox[data-name="skin"]').length){
					$('.metabox[data-name="skin"]').hide();
				}
			}else{
				if($('.metabox[data-name="skin"]').length){
					$('.metabox[data-name="skin"]').show();
				}
			}
		});
	}
	$('.list-color li').each(function() {
		var item = $(this),
			link = item.find('a').eq(0);

		link.on('click', function(e) {
			e.preventDefault();
			$('.list-color li').each(function(){
				$(this).removeClass('selected');
			});
			$('input[name="skin"]').val($(this).closest('li').data('name'));
			link.closest('li').addClass('selected');
		});
	});
	if($("input[name='show_header']").length){
		if($("input[name='show_header']").is(':checked')) {
			if($('.metabox[data-name="booty_header"]').length){
				$('.metabox[data-name="booty_header"]').hide();
			}
		}
		$("input[name='show_header']").change(function() {
			if(this.checked) {
				if($('.booty_header_layout').length){
					$('.booty_header_layout').hide();
				}
			}else{
				if($('.booty_header_layout').length){
					$('.booty_header_layout').show();
				}
			}
		});
	}
	if($("input[name='show_footer']").length){
		if($("input[name='show_footer']").is(':checked')) {
			if($('.booty_footer_layout').length){
				$('.booty_footer_layout').hide();
				$('.booty_footer_setting_wrapper').hide();
			}
		}
		$("input[name='show_footer']").change(function() {
			if(this.checked) {
				if($('.booty_footer_layout').length){
					$('.booty_footer_layout').hide();
					$('.booty_footer_setting_wrapper').hide();
				}
			}else{
				if($('.booty_footer_layout').length){
					$('.booty_footer_layout').show();
					$('.booty_footer_setting_wrapper').show();
				}
			}
		});
	}
	 /*Show select show or hide heading*/
     if ($('select[name="header_layout"]').val() == 'default'){
        $('.wrapselect-heading').hide('slow');
    }else{
        $('.wrapselect-heading').show('slow');
		$('.wrapselect-heading-type[data-show="'+ $('select[name="header_layout"]').val() +'"]').show('slow');
    }
    $('select[name="header_layout"]').change(function(){
        if($('select[name="header_layout"]').val()=='default'){
            $('.wrapselect-heading').hide('slow');
        }else{
            $('.wrapselect-heading').show('slow');
            $('.wrapselect-heading-type').hide('slow');
			$('.wrapselect-heading-type[data-show="'+ $('select[name="header_layout"]').val() +'"]').show('slow');
        }
    })
	/*Show option header*/
	if($("input.header_option").length){
		$("input.header_option").each(function(){
			if($(this).is(':checked')) {
				if($(this).parent('.wrapselect-heading-type').find('.wrapselect-option').length){
					$(this).parent('.wrapselect-heading-type').find('.wrapselect-option').show('slow');
				}
			}
		});
		$("input.header_option").change(function() {
			if(this.checked) {
				if($(this).parent('.wrapselect-heading-type').find('.wrapselect-option').length){
					$(this).parent('.wrapselect-heading-type').find('.wrapselect-option').show('slow');
				}
			}else{
				if($(this).parent('.wrapselect-heading-type').find('.wrapselect-option').length){
					$(this).parent('.wrapselect-heading-type').find('.wrapselect-option').hide('slow');
				}
			}
		});
	}
	/* Choose footer_layout */
    if($('.booty_footer_layout').length > 0){
        if($('select[name="footer_layout"]').val()=='default'){
            $('.booty_footer_setting_wrapper').hide('slow');
        }else{
            $('.booty_footer_setting_wrapper').show('slow');
        }
    }
    $('select[name="footer_layout"]').change(function() {
        if($('select[name="footer_layout"]').val()=='default'){
            $('.booty_footer_setting_wrapper').hide('slow');
        }else{
            $('.booty_footer_setting_wrapper').show('slow');
        }
    });
    if($('ul.booty_footer_tab').length > 0){
        if($('ul.booty_footer_tab li.active').length > 0){ 
            var footer_tab = $('ul.booty_footer_tab li.active').find('input[type="button"]').attr('class'); 
            $('.booty_footer_setting_wrapper').find('.booty_footer_wrapper').hide('slow');
            $('.booty_footer_setting_wrapper').find('.'+ footer_tab + '_wrapper').show('slow');
        }
    }
    $('ul.booty_footer_tab li input[type="button"]').click(function(){
        $(this).closest('ul').find('li').removeClass('active');
        $(this).closest('li').addClass('active');
        var footer_tab = $('ul.booty_footer_tab li.active').find('input[type="button"]').attr('class'); 
        $('.booty_footer_setting_wrapper').find('.booty_footer_wrapper').hide('slow');
        $('.booty_footer_setting_wrapper').find('.'+ footer_tab + '_wrapper').show('slow');
    }); 
    if($('.booty_select_show').length > 0){
        $('.booty_select_show').each(function(){
            if($(this).val() != 'show'){
                $(this).closest('.booty_footer_wrapper').find('.booty_select_show_ct').hide('slow');
            }else{
                $(this).closest('.booty_footer_wrapper').find('.booty_select_show_ct').show('slow');
            } 
        }); 
    }
    $('.booty_select_show').change(function() {
        if($(this).val() != 'show'){
            $(this).closest('.booty_footer_wrapper').find('.booty_select_show_ct').hide('slow');
        }else{
            $(this).closest('.booty_footer_wrapper').find('.booty_select_show_ct').show('slow');
        }
    }); 
    if($('.booty_footer_top_column').length > 0){
        var $_this=$(this);
        if($_this.find('select[name="booty_footer_top_column"]').val()==''){
            $_this.find('.booty_footer_top_ct').hide('slow');
            $_this.find('.booty_footer_top_ct:first-child').show('slow');
        }else{
            var $_this_val = $_this.find('select[name="booty_footer_top_column"]').val(); 
            $_this.find('.booty_footer_top_ct').hide('slow');
            $_this.find('.booty_footer_top_'+$_this_val).show('slow');
        }
    }
    $('select[name="booty_footer_top_column"]').change(function() { 
        var $_this_val = $(this).val(); 
        $(this).closest('.booty_footer_top_column').find('.booty_footer_top_ct').hide('slow');
        $(this).closest('.booty_footer_top_column').find('.booty_footer_top_'+$_this_val).show('slow'); 
    });
    
    if($('.booty_footer_center_column').length > 0){
        var $_this=$(this);
        if($_this.find('select[name="booty_footer_center_column"]').val()==''){ 
            $_this.find('.booty_footer_center_ct').hide('slow');
            $_this.find('.booty_footer_center_ct:first-child').show('slow');
        }else{ 
            var $_this_val = $_this.find('select[name="booty_footer_center_column"]').val();  
            $_this.find('.booty_footer_center_ct').hide('slow');
            $_this.find('.booty_footer_center_' + $_this_val).show('slow');
        }
    }
    $('select[name="booty_footer_center_column"]').change(function() { 
        var $_this_val = $(this).val(); 
        $(this).closest('.booty_footer_center_column').find('.booty_footer_center_ct').hide('slow');
        $(this).closest('.booty_footer_center_column').find('.booty_footer_center_'+$_this_val).show('slow'); 
    });
    
    if($('.booty_footer_bottom_column').length > 0){
        var $_this=$(this);
        if($_this.find('select[name="booty_footer_bottom_column"]').val()==''){ 
            $_this.find('.booty_footer_bottom_ct').hide('slow');
            $_this.find('.booty_footer_bottom_ct:first-child').show('slow');
        }else{ 
            var $_this_val = $_this.find('select[name="booty_footer_bottom_column"]').val();  
            $_this.find('.booty_footer_bottom_ct').hide('slow');
            $_this.find('.booty_footer_bottom_' + $_this_val).show('slow');
        }
    }
    $('select[name="booty_footer_bottom_column"]').change(function() { 
        var $_this_val = $(this).val(); 
        $(this).closest('.booty_footer_bottom_column').find('.booty_footer_bottom_ct').hide('slow');
        $(this).closest('.booty_footer_bottom_column').find('.booty_footer_bottom_'+$_this_val).show('slow'); 
    });
});