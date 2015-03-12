<?php 

 add_action('init', 'add_button_testimonial_slider');
 
 function add_button_testimonial_slider() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_testimonial_slider');
     add_filter('mce_buttons_3', 'register_button_testimonial_slider');
   }
}

function register_button_testimonial_slider($buttons) {
   array_push($buttons, "testimonial_slider");
   return $buttons;
}

function add_plugin_testimonial_slider($plugin_array) {
   $plugin_array['testimonial_slider'] = get_template_directory_uri().'/framework/tinymce/testimonial_slider.js';
   return $plugin_array;
}
