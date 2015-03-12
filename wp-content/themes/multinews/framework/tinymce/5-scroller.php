<?php 

 add_action('init', 'add_button_scroller');
 
 function add_button_scroller() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_scroller');
     add_filter('mce_buttons_3', 'register_button_scroller');
   }
}

function register_button_scroller($buttons) {
   array_push($buttons, "scroller");
   return $buttons;
}

function add_plugin_scroller($plugin_array) {
   $plugin_array['scroller'] = get_template_directory_uri().'/framework/tinymce/scroller.js';
   return $plugin_array;
}
