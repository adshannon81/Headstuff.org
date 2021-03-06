<?php 

 add_action('init', 'add_button_fsliders');
 
 function add_button_fsliders() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_fsliders');
     add_filter('mce_buttons_3', 'register_button_fsliders');
   }
}

function register_button_fsliders($buttons) {
   array_push($buttons, "fsliders");
   return $buttons;
}

function add_plugin_fsliders($plugin_array) {
   $plugin_array['fsliders'] = get_template_directory_uri().'/framework/tinymce/fslider.js';
   return $plugin_array;
}
