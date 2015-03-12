<?php 

 add_action('init', 'add_button_testimonial');
 
 function add_button_testimonial() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_testimonial');
     add_filter('mce_buttons_3', 'register_button_testimonial');
   }
}

function register_button_testimonial($buttons) {
   array_push($buttons, "testimonial");
   return $buttons;
}

function add_plugin_testimonial($plugin_array) {
   $plugin_array['testimonial'] = get_template_directory_uri().'/framework/tinymce/testimonial.js';
   return $plugin_array;
}
