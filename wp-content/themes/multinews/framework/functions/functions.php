<?php
//js Files
add_action( 'wp_enqueue_scripts', 'mom_scripts_styles');
function mom_scripts_styles() {
	global $wp_styles;
	wp_enqueue_script('jquery');
	

	// General scripts
	wp_register_script('modernizr', MOM_JS . '/modernizr-2.6.2.min.js', 'jquery');
	//wp_register_script('twitter', MOM_JS . '/twitter/twitter.feed.js', 'jquery');
	wp_register_script( 'prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'), '3.1.5', true );
	wp_register_script('jflicker', MOM_JS . '/jflickrfeed.min.js', 'jquery', '', true);
	wp_register_script('backstretch', MOM_JS . '/jquery.backstretch.min.js', 'jquery', '', true);
	wp_register_script('handlebars', MOM_JS . '/handlebars-v1.3.0.js', 'jquery', '', true);
	wp_register_script('typehead', MOM_JS . '/typeahead.js', 'jquery', '', true);
	wp_register_script('cycle', MOM_JS . '/cycle.min.js', 'jquery', '', true);
	
	if ( ! is_page_template('magazine.php') ) {
	wp_register_script( 'Momizat-main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true );
	wp_localize_script( 'Momizat-main-js', 'momAjaxL', array(
        'url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'ajax-nonce' ),
        'success' => __('Check your email to complete subscription','framework'),
        'error' => __('Already subscribed', 'framework'),
        'error2' => __('Email invalid', 'framework'),
        'nomore' => __('No More Posts', 'framework'),
	'homeUrl' => home_url(),
	'viewAll' => __('View All Results', 'framework'),
	'noResults' => __('Sorry, no posts matched your criteria', 'framework'),
        )
    );
	wp_enqueue_script( 'Momizat-main-js');
	wp_enqueue_script( 'plugins-js', get_template_directory_uri() . '/js/plugins.min.js', array('jquery'), '1.0', true ); //minify in main.js
	wp_enqueue_script('prettyphoto');
	}
	if(mom_option('bg_slider') == 1) {
		wp_enqueue_script('backstretch');
		add_action('wp_head', 'mom_bg_slider');
	} 
//Our stylesheets 
	wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css' );
	wp_enqueue_style( 'plugins', get_template_directory_uri() . '/css/plugins.min.css' );
	if(mom_option('main_skin') == 'dark') { wp_enqueue_style( 'dark-style', get_template_directory_uri() . '/css/dark.css' ); }
	wp_enqueue_style( 'multinews-style', get_stylesheet_uri(), array( 'dashicons' ), '1.0' );
	if(mom_option('enable_responsive') != false) { wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/media.css' ); }
	if ( is_page_template('magazine.php')) {
		wp_enqueue_script('modernizr');
                wp_enqueue_script( 'jquerypp', get_template_directory_uri() . '/js/jquerypp.custom.js', array('jquery'), '1.0', false );
                wp_enqueue_script( 'bookblock', get_template_directory_uri() . '/js/jquery.bookblock.min.js', array('jquery'), '1.0', false );
		wp_enqueue_style( 'bookblocks', get_template_directory_uri() . '/css/bookblock.css' );
	}
	if ( is_page_template('weather.php')) {
		wp_enqueue_script('handlebars');
		wp_enqueue_script('typehead');
	}
	if ( is_category() ){
		wp_enqueue_style( 'bookblocks', get_template_directory_uri() . '/css/catbookblock.css' );
	} 
}


add_action( 'admin_enqueue_scripts', 'mom_admin_scripts' );
function mom_admin_scripts( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style('shortcodes', MOM_URI.'/framework/shortcodes/css/tinymce.css');
}

// Momizat Get Images
function mom_post_image($size = 'thumbnail', $id='', $pid = '', $di = false){
		global $post;
		$image = '';
		$tt = mom_option('using_timthumb');
    		global $mn_thumbs_sizes;
		$w = isset($mn_thumbs_sizes[$size][0]) ? $mn_thumbs_sizes[$size][0] : '';
		$h = isset($mn_thumbs_sizes[$size][1]) ? $mn_thumbs_sizes[$size][1] : '';
		//get the post thumbnail
		if ($pid == '') {
			$pid = $post->ID;
		}

		if ($id != '') {
			$image_id = $id;
		} else {
			$image_id = get_post_thumbnail_id($pid);
		}
		$image = wp_get_attachment_image_src($image_id,  
		$size);
		$image = $image[0];
		if ($tt == 1) {
			if ($size == 'full') {
				if ($image) return $image;
			} else {
			if ($image) return MOM_URI.'/framework/timthumb/timthumb.php?src='.$image.'&h='.$h.'&w='.$w;
			}
		} else {
			if ($image) return $image;
		}
		//if the post is video post and haven't a feutre image
		global $posts_st;
		$extra = get_post_meta($pid, $posts_st->get_the_id(), TRUE);

		  $format = get_post_format($pid);
		  if (isset($extra['video_type'])) { $vtype = $extra['video_type']; }
		  if (isset($extra['video_id'])) { $vId = $extra['video_id']; }
		if (isset($extra['html5_poster_img'])) { $html5_poster = $extra['html5_poster_img']; }

		if($format == 'video') {
			if($vtype == 'youtube') {
				if ($tt == 1) {
			  $image = 'http://img.youtube.com/vi/'.$vId.'/0.jpg';
				} else {
			  $image = MOM_URI.'/framework/timthumb/timthumb.php?src=http://img.youtube.com/vi/'.$vId.'/0.jpg&h='.$h.'&w='.$w;
				}
			} elseif ($vtype == 'vimeo') {
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vId.php"));
				if ($tt == 1) {
			  $image = $hash[0]['thumbnail_large'];
				} else {
			  $image = MOM_URI.'/framework/timthumb/timthumb.php?src='.$hash[0]['thumbnail_large'].'&h='.$h.'&w='.$w;
				}
			} elseif ($vtype == 'html5') {
			  $image = $html5_poster;
			} elseif ($vtype == 'daily') {
					$image = 'http://www.dailymotion.com/thumbnail/video/'.$vId;
			} elseif ($vtype == 'facebook') {
					$image = 'https://graph.facebook.com/'.$vId.'/picture';

			}

		}

		if ($tt == 1) {
			if ($size == 'full') {
				if ($image) return $image;
			} else {
			if ($image) return MOM_URI.'/framework/timthumb/timthumb.php?src='.$image.'&h='.$h.'&w='.$w;
			}
		} else {
			if ($image) return $image;
		}
		//If there is still no image, get the first image from the post
		if (mom_option('post_first_image') == 1) {
			if (mom_get_first_image($pid) !== '') {
			return MOM_URI.'/framework/timthumb/timthumb.php?src='.mom_get_first_image($pid).'&h='.$h.'&w='.$w;
			}
		}

		$default_image = get_template_directory_uri().'/images/no-image.jpg';
			if (mom_option('post_default_img') == 1) {
				if (mom_option('custom_default_img', 'url') != '') {
					return mom_option('custom_default_img', 'url');
				} else {
						$image = $default_image;
				}
				
			} else {
				if ($di == true) {
					$image = $default_image;
				} else {
					return ;
				}
			}
		}
		function mom_get_first_image($id) {
	        $post_id = $id;
	        $queried_post = get_post($post_id);
		  $first_img = '';
		  ob_start();
		  ob_end_clean();
		  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $queried_post->post_content, $matches);
		  $first_img = '';
		  if (isset($matches[1][0])) {$first_img = $matches[1][0];}
		  return $first_img;
		}
		
