(function() {
    tinymce.create('tinymce.plugins.newsbox', {
        init : function(ed, url) {
            ed.addButton('newsbox', {
                title : 'Add a newsbox',
                image : url+'/images/blog-posts.png',
                onclick : function() {
// triggers the thicknewsbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'News Boxes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=newsbox-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('newsbox', tinymce.plugins.newsbox);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="newsbox-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-style">Style</label>\
			    <span>choose between 7 news box styles</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
		    <label class="mom_radio_img"><input type="radio" checked="checked" name="newsbox-style" value="nb1"><img src="'+mom_url+'/framework/shortcodes/images/nb1.png"><i></i></label>\
		    <label class="mom_radio_img"><input type="radio" name="newsbox-style" value="nb2"><img src="'+mom_url+'/framework/shortcodes/images/nb2.png"><i></i></label>\
		    <label class="mom_radio_img"><input type="radio" name="newsbox-style" value="nb3"><img src="'+mom_url+'/framework/shortcodes/images/nb3.png"><i></i></label>\
		    <label class="mom_radio_img"><input type="radio" name="newsbox-style" value="nb4"><img src="'+mom_url+'/framework/shortcodes/images/nb4.png"><i></i></label>\
		    <label class="mom_radio_img"><input type="radio" name="newsbox-style" value="nb5"><img src="'+mom_url+'/framework/shortcodes/images/nb5.png"><i></i></label>\
		    <label class="mom_radio_img"><input type="radio" name="newsbox-style" value="nb6"><img src="'+mom_url+'/framework/shortcodes/images/nb6.png"><i></i></label>\
		    <label class="mom_radio_img"><input type="radio" name="newsbox-style" value="list"><img src="'+mom_url+'/framework/shortcodes/images/list.png"><i></i></label>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-title">Custom title</label>\
			    <span>Custom News box title</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="newsbox-title" id="newsbox-title">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-display">Display</label>\
			    <span>get post from anywhere</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="newsbox-display">\
					<option value="">Latest Posts</option>\
					<option value="category">Category</option>\
					<option value="tag">tag</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element nb_cats hide">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-cat">Category</label>\
			    <span>select one or more</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="newsbox-cat" name="newsbox-cat">\
				    '+$cats+'\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element nb_tags hide">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-tag">Tag</label>\
			    <span>multiple tags separated by comma</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="newsbox-tag" name="newsbox-tag">\
				    '+$tags+'\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-orderby">Order By</label>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="newsbox-orderby">\
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
			    <label for="newsbox-number_of_posts">Number Of posts</label>\
			    <span>number of post to show in the news box not work for all news boxes style</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="newsbox-number_of_posts" id="newsbox-number_of_posts">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-nb_excerpt">excerpt length</label>\
			    <span>post excerpt length in characters leave empty for default values</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="newsbox-nb_excerpt" id="newsbox-nb_excerpt">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element sub_cats">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-sub_categories">Sub Categories</label>\
			    <span>enable sub categories as tabs on top of each news box</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <div class="ch_switch"><input id="newsbox-sub_categories" type="checkbox" value=""><label><i></i></label></div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-show_more">Show More Button</label>\
			    <span>enable show more button as tabs on bottom of each news box</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <div class="ch_switch"><input id="newsbox-show_more" checked="checked" type="checkbox" value="yes"><label><i></i></label></div>\
				<div class="mom_color_wrap show_more_event">\
				<div class="mom_color"><span>On Click</span><select name="show_more_event" id="newsbox-show_more_event">\
					<option value="">Category/tag page</option>\
					<option value="ajax">More posts with Ajax</option>\
				</select></div>\
				</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="newsbox-post_type">Custom post type</label>\
			    <span>Advanced: you can use this option to get posts from custom post types, if you set this to anything the category and tags options not working</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="newsbox-post_type" id="newsbox-post_type">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="newsbox-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		$('.mom-color-field').wpColorPicker();
		
		$('input[name="newsbox-style"]').click(function() {
		    var $nb = $('input[name="newsbox-style"]:checked').val();
		    if ($nb === 'np') {
			$('.sub_cats').slideUp('fast');
		    } else {
			$('.sub_cats').slideDown(250);
		    }
		});

		$('#newsbox-show_more').click(function() {
		    if (!this.checked) {
			$('.show_more_event').slideUp('fast');
		    } else {
			$('.show_more_event').slideDown(250);
		    }
		});

		$('#newsbox-display').change( function() {
		    if($(this).val() === 'category') {
			$('.nb_cats').slideDown(250);
			$('.nb_tags').slideUp('fast');
		    } else if ($(this).val() === 'tag') {
			$('.nb_tags').slideDown(250);
			$('.nb_cats').slideUp('fast');
		    } else {
			$('.nb_tags').slideUp('fast');
			$('.nb_cats').slideUp('fast');
		    }
		});


		    $("#newsbox-form input[type=checkbox]").click(
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
		form.find('#newsbox-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
                    var nbs = jQuery('input[name="newsbox-style"]:checked').val();
		    
		    var nbsAttr = ' style="'+nbs+'"';
			
			var options = { 
				'display':'',
				'cat':'',
				'tag':'',
				'orderby':'',
				'title':'',
				'number_of_posts':'',
				'nb_excerpt':'',
				'sub_categories':'',
				'show_more':'',
				'show_more_event':'',
				'post_type':'',
		};
			var shortcode = '[newsbox'+nbsAttr;
			
			for( var index in options) {
				var value = table.find('#newsbox-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thicknewsbox
			tb_remove();
		});
	});
})();
