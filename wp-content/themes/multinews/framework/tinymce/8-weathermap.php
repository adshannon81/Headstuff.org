<?php 

 add_action('init', 'add_button_weathermap');
 
 function add_button_weathermap() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_weathermap');
     add_filter('mce_buttons_3', 'register_button_weathermap');
   }
}

function register_button_weathermap($buttons) {
   array_push($buttons, "weathermap");
   return $buttons;
}

function add_plugin_weathermap($plugin_array) {
   $plugin_array['weathermap'] = get_template_directory_uri().'/framework/tinymce/weathermap.js';
   return $plugin_array;
}
