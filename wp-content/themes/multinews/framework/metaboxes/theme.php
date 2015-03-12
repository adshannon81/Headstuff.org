<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'mom_';

global $meta_boxes;

$meta_boxes = array();
//Category options
$of_categories = array();  
$of_categories_obj = get_categories('hide_empty=0');
foreach ($of_categories_obj as $of_cat) {
    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}

// Menus
    $mom_menus = array();
    $all_menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
foreach ($all_menus as $mom_menu) {
    $mom_menus[$mom_menu->term_id] = $mom_menu->name;
}
// Get ads
$ads = get_posts('post_type=ads&posts_per_page=-1');

$get_ads = array();
foreach ($ads as $ad) {
    $get_ads[$ad->ID] = esc_attr($ad->post_title);
}
// image Path
$imgpath = MOM_URI . '/framework/metaboxes/img/';
$imagepath = MOM_URI . '/framework/metaboxes/img';
$themeimg = MOM_URI . '/images/';
// Main settings
$meta_boxes[] = array(
	'id' => 'main_settings',
	'title' => __('Page Layout', 'framework'),
	'pages' => array( 'post', 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'  => __('Custom Page', 'framework'),
			'id'    => "{$prefix}background_tr",
			'desc'  => __('if you want build fully customizable page, Enable this option', 'framework'),
            'std'   => false,
			'type'  => 'checkbox',
			'class' => 'def-temp-on'
		),
		// Page Layout
                array(
			'name'  => __('Theme style', 'framework'),
			'id'    => "{$prefix}theme_layout",
			'desc'  => __('Select theme style, none mean you will use the default layout or what you set by theme options -> General Settings -> Theme style', 'framework'),
			'type'  => 'radioimg',
			'std'   => '',
			'options' => array(
				'' => '<img src="'.$imgpath.'none.png" alt="none">',
				'full' => '<img src="'.$imgpath.'full.png" alt="full">',
				'boxed' => '<img src="'.$imgpath.'boxed.png" alt="boxed">',
				'boxed2' => '<img src="'.$imgpath.'boxed2.png" alt="boxed2">',
			),
		),

                array(
			'name'  => __('Page Layout', 'framework'),
			'id'    => "{$prefix}page_layout",
			'desc'  => __('Select page layout, none mean you will use the default layout or what you set by theme options -> General Settings -> Theme layout', 'framework'),
			'type'  => 'radioimg',
			'std'   => '',
			'options' => array(
				'' => '<img src="'.$imgpath.'none.png" alt="none">',
				'right-sidebar' => '<img src="'.$imgpath.'right_side.png" alt="Right Sidebar">',
				'left-sidebar' => '<img src="'.$imgpath.'left_side.png" alt="Left Sidebar">',
				'both-sidebars-all' => '<img src="'.$imgpath.'both.png" alt="Both Sidebar">',
				'both-sidebars-right' => '<img src="'.$imgpath.'both_right.png" alt="Both Right Sidebar">',
				'both-sidebars-left' => '<img src="'.$imgpath.'both_left.png" alt="Both Left Sidebar">',
				'fullwidth' => '<img src="'.$imgpath.'no_side.png" alt="no Sidebar">',
			),
		),

                // Sidebars
                array(
			'name'  => __('Main Sidebar', 'framework'),
			'id'    => "{$prefix}right_sidebar",
			'desc'  => __('Select main sidebar', 'framework'),
                        'class' => 'hide',
			'type'  => 'sidebars',
		),                

                array(
			'name'  => __('Secondary Sidebar', 'framework'),
			'id'    => "{$prefix}left_sidebar",
			'desc'  => __('Select secondary sidebar', 'framework'),
                        'class' => 'hide',
			'type'  => 'sidebars',
		),                
		                
                
    )

);

$of_categories 		= array();  
	$of_categories_obj 	= get_categories('hide_empty=0');
	foreach ($of_categories_obj as $of_cat) {
	    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}

