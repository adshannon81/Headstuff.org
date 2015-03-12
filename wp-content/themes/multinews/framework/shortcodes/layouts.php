<?php
//Layout 
function mom_layout_content($atts, $content) {
   extract(shortcode_atts(array(
   ), $atts));
   return '<div class="main-left"><div class="main-content"  role="main">'.do_shortcode($content).'</div>';
}
add_shortcode("layout", "mom_layout_content");

function mom_layout_s_sidebar($atts, $content = null) {
   extract(shortcode_atts(array(
    'sidebar' => ''
   ), $atts));
           $output =  '<aside class="secondary-sidebar" itemtype="http://schema.org/WPSideBar" itemscope="itemscope" role="complementary">';
        ob_start();
        if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( $sidebar ) ) {}
        $output .= ob_get_contents();
        ob_end_clean();
        $output .= "</aside>";
        return $output;
}
add_shortcode("secondary_sidebar", "mom_layout_s_sidebar");

function mom_layout_sidebar($atts, $content = null) {
   extract(shortcode_atts(array(
    'sidebar' => ''
   ), $atts));
           $output =  '</div><aside class="sidebar" itemtype="http://schema.org/WPSideBar" itemscope="itemscope" role="complementary">';
        ob_start();
        if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( $sidebar ) ) {}
        $output .= ob_get_contents();
        ob_end_clean();
        $output .= "</aside>";
        return $output;
   }
add_shortcode("main_sidebar", "mom_layout_sidebar");