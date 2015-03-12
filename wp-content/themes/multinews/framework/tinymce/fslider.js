(function() {
    tinymce.create('tinymce.plugins.fsliders', {
        init : function(ed, url) {
            ed.addButton('fsliders', {
                title : 'Add featured slider',
                image : url+'/images/fslider.png',
                onclick : function() {
// triggers the thickfsliders
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Insert featured slider', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=fsliders-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('fsliders', tinymce.plugins.fsliders);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="fsliders-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="fsliders-type">Slider</label>\
			    <span>choose between 3 fsliders</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
		    <label class="mom_radio_img"><input type="radio" checked="checked" name="fsliders-type" value="def"><img src="'+mom_url+'/framework/shortcodes/images/slider1.png"><i></i></label>\
		    <label class="mom_radio_img"><input type="radio" name="fsliders-type" value="slider2"><img src="'+mom_url+'/framework/shortcodes/images/slider2.png"><i></i></label>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="fsliders-display">Display</label>\
			    <span>get post from anywhere</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="fsliders-display">\
					<option value="latest">Latest Posts</option>\
					<option value="cat">Category</option>\
					<option value="tag">Tag</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element nb_cats hide">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="fsliders-cats">Category</label>\
			    <span>select one or more</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="fsliders-cats" name="fsliders-cats">\
				    '+$cats+'\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element nb_tags hide">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="fsliders-tag">Tag</label>\
			    <span>multiple tags separated by comma</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="fsliders-tag" name="fsliders-tag">\
				    '+$tags+'\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="fsliders-orderby">Order By</label>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="fsliders-orderby">\
					<option value="">Recent</option>\
					<option value="comment_count">Popular</option>\
					<option value="rand">Random</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element num-posts">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="fsliders-number_of_posts">Number Of posts</label>\
			    <span>number of post to show in the slider not work for all sliders style</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="fsliders-number_of_posts" id="fsliders-number_of_posts">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element animation">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="fsliders-animation">Animation</label>\
			    <span>Select slider animation</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="fsliders-animation">\
			    	<option value""></option>\
					<option value="fade">Fade</option>\
					<option value="slid">Slide</option>\
					<option value="flip">Flip</option>\
					<option value="custom">Custom Animation</option>\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element animation animation_custom hide">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="fsliders-animationout">Animation Out</label>\
			    <span>slider item out animation</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="fsliders-animationout">\
			    <option value""></option>\
				<option value"bounceOut">bounceOut</option>\
				<option value"bounceOutDown">bounceOutDown</option>\
				<option value"bounceOutLeft">bounceOutLeft</option>\
				<option value"bounceOutRight">bounceOutRight</option>\
				<option value"bounceOutUp">bounceOutUp</option>\
				<option value"fadeOut">fadeOut</option>\
				<option value"fadeOutDown">fadeOutDown</option>\
				<option value"fadeOutDownBig">fadeOutDownBig</option>\
				<option value"fadeOutLeft">fadeOutLeft</option>\
				<option value"fadeOutLeftBig">fadeOutLeftBig</option>\
				<option value"fadeOutRight">fadeOutRight</option>\
				<option value"fadeOutRightBig">fadeOutRightBig</option>\
				<option value"fadeOutUp">fadeOutUp</option>\
				<option value"fadeOutUpBig">fadeOutUpBig</option>\
				<option value"flip">flip</option>\
				<option value"flipOutX">flipOutX</option>\
				<option value"flipOutY">flipOutY</option>\
				<option value"lightSpeedOut">lightSpeedOut</option>\
				<option value"rotateOut">rotateOut</option>\
				<option value"rotateOutDownLeft">rotateOutDownLeft</option>\
				<option value"rotateOutDownRight">rotateOutDownRight</option>\
				<option value"rotateOutUpLeft">rotateOutUpLeft</option>\
				<option value"rotateOutUpRight">rotateOutUpRight</option>\
				<option value"slideOutDown">slideOutDown</option>\
				<option value"slideOutLeft">slideOutLeft</option>\
				<option value"slideOutRight">slideOutRight</option>\
				<option value"rollOut">rollOut</option>\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element animation animation_custom hide">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="fsliders-animationin">Animation In</label>\
			    <span>slider item in animation</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="fsliders-animationin">\
			    	<option value""></option>\
				    <option value="bounce">bounce</option>\
				    <option value="flash">flash</option>\
				    <option value="pulse">pulse</option>\
				    <option value="rubberBand">rubberBand</option>\
				    <option value="shake">shake</option>\
				    <option value="swing">swing</option>\
				    <option value="tada">tada</option>\
				    <option value="wobble">wobble</option>\
				    <option value="bounceIn">bounceIn</option>\
				    <option value="bounceInDown">bounceInDown</option>\
				    <option value="bounceInLeft">bounceInLeft</option>\
				    <option value="bounceInRight">bounceInRight</option>\
				    <option value="bounceInUp">bounceInUp</option>\
				    <option value="fadeIn">fadeIn</option>\
				    <option value="fadeInDown">fadeInDown</option>\
				    <option value="fadeInDownBig">fadeInDownBig</option>\
				    <option value="fadeInLeft">fadeInLeft</option>\
				    <option value="fadeInLeftBig">fadeInLeftBig</option>\
				    <option value="fadeInRight">fadeInRight</option>\
				    <option value="fadeInRightBig">fadeInRightBig</option>\
				    <option value="fadeInUp">fadeInUp</option>\
				    <option value="fadeInUpBig">fadeInUpBig</option>\
				    <option value="flip">flip</option>\
				    <option value="flipInX">flipInX</option>\
				    <option value="flipInY">flipInY</option>\
				    <option value="lightSpeedIn">lightSpeedIn</option>\
				    <option value="rotateIn">rotateIn</option>\
				    <option value="rotateInDownLeft">rotateInDownLeft</option>\
				    <option value="rotateInDownRight">rotateInDownRight</option>\
				    <option value="rotateInUpLeft">rotateInUpLeft</option>\
				    <option value="rotateInUpRight">rotateInUpRight</option>\
				    <option value="slideInDown">slideInDown</option>\
				    <option value="slideInLeft">slideInLeft</option>\
				    <option value="slideInRight">slideInRight</option>\
				    <option value="rollIn">rollIn</option>\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element speed">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="fsliders-autoplay">Autoplay</label>\
			    <span></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="fsliders-autoplay">\
					<option value="yes">Yes</option>\
					<option value="no">No</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element speed">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="fsliders-timeout">Timeout</label>\
			    <span>the time between each slide with ms, default : 5000</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="fsliders-timeout" id="fsliders-timeout">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element caption">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="fsliders-cap">Caption</label>\
			    <span></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="fsliders-cap">\
			    	<option value""></option>\
					<option value="yes">Yes</option>\
					<option value="no">No</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element exc">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="fsliders-exc">Excerpt</label>\
			    <span>excerpt length leave it empty to disappear default: 150</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="fsliders-exc" id="fsliders-exc">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="fsliders-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		$('.mom-color-field').wpColorPicker();
		
		$('input[name="fsliders-type"]').click(function() {
		    var $nb = $('input[name="fsliders-type"]:checked').val();
		    if ($nb === 'slider2') {
			$('.num-posts').slideUp('fast');
			$('.animation').slideUp('fast');
			$('.speed').slideUp('fast');
		    } else if ($nb === 'video') {
		    $('.num-posts').slideDown(250);
		    $('.caption').slideUp('fast');
		    $('.exc').slideUp('fast');
			$('.animation').slideUp('fast');
			$('.speed').slideUp('fast');
		    } else {
		    $('.num-posts').slideDown(250);
			$('.animation').slideDown(250);
			$('.speed').slideDown(250);
		    }
		});
		
		$('#fsliders-animation').change( function() {
		    if($(this).val() === 'custom') {
			$('.animation_custom').slideDown(250);
		    } else {
			$('.animation_custom').slideUp('fast');
		    }
		});

		$('#fsliders-show_more').click(function() {
		    if (!this.checked) {
			$('.show_more_event').slideUp('fast');
		    } else {
			$('.show_more_event').slideDown(250);
		    }
		});

		$('#fsliders-display').change( function() {
		    if($(this).val() === 'cat') {
			$('.nb_cats').slideDown(250);
			$('.nb_tags').slideUp('fast');
			$('.custom_fsliders_title').slideUp('fast');
		    } else if ($(this).val() === 'tag') {
			$('.nb_tags').slideDown(250);
			$('.nb_cats').slideUp('fast');
			$('.custom_fsliders_title').slideDown(250);
		    } else {
			$('.nb_tags').slideUp('fast');
			$('.nb_cats').slideUp('fast');
			$('.custom_fsliders_title').slideDown(250);
		    }
		});


		    $("#fsliders-form input[type=checkbox]").click(
			function() {
			    var attr = $(this).attr('checked');
		    if (typeof attr !== 'undefined' && attr !== false) {
			        $(this).attr({
					     checked: 'checked',
					     value: 'yes'
					     });
		    } else {
				$(this).removeAttr('checked');
 				$(this).attr('value', '');
		    }
			} 
		    );
		
		// handles the click event of the submit button
		form.find('#fsliders-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
            var nbs = jQuery('input[name="fsliders-type"]:checked').val();
		    
		    var nbsAttr = ' type="'+nbs+'"';
			
			var options = { 
				'display':'',
				'cats':'',
				'tag':'',
				'orderby':'',
				'number_of_posts':'',
				'animation':'',
				'animationin':'',
				'animationout':'',
				'timeout':'',
				'cap':'',
				'exc':'',
		};
			var shortcode = '[feature_slider'+nbsAttr;
			
			for( var index in options) {
				var value = table.find('#fsliders-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickfsliders
			tb_remove();
		});
	});
})();
