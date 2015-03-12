(function() {
    tinymce.create('tinymce.plugins.testimonial_slider', {
        init : function(ed, url) {
            ed.addButton('testimonial_slider', {
                title : 'Add a testimonials slider',
                image : url+'/images/testim_slider.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height()-50, W = ( 720 < width ) ? 720: width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Testimonials Slider', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=testimonial_slider-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('testimonial_slider', tinymce.plugins.testimonial_slider);
    
    // executes this when the DOM is ready
	jQuery(function($){
	    var tsrc = mom_url+'/images/testimonial_slider.png';
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="testimonial_slider-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="testimonial_slider-title">Title</label>\
			    <span>Testimonial Slider title</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
		 <input id="testimonial_slider-title" value="What Clients Say" type="text">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="testimonial_slider-title">Sliding Effect</label>\
			    <span>Testimonial Slider effects</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="testimonial_slider-effect">\
				    <option value="none">none</option>\
					<option value="all">all</option>\
					<option value="blindX">blindX</option>\
					<option value="blindY">blindY</option>\
					<option value="blindZ">blindZ</option>\
					<option value="cover">cover</option>\
					<option value="curtainX">curtainX</option>\
					<option value="curtainY">curtainY</option>\
					<option value="fade">fade</option>\
					<option value="fadeZoom">fadeZoom</option>\
					<option value="growX">growX</option>\
					<option value="growY">growY</option>\
					<option value="scrollUp">scrollUp</option>\
					<option value="scrollDown">scrollDown</option>\
					<option value="scrollLeft">scrollLeft</option>\
					<option value="scrollRight">scrollRight</option>\
					<option value="scrollHorz">scrollHorz</option>\
					<option value="scrollVert">scrollVert</option>\
					<option value="shuffle">shuffle</option>\
					<option value="slideX">slideX</option>\
					<option value="slideY">slideY</option>\
					<option value="toss">toss</option>\
					<option value="turnUp">turnUp</option>\
					<option value="turnDown">turnDown</option>\
					<option value="turnLeft">turnLeft</option>\
					<option value="turnRight">turnRight</option>\
					<option value="uncover">uncover</option>\
					<option value="wipe">wipe</option>\
					<option value="zoom">zoom</option>\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="testimonial_slider-auto_duration">Slideshow Duration</label>\
			    <span>auto slideshow time in ms default is 1000</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<input id="testimonial_slider-auto_duration" value="" type="text">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="testimonial_slider-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');

		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();

		// handles the click event of the submit button
		form.find('#testimonial_slider-submit').click(function(){
		var options = {
			    'title':'',
			    'effect':'',
			    'auto_duration' : ''
		};
			if($('#testimonial_slider-auto_slide').is(':checked')) {
			    auto_slide = ' auto_slide="true"';

			} else {
			    auto_slide = '';   
			}
		
                    output = '[testimonial_slider';
		    			for( var index in options) {
				var value = table.find('#testimonial_slider-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					output += ' ' + index + '="' + value + '"';
			}
			output += auto_slide+']<br>INSERT TESTIMONIALS HERE<br>[/testimonial_slider] ';
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, output);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
