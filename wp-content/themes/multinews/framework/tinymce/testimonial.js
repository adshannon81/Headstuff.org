(function() {
    tinymce.create('tinymce.plugins.testimonial', {
        init : function(ed, url) {
            ed.addButton('testimonial', {
                title : 'Add a testimonial',
                image : url+'/images/testim.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height()-50, W = ( 720 < width ) ? 720: width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Testimonial', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=testimonial-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('testimonial', tinymce.plugins.testimonial);
    
    // executes this when the DOM is ready
	jQuery(function($){
	    var tsrc = mom_url+'/images/testimonial.png';
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="testimonial-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="testimonial-image">Image</label>\
			    <span>the person image 50px * 50px, leave it empty in you want</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<div class="mom_custom_media_upload no_border" style="padding-top:0;">\
			<a class="mom_upload_media mom_tiny_button upload_testimonial_img" href="#">Person Image</a>\
			<img class="mom_custom_icon_prev" src="'+mom_url+'/framework/shortcodes/images/custom_img.png" alt="">\
			<input type="text" id="testimonial-image" value="" style="visibility: hidden;" />\
		    </div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="testimonial-name">Name</label>\
			    <span>Person Name</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
		 <input id="testimonial-name" value="John Doe" type="text">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="testimonial-title">Title</label>\
			    <span>Person job title</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
		 <input id="testimonial-title" value="Designer" type="text">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="testimonial-content">Content</label>\
			    <span>testimonial content</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
		 <textarea id="testimonial-content">He promptly completed the task at hand and communicates really well till the project reaches the finishing line. I was pleased with his creative design and will definitely be hiring him again. </textarea>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label>Custom Style</label>\
			    <span>you can Customize everything</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				<div class="mom_color_wrap" style="margin-top:0;">\
				<div class="mom_color"><span>Font Style</span><select name="font_style" id="testimonial-font_style">\
					<option value="">Italic</option>\
					<option value="normal">Normal</option>\
				</select></div>\
				<div class="mom_color"><span>Font Size</span><input type="text" id="testimonial-font_size" name="font_size" class="custom_input" ></div>\
				<div class="mom_color"><span>Background Color</span><input type="text" class="mom-color-field" id="testimonial-background" value=""></div>\
				<div class="mom_color"><span>Text Color</span><input type="text" class="mom-color-field" id="testimonial-color" value=""></div>\
				<div class="mom_color"><span>Border Color</span><input type="text" class="mom-color-field" id="testimonial-border" value=""></div>\
				<div class="mom_color"><span>Image Border Color</span><input type="text" class="mom-color-field" id="testimonial-img_border" value=""></div>\
				<div class="mom_color"><span>Name Color</span><input type="text" class="mom-color-field" id="testimonial-name_color" value=""></div>\
				<div class="mom_color"><span>Title Color</span><input type="text" class="mom-color-field" id="testimonial-title_color" value=""></div>\
				</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="testimonial-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');

		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		jQuery('.mom-color-field').wpColorPicker();
// Media Upload
	var file_frame;
	var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
	var set_to_post_id = post_id; // Set this
	$('.upload_testimonial_img').live('click', function( event ){
	    var $this = $(this);
	event.preventDefault();
	if ( file_frame ) {
	file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
	file_frame.open();
	return;
	} else {
	wp.media.model.settings.post.id = set_to_post_id;
	}
	file_frame = wp.media.frames.file_frame = wp.media({
	title: jQuery( this ).data( 'uploader_title' ),
	button: {
	text: jQuery( this ).data( 'uploader_button_text' ),
	},
	multiple: false
	});
	 
	file_frame.on( 'select', function() {
	attachment = file_frame.state().get('selection').first().toJSON();
	
	    table.find('#testimonial-image').val(attachment.url);
	    $this.next('img').attr({src: attachment.url});
	
	wp.media.model.settings.post.id = wp_media_post_id;
	});
	file_frame.open();
	});
	jQuery('.upload_testimonial_img').on('click', function() {
	wp.media.model.settings.post.id = wp_media_post_id;
	});

		// handles the click event of the submit button
		form.find('#testimonial-submit').click(function(){
			//output
		var options = {
			    'image':'',
			    'name':'',
			    'title':'',
			    'background':'',
			    'border':'',
			    'img_border':'',
			    'color':'',
			    'name_color':'',
			    'title_color':'',
			    'font_size':'',
			    'font_style':'',
		};
			var shortcode = '[testimonial';
			
			for( var index in options) {
				var value = table.find('#testimonial-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']' +table.find('#testimonial-content').val()+'[/testimonial]';
			

              //  output += ' [/testimonials] ';
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
                });
	});
})();
