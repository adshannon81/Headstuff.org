(function() {
    tinymce.create('tinymce.plugins.blog_posts', {
        init : function(ed, url) {
            ed.addButton('blog_posts', {
                title : 'Add a blog posts',
                image : url+'/images/bloga.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height()-50, W = ( 720 < width ) ? 720: width;
						W = W - 80;
						H = H - 84;
						tb_show( 'blog posts', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=blog_posts-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('blog_posts', tinymce.plugins.blog_posts);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="blog_posts-form">\
				<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog_posts-style">Style</label>\
			    <span>2 Awesome blog styles</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
		    	<select id="blog_posts-style">\
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
			    <label for="blog_posts-display">Display</label>\
			    <span>get post from anywhere</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="blog_posts-display">\
					<option value="">Latest Posts</option>\
					<option value="category">Category/s</option>\
					<option value="tag">tag/s</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element plg_cats hide">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog_posts-category">Category/s</label>\
			    <span>select one or more</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="blog_posts-category" name="blog_posts-category" multiple>\
				    '+$cats+'\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element plg_tags hide">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog_posts-tag">Tag/s</label>\
			    <span>multiple tags separated by comma</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="blog_posts-tag" id="blog_posts-tag">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="blog_posts-posts_per_page">Posts Per Page</label>\
			    <span>number of post to show per page</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="blog_posts-posts_per_page" id="blog_posts-posts_per_page">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="blog_posts-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');

		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		$('#blog_posts-type').change( function() {
		    if($(this).val() === 'grid') {
			$('.blog_list_style').slideUp('fast');
		    } else {
			$('.blog_list_style').slideDown(250);
		    }
		});
		
		$('#blog_posts-display').change( function() {
		    if($(this).val() === 'category') {
			$('.plg_cats').slideDown(250);
			$('.plg_tags').slideUp('fast');
		    } else if ($(this).val() === 'tag') {
			$('.plg_tags').slideDown(250);
			$('.plg_cats').slideUp('fast');
		    } else {
			$('.plg_tags').slideUp('fast');
			$('.plg_cats').slideUp('fast');
		    }
		});

		// handles the click event of the submit button
		form.find('#blog_posts-submit').click(function(){
			//output
		    	var options = {
				'display':'',
				'category': '',
				'tag': '',
				'posts_per_page': '',
		};
		    		var $style = jQuery('#blog_posts-style').val();
		    		var $nbsAttr = ' style="'+$style+'"';
                    output = ' [blog_list'+$nbsAttr;
		    			for( var index in options) {
				var value = table.find('#blog_posts-' + index).val();
				
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
