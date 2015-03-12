<?php
/*------------------------------------------*/
/*	Theme constants
/*------------------------------------------*/
define ('MOM_URI' , get_template_directory_uri());
define ('MOM_DIR' , get_template_directory());
define ('MOM_JS' , MOM_URI . '/js');
define ('MOM_CSS' , MOM_URI . '/css');
define ('MOM_IMG' , MOM_URI . '/images');
define ('MOM_FW' , MOM_DIR . '/framework');
define ('MOM_PLUGINS', MOM_FW . '/plugins');
define ('MOM_FUN', MOM_FW . '/functions');
define ('MOM_WIDGETS', MOM_FW . '/widgets');
define ('MOM_SC', MOM_FW . '/shortcodes');
define ('MOM_TINYMCE', MOM_FW . '/tinymce');
define ('MOM_HELPERS', MOM_URI . '/framework/helpers');
define ('MOM_PB', MOM_FW . '/page-builder/');
define ('MOM_AJAX', MOM_FW . '/ajax');

/*------------------------------------------*/
/*	Theme Admin
/*------------------------------------------*/
require_once( MOM_FW . '/admin/admin-init.php' );
/*------------------------------------------*/
/*	Theme Admin
/*------------------------------------------*/
function mom_option($option, $arr=null)
{
	if(defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE != 'en') {
		$lang = ICL_LANGUAGE_CODE;
		global $opt_name ;
		global ${$opt_name};

		if($arr) {
		    if(isset(${$opt_name}[$option][$arr])) {
			return ${$opt_name}[$option][$arr];
		    }
		    } else {
		     if(isset(${$opt_name}[$option])) {
		   return ${$opt_name}[$option];
		     }
		    }		
		
	} else {
			global $mom_options;
		if($arr) {
		    if(isset($mom_options[$option][$arr])) {
			return $mom_options[$option][$arr];
		    }
		    } else {
		     if(isset($mom_options[$option])) {
		   return $mom_options[$option];
		     }
		    }
	}

}
/*------------------------------------------*/
/*	Mega menus
/*------------------------------------------*/
if ( file_exists( MOM_FW . '/menus/menu.php' ) ) {
	require_once( MOM_FW . '/menus/menu.php' );
}

/*------------------------------------------*/
/*	Theme Widgets
/*------------------------------------------*/
    foreach ( glob( MOM_WIDGETS . '/*.php' ) as $file )
	{
		require_once $file;
	}
	
/*------------------------------------------*/
/*	Theme Plugins
/*------------------------------------------*/
require_once  MOM_FW . '/inc/sidebar_generator.php';
require_once  MOM_FW . '/inc/breadcrumbs-plus/breadcrumbs-plus.php';
require_once  MOM_FW . '/plugins.php';

/*------------------------------------------*/
/*	Theme Shortcodes
/*------------------------------------------*/
    foreach ( glob( MOM_SC . '/*.php' ) as $file )
	{
		require_once $file;
	}

/*------------------------------------------*/
/*	Theme TinyMCE
/*------------------------------------------*/
    foreach ( glob( MOM_TINYMCE . '/*.php' ) as $file )
	{
		require_once $file;
	}

add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'tiny_mce_before_init', 'my_mce_before_init' );

function my_mce_before_init( $settings ) {

    $style_formats = array(
    
        array(
        	'title' => 'Main Title (duoble dots)',
        	'block' => 'div',
        	'classes' => 'main_title',
        	'wrapper' => true
        ),
        array(
        	'title' => 'Sub Title',
        	'block' => 'div',
        	'classes' => 'sub_title',
        	'wrapper' => true
        ),
        array(
        	'title' => 'Main Image Frame',
        	'block' => 'div',
        	'classes' => 'main_img_frame',
        	'wrapper' => true
        ),
  

        array(
        	'title' => 'White Text',
        	'inline' => 'span',
		'styles' => array(
			'color' =>  '#ffffff',
			'text-shadow' => '0 1px 0 #9d9b98'
			)
		),


        array(
        	'title' => 'Dark Text Shadow',
        	'inline' => 'span',
		'styles' => array(
        		'textShadow' => '0 2px 0 #000',
			)
		),

        array(
        	'title' => 'Light Text Shadow',
        	'inline' => 'span',
		'styles' => array(
        		'textShadow' => '0 1px 0 rgba(255,255,255,0.3)',
			)
		),

        array(
        	'title' => 'Upper Case Text',
        	'inline' => 'span',
		'styles' => array(
        		'textTransform' => 'uppercase',
			)
		),
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}

/*------------------------------------------*/
/*	Tiny MCE Custom font-sizes
/*------------------------------------------*/

add_filter( 'mce_buttons', 'my_mce_buttons_1' );
function my_mce_buttons_1( $buttons ) {
    array_unshift( $buttons, 'fontsizeselect' );
    return $buttons;
}

function mom_customize_text_sizes($initArray){
   $initArray['theme_advanced_font_sizes'] = "10px,11px,12px,13px,14px,15px,16px,17px,18px,19px,20px,21px,22px,23px,24px,25px,26px,27px,28px,29px,30px,32px,48px";
   return $initArray;
}

// Assigns customize_text_sizes() to "tiny_mce_before_init" filter
add_filter('tiny_mce_before_init', 'mom_customize_text_sizes');

/*------------------------------------------*/
/*	Tiny MCE Custom Column dropdown
/*------------------------------------------*/

global $wp_version;
if ( $wp_version < 3.9 ) {
function register_momcols_dropdown( $buttons ) {
   array_push( $buttons, "momcols" );
   return $buttons;
}

function add_momcols_dropdown( $plugin_array ) {
   $plugin_array['momcols'] = get_template_directory_uri() . '/framework/shortcodes/js/cols.js';
   return $plugin_array;
}

function momcols_dropdown() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'add_momcols_dropdown' );
      add_filter( 'mce_buttons_2', 'register_momcols_dropdown' );
   }

}

