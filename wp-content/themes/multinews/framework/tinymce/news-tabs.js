(function() {
    tinymce.create('tinymce.plugins.ntabs', {
        init : function(ed, url) {
            ed.addButton('ntabs', {
                title : 'Insert News Tabs',
                image : url+'/images/ntabs.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Insert News Tabs', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ntabs-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('ntabs', tinymce.plugins.ntabs);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="ntabs-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="ntab-style">Style</label>\
			    <span>grid or list</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				    <select id="ntab-style">\
					<option value="grid">Grid</option>\
					<option value="list">List</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="ntab-columns">columns</label>\
			    <span>grid or list</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				    <select id="ntab-columns">\
					<option value="2">Two columns</option>\
					<option value="3">Three columns</option>\
					<option value="4">Four columns</option>\
					<option value="5">Five columns</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="ntab-switcher">Switcher</label>\
			    <span>grid or list</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				    <select id="ntab-switcher">\
					<option value="no">No</option>\
					<option value="yes">Yes</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_ntab_wrap">\
		    <a href="#" class="add_ntab" id="add_ntab">+</a>\
		    <div class="mom_ntab_sc">\
			<ul class="mom_ntabs">\
			    <li class="ntab_title" data-href="#ntab0"><div class="ntab_sort_handle"></div><input type="text" id="ntab-title" placeholder="Title" value=""><input class="ntab-icon invisible" value=""><a class="remove_ntab fa-icon-remove" href="#"></a></li>\
			    <li class="ntab_title" data-href="#ntab1"><div class="ntab_sort_handle"></div><input type="text" id="ntab-title" placeholder="Title" value=""><input class="ntab-icon invisible" value=""><a class="remove_ntab fa-icon-remove" href="#"></a></li>\
			    <li class="ntab_title" data-href="#ntab2"><div class="ntab_sort_handle"></div><input type="text" id="ntab-title" placeholder="Title" value=""><input class="ntab-icon invisible" value=""><a class="remove_ntab fa-icon-remove" href="#"></a></li>\
			</ul>\
			<div class="ntab_panes">\
    			<div class="ntab_content clear" id="ntab0">\
				    <div class="ntab_element">\
				    <label for="">Display</label>\
				    <select id="ntab-display">\
					<option value="">Latest Posts</option>\
					<option value="cat">Category</option>\
					<option value="tag">Tag</option>\
				    </select>\
				    </div><!-- ntab element -->\
				    <div class="ntab_element ntb_cats hide">\
				    <label for="ntab-cat">Category</label>\
				    <select id="ntab-cat" name="ntab-cat">\
					    '+$cats+'\
				    </select>\
				    </div><!-- ntab element -->\
				    <div class="ntab_element ntb_tags hide">\
				    <label for="ntab-tag">Tag</label>\
				    <select id="ntab-tag" name="ntab-tag">\
					    '+$tags+'\
				    </select>\
				    </div><!-- ntab element -->\
				    <div class="ntab_element">\
				    <label for="">Order By</label>\
				    <select id="ntab-orderby">\
					<option value="">Recent</option>\
					<option value="popular">Popular</option>\
					<option value="random">Random</option>\
				    </select>\
				    </div><!-- ntab element -->\
				    <div class="ntab_element ntab_ex">\
				    <label for="ntab-cats">Exclude categories</label>\
				    <input type="text" id="ntab-cats">\
				    </div><!-- ntab element -->\
				    <div class="ntab_element">\
				    <label for="">Number Of posts</label>\
				    <input type="text" id="ntab-count">\
				    </div><!-- ntab element -->\
			</div>\
    			<div class="ntab_content clear" id="ntab1">\
				    <div class="ntab_element">\
				    <label for="">Display</label>\
				    <select id="ntab-display">\
					<option value="">Latest Posts</option>\
					<option value="cat">Category</option>\
					<option value="tag">Tag</option>\
				    </select>\
				    </div><!-- ntab element -->\
				    <div class="ntab_element ntb_cats hide">\
				    <label for="ntab-cat">Category</label>\
				    <select id="ntab-cat" name="ntab-cat">\
					    '+$cats+'\
				    </select>\
				    </div><!-- ntab element -->\
				    <div class="ntab_element ntb_tags hide">\
				    <label for="ntab-tag">Tag</label>\
				    <select id="ntab-tag" name="ntab-tag">\
					    '+$tags+'\
				    </select>\
				    </div><!-- ntab element -->\
				    <div class="ntab_element">\
				    <label for="">Order By</label>\
				    <select id="ntab-orderby">\
					<option value="">Recent</option>\
					<option value="popular">Popular</option>\
					<option value="random">Random</option>\
				    </select>\
				    </div><!-- ntab element -->\
				    <div class="ntab_element ntab_ex">\
				    <label for="ntab-cats">Exclude categories</label>\
				    <input type="text" id="ntab-cats">\
				    </div><!-- ntab element -->\
				    <div class="ntab_element">\
				    <label for="">Number Of posts</label>\
				    <input type="text" id="ntab-count">\
				    </div><!-- ntab element -->\
			</div>\
    			<div class="ntab_content clear" id="ntab2">\
				    <div class="ntab_element">\
				    <label for="">Display</label>\
				    <select id="ntab-display">\
					<option value="">Latest Posts</option>\
					<option value="cat">Category</option>\
					<option value="tag">Tag</option>\
				    </select>\
				    </div><!-- ntab element -->\
				    <div class="ntab_element ntb_cats hide">\
				    <label for="ntab-cat">Category</label>\
				    <select id="ntab-cat" name="ntab-cat">\
					    '+$cats+'\
				    </select>\
				    </div><!-- ntab element -->\
				    <div class="ntab_element ntb_tags hide">\
				    <label for="ntab-tag">Tag</label>\
				    <select id="ntab-tag" name="ntab-tag">\
					    '+$tags+'\
				    </select>\
				    </div><!-- ntab element -->\
				    <div class="ntab_element">\
				    <label for="">Order By</label>\
				    <select id="ntab-orderby">\
					<option value="">Recent</option>\
					<option value="popular">Popular</option>\
					<option value="random">Random</option>\
				    </select>\
				    </div><!-- ntab element -->\
				    <div class="ntab_element ntab_ex">\
				    <label for="ntab-cats">Exclude categories</label>\
				    <input type="text" id="ntab-cats">\
				    </div><!-- ntab element -->\
				    <div class="ntab_element">\
				    <label for="">Number Of posts</label>\
				    <input type="text" id="ntab-count">\
				    </div><!-- ntab element -->\
			</div>\
			</div>\
		    </div> <!-- end ntab -->\
		    </div>\
		<div class="mom_submit_form">\
			<input type="button" id="ntab-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var ntable = form.find('.mom_tiny_form');
		form.appendTo('body').hide();

		var count = 2;
		jQuery('#add_ntab').live('click', function(){
		    count += 1;
		    $('.mom_ntab_sc .ntab_title:first').clone().addClass('new_ntab_title').appendTo('ul.mom_ntabs');
		    $('.new_ntab_title:last').find('input').val('');
		    $('.new_ntab_title:last').attr('data-href', '#ntab'+count);
		    $('.mom_ntab_sc .ntab_title').removeClass('ntab_active');
		    $('.new_ntab_title:last').addClass('ntab_active');
		    $('.ntab_panes .ntab_content:first').clone().addClass('new_ntab_content').appendTo('.ntab_panes');
		    $('.new_ntab_content:last').find('textarea').val('');
		    $('.new_ntab_content:last').attr('id', 'ntab'+count);
		    $('.ntab_panes .ntab_content').hide();
		    $('.new_ntab_content:last').show();
		    $('.new_ntab_content').find('.ntb_cats').hide();
		    $('.new_ntab_content').find('.ntb_tags').hide();
		    
		 $('.ntab_content').each(function() {
		    var t = $(this);
		    var display = $(this).find('#ntab-display');
		    display.on('change', function() {
			if($(this).val() === 'cat') {
			    t.find('.ntb_cats').slideDown(250);
			    t.find('.ntb_tags').slideUp('fast');
			     t.find('.ntab_ex').slideUp('fast');
			} else if ($(this).val() === 'tag') {
			    t.find('.ntb_tags').slideDown(250);
			    t.find('.ntb_cats').slideUp('fast');
			     t.find('.ntab_ex').slideUp('fast');
			} else {
			    t.find('.ntb_tags').slideUp('fast');
			    t.find('.ntb_cats').slideUp('fast');
			    t.find('.ntab_ex').slideDown(250);
			}
		    });
		});
                    return false;
               });
                jQuery('.remove_ntab').live('click', function() {
                    if(jQuery('.ntab_title').size() == 1) {
                        alert('Sorry, you need at least one element');
                    }
                    else {
                        jQuery(this).parent().slideUp(300, function() {
                            jQuery(this).remove();
                        })
			var rcontent = $(this).parent().attr('data-href');
			$(rcontent).remove();
			$('.mom_ntab_sc .ntab_title').removeClass('ntab_active');
			$('.ntab_panes .ntab_content').hide();
			$('.mom_ntab_sc .ntab_title:first').addClass('ntab_active');
			$('.ntab_panes .ntab_content:first').show();

                    }
                    return false;
                });
		
//ntab it
    $('.mom_ntab_sc .ntab_title:first').addClass('ntab_active');
    $('.ntab_panes .ntab_content').hide();
    $('.ntab_panes .ntab_content:first').show();
    $('.mom_ntab_sc .ntab_title').live('click', function () {
       $('.mom_ntab_sc .ntab_title').removeClass('ntab_active');
       $(this).addClass('ntab_active');
       var currentConten = $(this).attr('data-href');
	$('.ntab_panes .ntab_content').hide();
	$(currentConten).fadeIn();
    });
    // sort accordions
    $( ".mom_ntabs" ).sortable({
	handle : '.ntab_sort_handle'
    });

		jQuery('.mom-color-field').wpColorPicker();

		$('.ntab_content').each(function() {
		    var t = $(this);
		    var display = $(this).find('#ntab-display');
		    display.on('change', function() {
			if($(this).val() === 'cat') {
			    t.find('.ntb_cats').slideDown(250);
			    t.find('.ntb_tags').slideUp('fast');
			     t.find('.ntab_ex').slideUp('fast');
			} else if ($(this).val() === 'tag') {
			    t.find('.ntb_tags').slideDown(250);
			    t.find('.ntb_cats').slideUp('fast');
			    t.find('.ntab_ex').slideUp('fast');
			} else {
			    t.find('.ntb_tags').slideUp('fast');
			    t.find('.ntb_cats').slideUp('fast');
			    t.find('.ntab_ex').slideDown(250);
			}
		    });
		});

		// handles the click event of the submit button
		form.find('#ntab-submit').click(function(){
			//output
			var style = $('#ntab-style').val();
			var switcher = $('#ntab-switcher').val();
			var columns = $('#ntab-columns').val();
		    output = '[news_tabs style="'+style+'" switcher="'+switcher+'" columns="'+columns+'"]<br />';

                jQuery('.mom_ntab_sc .ntab_title').each(function() {
                    var title = jQuery(this).find('#ntab-title').val();
		    var tcontent = $(this).attr('data-href');
		    var display = $(tcontent +' #ntab-display').val();
		    var cat = '';
		    var tag = '';
		    var orderby = $(tcontent +' #ntab-orderby').val();
		    var cats = '';
		    var count = $(tcontent +' #ntab-count').val();
		    if (display === 'cat') {
			cat = ' cat="'+$(tcontent +' #ntab-cat').val()+'"';
		    }
		    if (display === 'tag') {
			tag = ' tag="'+$(tcontent +' #ntab-tag').val()+'"';
		    }
		    var dis = ' display="'+display+'"';
		    var orderby = ' orderby="'+orderby+'"';
		    var cats = ' cats="'+cats+'"';
		    var count = ' count="'+count+'"';
                    output += ' [news_tab title="'+title+'"'+dis+orderby+count+cat+tag+cats+']<br />';
                });
                output += ' [/news_tabs] ';
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, output);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
