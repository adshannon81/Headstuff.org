(function() {
    tinymce.create('tinymce.plugins.weathercharts', {
        init : function(ed, url) {
            ed.addButton('weathercharts', {
                title : 'Add weather charts',
                image : url+'/images/weather.png',
                onclick : function() {
// triggers the thickweathercharts
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Insert Weather Charts', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=weathercharts-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('weathercharts', tinymce.plugins.weathercharts);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="weathercharts-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="weathercharts-width">Width</label>\
			    <span>Map width Def: 536</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="weathercharts-width" id="weathercharts-width">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="weathercharts-height">Height</label>\
			    <span>Map height Def: 370</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="weathercharts-height" id="weathercharts-height">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="weathercharts-city">City Name</label>\
			    <span>Enter City name to display in map</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="weathercharts-city" id="weathercharts-city">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="weathercharts-units">Unit</label>\
			    <span></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="weathercharts-units">\
					<option value="metric">Metric</option>\
					<option value="imperial">Imperial</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="weathercharts-type">Type</label>\
			    <span></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="weathercharts-type">\
					<option value="daily">Daily</option>\
					<option value="hourly">Hourly</option>\
				    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="weathercharts-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		$('.mom-color-field').wpColorPicker();


		    $("#weathercharts-form input[type=checkbox]").click(
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
		form.find('#weathercharts-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
            var nbs = jQuery('input[name="weathercharts-type"]:checked').val();
			
			var options = { 
				'width':'',
				'height':'',
				'city':'',
				'units':'',
				'type':'',
		};
			var shortcode = '[weather_chart';
			
			for( var index in options) {
				var value = table.find('#weathercharts-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickweathercharts
			tb_remove();
		});
	});
})();
