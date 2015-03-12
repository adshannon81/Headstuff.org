(function() {
    tinymce.create('tinymce.plugins.weathermap', {
        init : function(ed, url) {
            ed.addButton('weathermap', {
                title : 'Add a weather map',
                image : url+'/images/map2.png',
                onclick : function() {
// triggers the thickweathermap
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Insert Weather Map', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=weathermap-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('weathermap', tinymce.plugins.weathermap);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="weathermap-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="weathermap-width">Width</label>\
			    <span>Map width Def: 536</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="weathermap-width" id="weathermap-width">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="weathermap-height">Height</label>\
			    <span>Map height Def: 370</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="weathermap-height" id="weathermap-height">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="weathermap-city">City Name</label>\
			    <span>Enter City name to display in map</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="weathermap-city" id="weathermap-city">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="weathermap-zoom">Zoom</label>\
			    <span></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="weathermap-zoom" id="weathermap-zoom">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="weathermap-layer">Map Layer</label>\
			    <span></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="weathermap-layer">\
					<option value="rain">Rain</option>\
					<option value="clouds">Clouds</option>\
					<option value="precipitation">Precipitation</option>\
					<option value="pressure">Pressure</option>\
					<option value="wind">Wind</option>\
					<option value="temp">Temp</option>\
					<option value="snow">Snow</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="weathermap-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		$('.mom-color-field').wpColorPicker();


		    $("#weathermap-form input[type=checkbox]").click(
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
		form.find('#weathermap-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
            var nbs = jQuery('input[name="weathermap-type"]:checked').val();
			
			var options = { 
				'width':'',
				'height':'',
				'city':'',
				'zoom':'',
				'layer':'',
		};
			var shortcode = '[weather_map';
			
			for( var index in options) {
				var value = table.find('#weathermap-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickweathermap
			tb_remove();
		});
	});
})();