// Limit String Words
function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}
// date format
function mom_date_format() {
	return the_time(mom_option('date_format'));
}

//breadcrumbs
function mom_breadcrumb () {
	if (mom_option('breadcrumb') != false) {
		breadcrumbs_plus();
	}
}

//Post views
function setPostViews($postID) {
	if (! is_preview()) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
	}
}

// function to display number of posts.
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.__(' Views', 'framework');
}
// Add it to a column in WP-Admin
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
    $defaults['post_views'] = __('Views', 'framework');
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
	if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
    }
}

//title limit
function short_title($num) {
 
	$limit = $num+1;
	 
	$title = str_split(get_the_title());
	 
	$length = count($title);
	 
	if ($length>=$num) {
	 
	$title = array_slice( $title, 0, $num);
	 
	$title = implode("",$title)."...";
	 
	echo $title;
	 
} else { 
	the_title();
	}
}
//author filds
function mom_show_extra_profile_fields( $contactmethods ) {
		$contactmethods['facebook'] = 'FaceBook URL';
		$contactmethods['twitter'] = 'Twitter Username';
		$contactmethods['youtube'] = 'YouTube URL';
		$contactmethods['linkedin'] = 'linkedIn URL';
		$contactmethods['flickr'] = 'Flickr URL';
		$contactmethods['pinterest'] = 'Pinterest URL';
		$contactmethods['dribbble'] = 'Dribbble URL';
	return $contactmethods;		
	}
