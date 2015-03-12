(function() {
    tinymce.create('tinymce.plugins.blog', {
        init : function(ed, url) {
            ed.addButton('blog', {
                title : 'Add a blog',
                image : url+'/images/blog.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height()-50, W = ( 720 < width ) ? 720: width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Blog', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=blog-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('blog', tinymce.plugins.blog);
    
    // executes this when the DOM is ready
	jQuery(function($){
	    var tsrc = mom_url+'/images/blog.png';
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="blog-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog-style">Style</label>\
			    <span>2 Awesome blog styles</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="blog-style">\
					<option value="def">Default</option>\
					<option value="large">large</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog-display">Display</label>\
			    <span>get post from anywhere</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="blog-display">\
					<option value="">Latest Posts</option>\
					<option value="category">Category/s</option>\
					<option value="tag">tag/s</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element bp_cats hide">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog-category">Category/s</label>\
			    <span>select one or more</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="blog-category" name="blog-category" multiple>\
				    '+$cats+'\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element bp_tags hide">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog-tag">Tag/s</label>\
			    <span>multiple tags separated by comma</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="blog-tag" id="blog-tag">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog-posts_per_page">Posts Per Page</label>\
			    <span>number of post to show per page</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="blog-posts_per_page" id="blog-posts_per_page">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog-offset">Offset posts</label>\
			    <span>number of post to displace or pass over</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="blog-offset" id="blog-offset">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog-pagination">Pagination</label>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="blog-pagination" id="blog-pagination">\
					<option value="">Yes</option>\
					<option value="no">No</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="blog-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');

		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		$('#blog-display').change( function() {
		    if($(this).val() === 'category') {
			$('.bp_cats').slideDown(250);
			$('.bp_tags').slideUp('fast');
		    } else if ($(this).val() === 'tag') {
			$('.bp_tags').slideDown(250);
			$('.bp_cats').slideUp('fast');
		    } else {
			$('.bp_tags').slideUp('fast');
			$('.bp_cats').slideUp('fast');
		    }
		});

		// handles the click event of the submit button
		form.find('#blog-submit').click(function(){
			//output
		    	var options = {
				'style':'',
				'display':'',
				'category': null,
				'tag': '',
				'offset': '',
				'posts_per_page': '',
				'pagination': '',
		};

                    output = ' [blog';
		    			for( var index in options) {
				var value = table.find('#blog-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					output += ' ' + index + '="' + value + '"';
			}
			output += ']'

			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, output);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
