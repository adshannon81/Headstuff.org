<?php 

 add_action('init', 'add_button_soundcloud');
 
 function add_button_soundcloud() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_soundcloud');
     add_filter('mce_buttons_3', 'register_button_soundcloud');
   }
}

function register_button_soundcloud($buttons) {
   array_push($buttons, "soundcloud");
   return $buttons;
}

function add_plugin_soundcloud($plugin_array) {
   $plugin_array['soundcloud'] = get_template_directory_uri().'/framework/tinymce/soundcloud.js';
   return $plugin_array;
}