add_filter('user_contactmethods','mom_show_extra_profile_fields',10,1);

## Save user's social accounts

add_action( 'personal_options_update', 'mom_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'mom_save_extra_profile_fields' );

function mom_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) return false;
	update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
	update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
	update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
	update_user_meta( $user_id, 'flickr', $_POST['flickr'] );
	update_user_meta( $user_id, 'youtube', $_POST['youtube'] );
	update_user_meta( $user_id, 'dribbble', $_POST['dribbble'] );
}
add_filter('user_contactmethods','hide_profile_fields',10,1);

function hide_profile_fields( $contactmethods ) {
    unset($contactmethods['aim']);
    unset($contactmethods['jabber']);
    unset($contactmethods['yim']);
    return $contactmethods;
}

function additional_user_fields( $user ) { ?>
    <h3><?php _e( 'Profile Cover Image', 'framework' ); ?></h3>
 
    <table class="form-table">
 
        <tr>
            <th><label for="user_meta_image"><?php _e( 'A special image for each user', 'framework' ); ?></label></th>
            <td>
                <!-- Outputs the image after save -->
                 <input type="text" class="img" name="user_meta_image" id="user_meta_image" value="<?php echo esc_url_raw( get_the_author_meta( 'user_meta_image', $user->ID ) ); ?>" />
                <!-- Outputs the save button -->
                <input type="button" class="select-img button-secondary" id="user_meta_image_button" value="Select Image" />
                <br>
                <span class="description" for="user_meta_image"><?php _e( 'Upload a cover image for your user profile.', 'framework' ); ?></span>
            </td>
        </tr>
	<?php
		wp_enqueue_media();
		wp_enqueue_script('media-upload');
	  ?>
    </table><!-- end form-table -->
<?php } // additional_user_fields
 
add_action( 'show_user_profile', 'additional_user_fields', 8 );
add_action( 'edit_user_profile', 'additional_user_fields', 8 );
/**
* Saves additional user fields to the database
*/
function save_additional_user_meta( $user_id ) {
 
    // only saves if the current user can edit user profiles
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
 
    update_user_meta( $user_id, 'user_meta_image', $_POST['user_meta_image'] );
}
 
add_action( 'personal_options_update', 'save_additional_user_meta' );
add_action( 'edit_user_profile_update', 'save_additional_user_meta' );

//background slider
function mom_bg_slider() { ?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
	$("body").backstretch([
	<?php
	$comma = false;
	$slides = mom_option('bg_slider_img');
	foreach ($slides as $slide) {
		if ($comma) echo ","; else $comma=true;
		echo '"'.$slide['image'].'"';
	}
	?>,
	], {duration: <?php echo mom_option('bg_slider_dur'); ?>, fade: 750},"next");
	});
	</script>
<?php }

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

//Exclude Pages from Search Results
/*-----------------------------------------------------------------------------------*/
function is_type_page() {
	global $post;
	if ($post->post_type == 'page') {
	return true;
	} else {
	return false;
}}

//Exclude Category from Search Results
/*-----------------------------------------------------------------------------------*/
function mom_SearchFilter($query) {
if ($query->is_search) {
$query->set('cat', mom_option('search_cat_ex'));
}
return $query;
}
add_filter('pre_get_posts','mom_SearchFilter');

// Modal box Wrap
/*-----------------------------------------------------------------------------------*/
add_action( 'admin_head', 'mom_admin_modal_box' );
function mom_admin_modal_box() { ?>
	<div class="mom_modal_box">
		<div class="mom_modal_header"><h1><?php _e('Select Icon', 'framework'); ?></h1><a class="media-modal-close" id="mom_modal_close" href="#"><span class="media-modal-icon"></span></a></div>
		<div class="mom_modal_content"><span class="mom_modal_loading"></span></div>
		<div class="mom_modal_footer"><a class="mom_modal_save button-primary" href="#"><?php _e('Save', 'framework'); ?></a></div>
	</div>
	<div class="mom_media_box_overlay"></div>
<?php }
add_action( 'admin_enqueue_scripts', 'mom_admin_global_scripts' );
function mom_admin_global_scripts () {
//Load our custom javascript file
    wp_enqueue_script( 'mom-admin-global-script', get_template_directory_uri() . '/framework/helpers/js/admin.js' );
	wp_localize_script( 'mom-admin-global-script', 'MomCats', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'ajax-nonce' ),
		)
	);
    
}
function mom_google_fonts() {
	return false;
}
?>