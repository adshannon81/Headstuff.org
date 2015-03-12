<?php 

 add_action('init', 'add_button_blog_posts');
 
 function add_button_blog_posts() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {
     add_filter('mce_external_plugins', 'add_plugin_blog_posts');
     add_filter('mce_buttons_3', 'register_button_blog_posts');
   }
}

function register_button_blog_posts($buttons) {
   array_push($buttons, "blog_posts");
   return $buttons;
}

function add_plugin_blog_posts($plugin_array) {
   $plugin_array['blog_posts'] = get_template_directory_uri().'/framework/tinymce/blog_posts.js';
   return $plugin_array;
}