add_action('admin_init', 'momcols_dropdown');

} else {

add_action('admin_head', 'mom_sc_cols_list');
function mom_sc_cols_list() {
    global $typenow;
    // check user permissions
    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
   	return;
    }
    // verify the post type
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return;
	// check if WYSIWYG is enabled
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "mom_cols_add_tinymce_plugin");
		add_filter('mce_buttons', 'mom_cols_register_my_tc_button');
	}
}
function mom_cols_add_tinymce_plugin($plugin_array) {
   	$plugin_array['columns'] = MOM_URI . '/framework/shortcodes/js/cols-list.js';
   	return $plugin_array;
}
function mom_cols_register_my_tc_button($buttons) {
   array_push($buttons, 'columns');
   return $buttons;
}

}

/*------------------------------------------*/
/*	Theme Functions
/*------------------------------------------*/
    foreach ( glob( MOM_FUN . '/*.php' ) as $file )
	{
		require_once $file;
	}
/*------------------------------------------*/
/*	Woocommerce
/*------------------------------------------*/
	include_once MOM_FW . '/woocommerce/woocommerce.php';
        
/*------------------------------------------*/
/*	Theme Translation
/*------------------------------------------*/
//load_theme_textdomain( 'theme', get_template_directory().'/languages' );
load_theme_textdomain( 'framework', get_template_directory().'/languages' );
 
$locale = get_locale();
$locale_file = get_template_directory()."/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);

/*------------------------------------------*/
/*	Theme Menus
/*------------------------------------------*/
if ( function_exists( 'register_nav_menu' ) ) {
  register_nav_menus(
   array(
    'main'   => __('Main Menu', 'framework'),
    'topnav'   => __('Top Menu', 'framework'),
    'breaking'   => __('Breaking Bar icons Menu', 'framework'),
    'footer'   => __('Footer Menu', 'framework'),
    'copyright'   => __('Copyrights Menu', 'framework'),
   )
  );
 }
/*------------------------------------------*/
/*	Theme Support
/*------------------------------------------*/
// Adds RSS feed links to <head> for posts and comments.
add_theme_support( 'automatic-feed-links' );
add_theme_support('post-thumbnails');
add_theme_support( 'html5', array( 'gallery', 'caption' ) );
add_theme_support( 'post-formats', array( 'image', 'video', 'audio', 'quote', 'gallery'/* ,'chat' */ ) );
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );
	
