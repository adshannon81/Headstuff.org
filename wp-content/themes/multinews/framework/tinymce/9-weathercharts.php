<?php 

 add_action('init', 'add_button_weathercharts');
 
 function add_button_weathercharts() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_weathercharts');
     add_filter('mce_buttons_3', 'register_button_weathercharts');
   }
}

function register_button_weathercharts($buttons) {
   array_push($buttons, "weathercharts");
   return $buttons;
}

function add_plugin_weathercharts($plugin_array) {
   $plugin_array['weathercharts'] = get_template_directory_uri().'/framework/tinymce/weathercharts.js';
   return $plugin_array;
}
