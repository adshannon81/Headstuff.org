(function() {
    tinymce.create('tinymce.plugins.newspics', {
        init : function(ed, url) {
            ed.addButton('newspics', {
                title : 'Add a news picture box',
                image : url+'/images/images.png',
                onclick : function() {
// triggers the thicknewspics
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'News Picture', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=newspics-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('newspics', tinymce.plugins.newspics);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="newspics-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newspics-display">Display</label>\
			    <span>get post from anywhere</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="newspics-display">\
					<option value="">Latest Posts</option>\
					<option value="category">Category</option>\
					<option value="tag">tag</option>\
				    </select>\
				<div class="mom_color_wrap custom_newspics_title">\
				<div class="mom_color"><span>Title</span><input type="text" name="title" id="newspics-title" value=""></div>\
				</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element nb_cats hide">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newspics-cat">Category</label>\
			    <span>select one or more</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="newspics-cat" name="newspics-cat">\
				    '+$cats+'\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element nb_tags hide">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newspics-tag">Tag</label>\
			    <span>multiple tags separated by comma</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="newspics-tag" name="newspics-tag">\
				    '+$tags+'\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newspics-orderby">Order By</label>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="newspics-orderby">\
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
			    <label for="newspics-count">Number Of Picteurs</label>\
			    <span>number of pictures to show in the news pictures</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="newspics-count" id="newspics-count">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    </div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="newspics-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		$('.mom-color-field').wpColorPicker();
		
		$('input[name="newspics-style"]').click(function() {
		    var $nb = $('input[name="newspics-style"]:checked').val();
		    if ($nb === 'np') {
			$('.sub_cats').slideUp('fast');
		    } else {
			$('.sub_cats').slideDown(250);
		    }
		});

		$('#newspics-show_more').click(function() {
		    if (!this.checked) {
			$('.show_more_event').slideUp('fast');
		    } else {
			$('.show_more_event').slideDown(250);
		    }
		});

		$('#newspics-display').change( function() {
		    if($(this).val() === 'category') {
			$('.nb_cats').slideDown(250);
			$('.nb_tags').slideUp('fast');
			$('.custom_newspics_title').slideUp('fast');
		    } else if ($(this).val() === 'tag') {
			$('.nb_tags').slideDown(250);
			$('.nb_cats').slideUp('fast');
			$('.custom_newspics_title').slideDown(250);
		    } else {
			$('.nb_tags').slideUp('fast');
			$('.nb_cats').slideUp('fast');
			$('.custom_newspics_title').slideDown(250);
		    }
		});


		    $("#newspics-form input[type=checkbox]").click(
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
		form.find('#newspics-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
                    var nbs = jQuery('input[name="newspics-style"]:checked').val();
		    
		    var nbsAttr = '';
			
			var options = { 
				'display':'',
				'cat':'',
				'tag':'',
				'title':'',
				'orderby':'',
				'count':'',
		};
			var shortcode = '[newspic'+nbsAttr;
			
			for( var index in options) {
				var value = table.find('#newspics-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thicknewspics
			tb_remove();
		});
	});
})();