/*------------------------------------------*/
/*	plugins
/*------------------------------------------*/	
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (class_exists('WPBakeryVisualComposerAbstract')) {
	include_once( MOM_FW . '/includes/builder.php' );
}
/*------------------------------------------*/
/*	Theme Ajax
/*------------------------------------------*/
require_once MOM_AJAX . '/ajax-full.php';
/*------------------------------------------*/
/*	Theme Sidebars
/*------------------------------------------*/
if ( function_exists('register_sidebar') ) {

      register_sidebar(array(
	'name' => __('Main sidebar', 'framewrok'),
        'id' => 'main-sidebar',
	'description' => __('Default main sidebar.', 'framework'),
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title"><h2>',
	'after_title' => '</h2></div>'
      ));

      register_sidebar(array(
	'name' => __('Secondary sidebar', 'framewrok'),
        'id' => 'secondary-sidebar',
	'description' => __('Default secondary sidebar.', 'framework'),
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title"><h2>',
	'after_title' => '</h2></div>'
      ));


// footers
      register_sidebar(array(
	'name' => __('Footer 1', 'framewrok'),
        'id' => 'footer1',
	'description' => 'footer widget.',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title"><h2>',
	'after_title' => '</h2></div>'
      ));

      register_sidebar(array(
	'name' => __('Footer 2', 'framewrok'),
        'id' => 'footer2',
	'description' => 'footer widget.',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title"><h2>',
	'after_title' => '</h2></div>'
      ));

      register_sidebar(array(
	'name' => __('Footer 3', 'framewrok'),
        'id' => 'footer3',
	'description' => 'footer widget.',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title"><h2>',
	'after_title' => '</h2></div>'
      ));

      register_sidebar(array(
	'name' => __('Footer 4', 'framewrok'),
        'id' => 'footer4',
	'description' => 'footer widget.',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title"><h2>',
	'after_title' => '</h2></div>'
      ));

      register_sidebar(array(
	'name' => __('Footer 5', 'framewrok'),
        'id' => 'footer5',
	'description' => 'footer widget.',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title"><h2>',
	'after_title' => '</h2></div>'
      ));

      register_sidebar(array(
	'name' => __('Footer 6', 'framewrok'),
        'id' => 'footer6',
	'description' => 'footer widget.',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title"><h2>',
	'after_title' => '</h2></div>'
      ));

      register_sidebar(array(
	'name' => __('404 Page', 'framewrok'),
        'id' => 'page404',
	'description' => '404 page widgets.',
	'before_widget' => '<div class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title"><h2>',
	'after_title' => '</h2></div>'
      ));
 }
/*------------------------------------------*/
/*	Theme Metaboxes
/*------------------------------------------*/
require_once  MOM_FW . '/metaboxes/meta-box.php';
require_once  MOM_FW . '/metaboxes/theme.php';
include_once MOM_FW . '/metaboxes/momizat-class/MetaBox.php';
include_once MOM_FW . '/metaboxes/momizat-class/MediaAccess.php';
include_once MOM_FW . '/metaboxes/momizat-class/posts-spec.php';

// global styles for the meta boxes
if (is_admin()) add_action('admin_enqueue_scripts', 'metabox_style');

function metabox_style() {
	wp_enqueue_style('wpalchemy-metabox', get_template_directory_uri() . '/framework/metaboxes/momizat-class/meta.css');
	wp_enqueue_script('momizat-metabox-js', get_template_directory_uri() . '/framework/metaboxes/momizat-class/meta.js');
}
$wpalchemy_media_access = new MomizatMB_MediaAccess();

/*------------------------------------------*/
/*	Review system
/*------------------------------------------*/
//Backend
include_once MOM_FW . '/review/review-spec.php';
//user rate
include_once MOM_FW . '/review/user_rate.php';
//frontend
include_once MOM_FW . '/review/review-system.php';

/*------------------------------------------*/
/*	Ads system
/*------------------------------------------*/
//Backend
include_once MOM_FW . '/ads/ads-spec.php';
include_once MOM_FW . '/ads/ads-type.php';

//frontend
include_once MOM_FW . '/ads/ads-system.php';

/*------------------------------------------*/
/*	Theme Enhancments
/*------------------------------------------*/
//shortcodes in widgets
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode', 11);


// Theme options When activated
if (isset($_GET['activated'])) {
	if ($_GET['activated']){
		//wp_redirect(admin_url("themes.php?page=optionsframework"));
	}
}
/* ==========================================================================
 *                Wp title
   ========================================================================== */
function mom_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'mom_wp_title', 10, 2 );
/* ==========================================================================
 *                Visual Composer
   ========================================================================== */
add_action('wp_enqueue_scripts', 'mom_vc_mod');
function mom_vc_mod() {
	wp_deregister_style( 'js_composer_front' );
}

/* ==========================================================================
 *                buddypress
   ========================================================================== */
if (class_exists('BP_Core_Members_Widget')) {
    function mom_unregister_pb_wp_widgets() { 
        unregister_widget('BP_Core_Members_Widget');
        unregister_widget('BP_Groups_Widget');
        unregister_widget('BP_Core_Friends_Widget');
    }
    add_action( 'widgets_init', 'mom_unregister_pb_wp_widgets' );
}
add_action( 'vc_before_init', 'mom_vcSetAsTheme' );
function mom_vcSetAsTheme() {
vc_set_as_theme($disable_updater = true);
}
?>