//Page Options
$meta_boxes[] = array(
	'id' => 'page_settings',
	'title' => __('Page Settings', 'framework'),
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		
		array(
			'name'  => __('Page color', 'framework'),
			'id'    => "{$prefix}page_color",
			'desc'  => __('', 'framework'),
            'std'   => '',
			'type'  => 'color',
			'class' => 'page_color'
		), 
		array(
			'name'  => __('Disable Breadcrumb', 'framework'),
			'id'    => "{$prefix}hide_breadcrumb",
                        'std'   => false,
			'type'  => 'checkbox',
			'class' => 'def-temp pbreadcrumb'
		),      
		array(
			'name'  => __('Page Icon', 'framework'),
			'id'    => "{$prefix}page_icon",
			'type'  => 'icon',
			'class' => 'def-temp'
		), 
		array(
			'name'  => __('Enable Share icons', 'framework'),
			'id'    => "{$prefix}page_share",
                        'std'   => false,
			'type'  => 'checkbox',
			'class' => 'def-temp sharep'
		),
		array(
			'name'  => __('Enable Comments', 'framework'),
			'id'    => "{$prefix}page_comments",
                        'std'   => false,
			'type'  => 'checkbox',
			'class' => 'def-temp commp'
		),
		
		//Weather Page
		array(
			'name'  => __('City Name', 'framework'),
			'id'    => "{$prefix}we_location",
			'desc'  => __('Enter default city name', 'framework'),
			'std'   => 'cairo',
			'type'  => 'text',
			'class' => 'weather-temp'
		),

		array(
			'name'  => __('Custom city title', 'framework'),
			'id'    => "{$prefix}we_city_title",
			'desc'  => __('by leave this empty, the title will be the city name if you customize this insert custom title here', 'framework'),
			'std'   => '',
			'type'  => 'text',
			'class' => 'weather-temp'
		),

		array(
			'name'  => __('Default Unit', 'framework'),
			'id'    => "{$prefix}we_d_unit",
			'type'  => 'select',
			'options' => array(
			    'metric' => 'C',
			    'imperial' => 'F',  
			),
			'class' => 'weather-temp'
		),
		
		array(
			'name'  => __('Display language', 'framework'),
			'id'    => "{$prefix}we_language",
			'desc'  => __('Enter default city name', 'framework'),
			'type'  => 'select',
			'options' => array(
			    'en' => 'English',
			    'fr' => 'French',
			    'ru' => 'Russian',
			    'it' => 'Italian',
			    'sp' => 'Spanish',
			    'ua' => 'Ukrainian',
			    'de' => 'German',
			    'pt' => 'Portuguese',
			    'ro' => 'Romanian',
			    'pl' => 'Polish',
			    'fi' => 'Finnish',
			    'nl' => 'Dutch',
			    'bg' => 'Bulgarian',
			    'se' => 'Swedish',
			    'zh_tw' => 'Chinese Traditional',
			    'zh_cn' => 'Chinese Simplified',
			    'tr' => 'Turkish',
			    'cz' => 'Czech',
			    'gl' => 'Galician',
			    'vi' => 'Vietnamese',
			    'ar' => 'Arabic',
			    'mk' => 'Macedonian',
			    'sk' => 'Slovak',  
			),
			'class' => 'weather-temp'
		),

                array(
			'name'  => __('Weather Background Image', 'framework'),
			'id'    => "{$prefix}we_bg_img",
			'type'  => 'media',
			'std'   => $themeimg.'weather-bg3.jpg',
			'class' => 'weather-temp'
		),               
		
		//Magazine Page
		array(
			'name'  => __('Magazine Page logo', 'framework'),
			'id'    => "{$prefix}mag_logo",
			'type'  => 'media',
			'std'   => $themeimg.'magazine-logo.png',
			'class' => 'mag-temp'
		),

            array(
				'name'  => __('Magazine Display', 'framework'),
				'id'    => "{$prefix}mag_display",
				'type'  => 'select',
	            'class' => 'rw_float min_select rw_last mag-temp',
						'options' => array(
							'latest' => __('Latest News', 'framework'),
							'cat' => __('Category', 'framework'),
						),
			),
			
			array(
				'name'  => __('Categories', 'framework'),
				'id'    => "{$prefix}mag_cat",
				'type'  => 'select',
	            'class' => 'rw_float min_select rw_last mag-cat hide',
				'options' => array( "Select a Category" ) + $of_categories,
			),
			
			array(
				'name'  => __('Order By', 'framework'),
				'id'    => "{$prefix}mag_orderby",
				'type'  => 'select',
	            'class' => 'rw_float min_select rw_last mag-temp',
				'options' => array(
							'' => __('Recent', 'framework'),
							'comment_count' => __('Popular', 'framework'),
							'rand' => __('Random', 'framework'),
				),
			),

                array(
			'name'  => __('Number of posts', 'framework'),
			'id'    => "{$prefix}mag_posts",
			'type'  => 'range2',
            'min' => -1,
            'max' => 100,
            'step' => 1,
            'suffix' => 'Post',
            'std' => 5,
            'class' => 'mag-temp',
	    'desc' => __('-1 for all posts', 'framework')
			
		),
		array(
			'name'  => __('Autoplay', 'framework'),
			'id'    => "{$prefix}mag_auto",
			'desc'  => __('', 'framework'),
            'std'   => false,
			'type'  => 'checkbox',
			'class' => 'mag-temp'
		),
		array(
			'name'  => __('interval', 'framework'),
			'id'    => "{$prefix}mag_interval",
			'type'  => 'range2',
            'min' => 1000,
            'max' => 10000,
            'step' => 100,
            'suffix' => 'MS',
            'std' => 4000,
            'class' => 'mag-temp',
	    'desc' => __('time (ms) between page switch, if autoplay is true.', 'framework')
			
		),
		//Archive template
			array(
				'name'  => __('Display', 'framework'),
				'id'    => "{$prefix}arch_list",
				'type'  => 'checkbox_list',
	            'class' => 'rw_float min_select rw_last archives-tem',
				'options' => array(
	                'cats' => 'Categories',
	                'pages'   => 'Pages',
	                'popular' => 'Popular posts',
	                'recent' => 'Recent posts',
	                'authors' => 'Authors',
	                'tags' => 'Tags',
					),
			),
		//Media page template 
		array(
				'name'  => __('Media Page Display', 'framework'),
				'id'    => "{$prefix}media_display",
				'type'  => 'select',
	            'class' => 'rw_float min_select rw_last media-temp',
						'options' => array(
							'latest' => __('Latest News', 'framework'),
							'cat' => __('Category', 'framework'),
						),
			),
			array(
				'name'  => __('Category', 'framework'),
				'id'    => "{$prefix}media_cat",
				'type'  => 'select',
	            'class' => 'rw_float min_select rw_last media-cat hide',
				'options' => array( "Select a Category" ) + $of_categories,
			),
                array(
			'name'  => __('Number of posts', 'framework'),
			'id'    => "{$prefix}media_posts",
			'type'  => 'range2',
            'min' => -1,
            'max' => 100,
            'step' => 1,
            'suffix' => 'Post',
            'std' => 5,
            'class' => 'media-temp',
	    'desc' => __('-1 for all posts', 'framework')
			
		),
	)

);
// post settings
$meta_boxes[] = array(
	'id' => 'mom_story_highlights',
	'title' => __('Story highlights', 'framework'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'core',
	'fields' => array(
			array(
			'name'  => __('Story highlights', 'framework'),
			'id'    => "{$prefix}post_highlights",
			'type'  => 'textarea',
                        'desc' => __('each Heading in new line','framework')
		),
	)

);
// post settings
$meta_boxes[] = array(
	'id' => 'mom_posts_layout',
	'title' => __('Post Layout', 'framework'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'core',
	'fields' => array(
			array(
			'name'  => __('post_layout', 'framework'),
			'id'    => "{$prefix}post_layout",
			'type'  => 'radioimg',
			'std'   => '',
			'options' => array(
				'' => '<img src="'.$imgpath.'none.png" alt="">',
				'default' => '<img src="'.$imgpath.'post.png" alt="">',
				'layout1' => '<img src="'.$imgpath.'post1.png" alt="">',
				'layout2' => '<img src="'.$imgpath.'post2.png" alt="">',
				'layout3' => '<img src="'.$imgpath.'post3.png" alt="">',
				'layout4' => '<img src="'.$imgpath.'post4.png" alt="">',
				'layout5' => '<img src="'.$imgpath.'post5.png" alt="">',
			),
                        'desc' => __('Post Feature image Layout, none mean you will use the default layout or what you set by theme options -> General Settings -> post settings -> post layout','framework')
		),

	)

);
// post settings
$meta_boxes[] = array(
	'id' => 'mom_post_setting',
	'title' => __('Post Settings', 'framework'),
	'pages' => array( 'post' ),
	'context' => 'side',
	'priority' => 'core',
	'fields' => array(
                array(
			'name'  => __('Hide Feature Image', 'framework'),
			'id'    => "{$prefix}hide_feature",
                        'std'   => false,
			'type'  => 'checkbox',
                        'desc' => __('by default you will see the feature image at the top of post', 'framework')
		),
				array(
			'name'  => __('Story highlights', 'framework'),
			'id'    => "{$prefix}hide_highlights",
                        'std'   => false,
			'type'  => 'checkbox',
                        'desc' => __('', 'framework')
		),
                array(
			'name'  => __('As Review', 'framework'),
			'id'    => "{$prefix}review_post",
                        'std'   => false,
			'type'  => 'checkbox',
                        'desc' => __('this must be enable if you want use this post as review', 'framework')
		),
                                
                array(
			'name'  => __('Disable posts share', 'framework'),
			'id'    => "{$prefix}blog_ps",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
                array(
			'name'  => __('Disable Next post and prev post links', 'framework'),
			'id'    => "{$prefix}blog_np",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
                array(
			'name'  => __('Disable author box', 'framework'),
			'id'    => "{$prefix}blog_ab",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
                array(
			'name'  => __('Disable Related posts', 'framework'),
			'id'    => "{$prefix}blog_rp",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
                array(
			'name'  => __('Disable comments', 'framework'),
			'id'    => "{$prefix}blog_pc",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
    )

);

// Page/post background
$meta_boxes[] = array(
	'id' => 'page_background',
	'title' => __('Page Background', 'framework'),
	'pages' => array( 'post', 'page', 'portfolio' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(

                  array(
			'name'  => __('Background color', 'framework'),
			'id'    => "{$prefix}custom_bg",
			'type'  => 'color',
		),

                array(
			'name'  => __('Background Image', 'framework'),
			'id'    => "{$prefix}custom_bg_img",
			'type'  => 'media',
		),

                array(
			'name'  => __('Background Position', 'framework'),
			'id'    => "{$prefix}custom_bg_pos",
			'type'  => 'select',
                        'class' => 'rw_float min_select',
			'options' => array(
                                'top left'      => __('Top Left', 'framework'),
                                'top center'    => __('Top Center', 'framework'),
                                'top right'     => __('Top Right', 'framework'),
                                'center left'   => __('Middle Left', 'framework'),
                                'center center' => __('Middle Center', 'framework'),
                                'center right'  => __('Middle Right', 'framework'),
                                'bottom left'   => __('Bottom Left', 'framework'),
                                'bottom center' => __('Bottom Center', 'framework'),
                                'bottom right'  => __('Bottom Right', 'framework')
			),
		),



                array(
			'name'  => __('Background Repeat', 'framework'),
			'id'    => "{$prefix}custom_bg_repeat",
			'type'  => 'select',
                        'class' => 'rw_float min_select rw_last',
			'options' => array(
				'repeat' => __('Tile', 'framework'),
				'no-repeat' => __('No Repeat', 'framework'),
				'repeat-x' => __('Tile Horizontally', 'framework'),
				'repeat-y' => __('Tile Vertically', 'framework'),
			),
		),
                array(
			'name'  => __('Background Attachment', 'framework'),
			'id'    => "{$prefix}custom_bg_attach",
			'type'  => 'select',
                        'class' => 'rw_float min_select rw_last',
			'options' => array(
				'scroll' => __('Scroll', 'framework'),
				'fixed' => __('Fixed', 'framework'),
			),
		),

                array(
			'name'  => __('Background size', 'framework'),
			'id'    => "{$prefix}custom_bg_size",
			'type'  => 'select',
                        'class' => 'rw_float min_select rw_last',
			'options' => array(
				'auto' => __('inherit', 'framework'),
				'cover' => __('cover', 'framework'),
				'contain' => __('contain', 'framework'),
			),
		),                
                
    )

);

// content ads
$meta_boxes[] = array(
	'id' => 'page_content_ads',
	'title' => __('Content Ads', 'framework'),
	'pages' => array( 'post', 'page', 'portfolio' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(

                array(
			'name'  => __('Fixed On Scroll', 'framework'),
			'id'    => "{$prefix}content_ads_fixed",
                        'std'   => false,
			'type'  => 'checkbox',
		),

                array(
			'name'  => __('Right Banner', 'framework'),
			'id'    => "{$prefix}content_right_banner",
			'type'  => 'select',
                        'class' => 'rw_float min_select',
			'options' => array('') +$get_ads,
		),
                
                array(
			'name'  => __('Left Banner', 'framework'),
			'id'    => "{$prefix}content_left_banner",
			'type'  => 'select',
                        'class' => 'rw_float min_select',
			'options' => array('') + $get_ads,
		),
    )

);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function YOUR_PREFIX_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'YOUR_PREFIX_register_meta_boxes' );