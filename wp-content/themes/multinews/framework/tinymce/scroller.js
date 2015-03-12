(function() {
    tinymce.create('tinymce.plugins.scroller', {
        init : function(ed, url) {
            ed.addButton('scroller', {
                title : 'Add Scroller',
                image : url+'/images/scroller.png',
                onclick : function() {
// triggers the thickscroller
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Add Scroller', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=scroller-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('scroller', tinymce.plugins.scroller);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="scroller-form">\
		<div class="mom_tiny_form">\
			<div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="scroller-style">Style</label>\
			    <span>choose between 2 scroller styles</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
		    <label class="mom_radio_img"><input type="radio" checked="checked" name="scroller-style" value="sc1"><img src="'+mom_url+'/framework/shortcodes/images/sc1.png"><i></i></label>\
		    <label class="mom_radio_img"><input type="radio" name="scroller-style" value="sc2"><img src="'+mom_url+'/framework/shortcodes/images/sc2.png"><i></i></label>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="scroller-title">Scroller Box title</label>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="scroller-title" id="scroller-title">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="scroller-title_size">Title Size</label>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="scroller-title_size">\
					<option value="17">Default</option>\
					<option value="30">Big size</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="scroller-sub_title">Scroller Box Sub title</label>\
			    <span>Leave it blank if you want to hide</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="scroller-sub_title" id="scroller-sub_title">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="scroller-display">Display</label>\
			    <span>get post from anywhere</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="scroller-display">\
					<option value="">Latest Posts</option>\
					<option value="cats">Category</option>\
					<option value="tags">tag</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element nb_cats hide">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="scroller-cats">Category</label>\
			    <span>select one or more</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="scroller-cats" name="scroller-cats">\
				    '+$cats+'\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element nb_tags hide">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="scroller-tags">Tag</label>\
			    <span>multiple tags separated by comma</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="scroller-tags" name="scroller-tags">\
				    '+$tags+'\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="scroller-orderby">Order By</label>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="scroller-orderby">\
					<option value="">Recent</option>\
					<option value="comment_count">Popular</option>\
					<option value="rand">Random</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="scroller-number_of_posts">Number Of posts</label>\
			    <span>number of post to show in the scroller box</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="scroller-number_of_posts" id="scroller-number_of_posts">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="scroller-auto_play">Autoplay</label>\
			    <span>Change to any integrer for example autoPlay : 5000 to play every 5 seconds. If you set autoPlay: true default speed will be 5 seconds. false to display</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="scroller-auto_play" id="scroller-auto_play">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="scroller-speed">Speed</label>\
			    <span>Slide speed in milliseconds Default : 300</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="scroller-speed" id="scroller-speed">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    </div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="scroller-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		$('.mom-color-field').wpColorPicker();
		
		$('input[name="scroller-style"]').click(function() {
		    var $nb = $('input[name="scroller-style"]:checked').val();
		    if ($nb === 'np') {
			$('.sub_cats').slideUp('fast');
		    } else {
			$('.sub_cats').slideDown(250);
		    }
		});

		$('#scroller-show_more').click(function() {
		    if (!this.checked) {
			$('.show_more_event').slideUp('fast');
		    } else {
			$('.show_more_event').slideDown(250);
		    }
		});

		$('#scroller-display').change( function() {
		    if($(this).val() === 'cats') {
			$('.nb_cats').slideDown(250);
			$('.nb_tags').slideUp('fast');
			$('.custom_scroller_title').slideUp('fast');
		    } else if ($(this).val() === 'tags') {
			$('.nb_tags').slideDown(250);
			$('.nb_cats').slideUp('fast');
			$('.custom_scroller_title').slideDown(250);
		    } else {
			$('.nb_tags').slideUp('fast');
			$('.nb_cats').slideUp('fast');
			$('.custom_scroller_title').slideDown(250);
		    }
		});


		    $("#scroller-form input[type=checkbox]").click(
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
		form.find('#scroller-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
                     var nbs = jQuery('input[name="scroller-style"]:checked').val();
		    
		    var nbsAttr = ' style="'+nbs+'"';
			
			var options = { 
				'title':'',
				'title_size':'',
				'sub_title':'',
				'display':'',
				'cats':'',
				'tags':'',
				'orderby':'',
				'number_of_posts':'',
				'auto_play':'',
				'speed':'',
		};
			var shortcode = '[scroller'+nbsAttr;
			
			for( var index in options) {
				var value = table.find('#scroller-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickscroller
			tb_remove();
		});
	});
})();
