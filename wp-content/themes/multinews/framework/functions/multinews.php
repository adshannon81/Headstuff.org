<?php
	//post thumbnails
	add_image_size( 'scroller-thumb', 274, 183, true );
	add_image_size( 'nb1-thumb', 364, 245, true );
	add_image_size( 'nb3-thumb', 80, 54, true );
	add_image_size( 'nb5-thumb', 130, 87, true );
	//add_image_size( 'nb6-thumb', 162, 109, true );
	add_image_size( 'npic-thumb', 359, 240, true );
	add_image_size( 'np-thumb', 85, 57, true );
	add_image_size( 'slider-thumb', 546, 365, true );
	add_image_size( 'newstabs-thumb', 266, 179, true );
	add_image_size( 'related-thumb', 165, 109, true );
	add_image_size( 'search-grid', 347, 233, true );
	add_image_size( 'megamenu-thumb', 112, 75, true );
	add_image_size( 'search-thumb', 36, 36, true );
	add_image_size( 'blogb-thumb', 546, 300, true );
	add_image_size( 'blog-thumb', 179, 120, true );
	add_image_size( 'media-thumb', 179, 116, true );
	add_image_size( 'media1-thumb', 367, 237, true );
	add_image_size( 'catslider-thumb', 576, 392, true );
	add_image_size( 'catslider1-thumb', 702, 432, true );
	
	
	add_image_size( 'big-thumb-hd', 765, 510, true );
	
	//widgets
	add_image_size( 'postlist-thumb', 170, 113, true );
	add_image_size( 'sliderwidget-thumb', 333, 227, true );
	add_image_size( 'postpicwid-thumb', 81, 55, true );

$mn_thumbs_sizes = array(
'thumbnail' => array(get_option( 'thumbnail_size_w' ), get_option( 'thumbnail_size_h' )),
'medium' => array(get_option( 'medium_size_w' ), get_option( 'medium_size_w' )),
'large' => array(get_option( 'large_size_w' ), get_option( 'large_size_w' )),
'full' => array('', ''),
'scroller-thumb' => array(274, 183, true ),
'nb1-thumb' => array(364, 245, true ),
'nb3-thumb' => array(80, 54, true ),
'nb5-thumb' => array(130, 87, true ),
'npic-thumb' => array(359, 240, true ),
'np-thumb' => array(85, 57, true ),
'slider-thumb' => array(546, 365, true ),
'newstabs-thumb' => array(266, 179, true ),
'related-thumb' => array(165, 109, true ),
'search-grid' => array(347, 233, true ),
'megamenu-thumb' => array(112, 75, true ),
'search-thumb' => array(36, 36, true ),
'blogb-thumb' => array(546, 300, true ),
'blog-thumb' => array(179, 120, true ),
'media-thumb' => array(179, 116, true ),
'media1-thumb' => array(367, 237, true ),
'catslider-thumb' => array(576, 392, true ),
'catslider1-thumb' => array(702, 432, true ),
'big-thumb-hd' => array(765, 510, true ),
'postlist-thumb' => array(170, 113, true ),
'sliderwidget-thumb' => array(333, 227, true ),
'postpicwid-thumb' => array(81, 55, true ),
);

/* ==========================================================================
 *                Body classes
   ========================================================================== */
function mom_body_classes( $classes ) {
$hst = mom_option('header_style');
$bnmenu = mom_option('bn_bar_menu');
$custom_layout = '';
$site_width = mom_option('site_width');
$mom_post_layout = mom_option('post_layout');
if ( is_singular() ) {
global $post;
$custom_layout = get_post_meta(get_queried_object_id(), 'mom_background_tr', true);
$layout = get_post_meta(get_queried_object_id(), 'mom_page_layout', true);

      if(function_exists('is_bbpress') && is_bbpress()) {
	if ($layout == '') { $layout = mom_option('bbpress_layout');}
	if(function_exists('is_buddypress') && is_buddypress()) {
	if (get_post_meta(get_queried_object_id(), 'mom_page_layout', true) == '') { $layout = mom_option('buddypress_layout');}
	}

      } elseif(function_exists('is_buddypress') && is_buddypress()) {
	if ($layout == '') { $layout = mom_option('buddypress_layout');}
      } else {
	if ($layout == '') { $layout = mom_option('main_layout');}
      }

if ($layout == '') { $layout = mom_option('main_layout'); }
    $mom_post_layout = get_post_meta($post->ID, 'mom_post_layout', true);
    
    if ($mom_post_layout == '') {
	$mom_post_layout = mom_option('post_layout');
    }


} elseif (function_exists('is_bbpress') && is_bbpress()) {
	$layout = mom_option('bbpress_layout');
	if ($layout == '') {
	    $layout = mom_option('main_layout');  
	}
} elseif (function_exists('is_buddypress') && is_buddypress()) {
	$layout = mom_option('buddypress_layout');
	if ($layout == '') {
	    $layout = mom_option('main_layout');  
	}
} else {
$layout = mom_option('main_layout');  
}


if(function_exists('is_woocommerce') && is_woocommerce()) {
    $woo_page_id = '';
if (is_shop()) {
    $woo_page_id = get_option('woocommerce_shop_page_id');
} elseif (is_cart()) {
    $woo_page_id = get_option('woocommerce_cart_page_id');
} elseif (is_checkout()) {
    $woo_page_id = get_option('woocommerce_checkout_page_id');
} elseif (is_account_page()) {
    $woo_page_id = get_option('woocommerce_myaccount_page_id');
} else {
    $woo_page_id = get_option('woocommerce_shop_page_id');
}
$layout = get_post_meta($woo_page_id, 'mom_page_layout', true);
if ($layout == '') {
  $layout = mom_option('main_layout'); 
}

$custom_layout = get_post_meta($woo_page_id, 'mom_background_tr', true);

}

if (is_archive()) {
  $layout = mom_option('category_layout');
  if ($layout == '') {
    $layout = mom_option('main_layout');
  }
}

	if ($layout != '') {
	    $classes[] = $layout;
	}
	
	if ($layout == 'right-sidebar' || $layout == 'left-sidebar' ) {
	    if ($site_width != 'wide') {
		$classes[] = 'col2';
	    }
	} 
	    if ($site_width == 'wide') {
		$classes[] = 'one-side-wide';
	    }
	
	global $post;	
	if (strpos(mom_option('main_layout'),'both') === false && get_post_meta($post->ID, 'mom_page_layout', true) == 'fullwidth') {
	    if ($site_width != 'wide') {
		$classes[] = 'col2';
	    }
	    if ($site_width == 'wide') {
		$classes[] = 'one-side-wide';
	    }
	}
	
	if ($layout != 'right-sidebar' && $layout != 'left-sidebar') {
		$classes[] = 'both-sides-true';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}
	
	if ($hst == 'st1') {
		$classes[] = 'hst1';
	} elseif ($hst == 'st2') {
		$classes[] = 'hst2';
	} elseif ($hst == 'st3') {
		$classes[] = 'hst3';
	} else {
		$classes[] = '';
	}
	
	if (mom_option('fade_imgs') == 1) {
	    $classes[] = 'fade-imgs-in-appear';
	}
	
	if (mom_option('sticky_navigation') == 1) {
	    $classes[] = 'sticky_navigation_on';
	}
	
	if (mom_option('post_format_icons') == 0) {
	    $classes[] = 'no-post-format-icons';
	}
	
	if($bnmenu == false) {
		$classes[] = 'no-bnmenu';
	}
	
	if($custom_layout == true && get_post_meta($post->ID, 'mom_page_layout', true) == 'fullwidth') {
		$classes[] = 'custom-layout';
	}
	
	
	if($mom_post_layout == 'layout1'){
		$classes[] = 'post-page-layout1';
	} elseif($mom_post_layout == 'layout2'){
		$classes[] = 'post-page-layout2';
	} elseif($mom_post_layout == 'layout3'){
		$classes[] = 'post-page-layout3';
	} elseif($mom_post_layout == 'layout4'){
		$classes[] = 'post-page-layout4';
	}

	return $classes;
}
add_filter( 'body_class', 'mom_body_classes' );

/* ==========================================================================
 *                GeT Years
   ========================================================================== */
function mom_get_years($name, $args = '') {
	global $wpdb, $wp_locale;

	$defaults = array(
		'type' => 'monthly',
                'limit' => '',
		'format' => 'html',
		'echo' => 0,
                'order' => 'DESC',
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	if ( '' == $type )
		$type = 'monthly';

	if ( '' != $limit ) {
		$limit = absint($limit);
		$limit = ' LIMIT '.$limit;
	}

	$order = strtoupper( $order );
	if ( $order !== 'ASC' )
		$order = 'DESC';

	$where = apply_filters( 'getarchives_where', "WHERE post_type = 'post' AND post_status = 'publish'", $r );
	$join = apply_filters( 'getarchives_join', '', $r );

	$output = '';

	$last_changed = wp_cache_get( 'last_changed', 'posts' );
	if ( ! $last_changed ) {
		$last_changed = microtime();
		wp_cache_set( 'last_changed', $last_changed, 'posts' );
	}

		$query = "SELECT YEAR(post_date) AS `year`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date) ORDER BY post_date $order $limit";
		$key = md5( $query );
		$key = "wp_get_archives:$key:$last_changed";
		if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
			$results = $wpdb->get_results( $query );
			wp_cache_set( $key, $results, 'posts' );
		}
		if ( $results ) {
			foreach ( (array) $results as $result) {
				$text = sprintf('%d', $result->year);
				$output .= mom_get_years_text( $text, $name);
                                
			}
		}

	if ( $echo )
		echo $output;
	else
		return $output;
}

function mom_get_years_text( $text,$name = '', $format = 'option', $before = '', $after = '') {
	$text = wptexturize($text);
    if (isset($_GET[$name])) {
        $name = $_GET[$name];
    }
	if ('link' == $format)
		$link_html = "\t<link rel='archives' title='" . esc_attr( $text ) . "' href='$text' />\n";
	elseif ('option' == $format)
		$link_html = "\t<option value='$text'".selected($name , $text).">$before $text $after</option>\n";
	elseif ('html' == $format)
		$link_html = "\t<li>$before<a href='$text'>$text</a>$after</li>\n";
	else // custom
		$link_html = "\t$before<a href='$text'>$text</a>$after\n";

	//$link_html = apply_filters( 'get_archives_link', $link_html );

	return $link_html;
}

/* ==========================================================================
 *                Login Form
   ========================================================================== */
function mom_login_form( $login_only  = 0 ) {
	global $user_ID, $user_identity, $user_level;
	
	if ( $user_ID ) : ?>
		<?php if( empty( $login_only ) ): ?>

		<div id="user-login">
			<span class="author-avatar"><?php echo get_avatar( $user_ID, $size = '85'); ?></span>
			<h2 class="welcome-text"><?php _e( 'Welcome' , 'framework' ) ?> <strong><?php echo $user_identity ?></strong>.</h2>
			<ul class="user-login-links">
				<li><a href="<?php echo home_url() ?>/wp-admin/profile.php"><i class="enotype-icon-vcard"></i><?php _e( 'Your Profile' , 'framework' ) ?> </a></li>
				<li><a href="<?php echo wp_logout_url(); ?>"><i class="enotype-icon-logout"></i><?php _e( 'Logout' , 'framework' ) ?> </a></li>
			</ul>
			<div class="clear"></div>
			
			<div class="clear"></div>
		</div>
		<?php endif; ?>
	<?php else: ?>		
		<div class="login-widget">
	        <form action="<?php echo home_url() ?>/wp-login.php" method="post">
	            <div class="login-input-wrap login-user-wrap"><span class="momizat-icon-user3"></span><input type="text" class="login-user" name="log" id="log" value="<?php _e( 'Username' , 'framework' ) ?>" onfocus="if (this.value == '<?php _e( 'Username' , 'framework' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'Username' , 'framework' ) ?>';}"></div>
	            <div class="login-input-wrap login-pwd-wrap"><span></span><input type="password" class="login-pwd" name="pwd" id="pwd" value="<?php _e( 'Password' , 'framework' ) ?>" onfocus="if (this.value == '<?php _e( 'Password' , 'framework' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'Password' , 'framework' ) ?>';}"></div>
	            <input type="submit" class="login-button" name="submit" value="<?php _e( 'login' , 'framework' ) ?>">
	            <input class="rememberme" name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever">
	            <label for="rememberme"><?php _e( 'Remember Me' , 'framework' ) ?></label>
	            <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
	        </form>
	        <ul class="login-links">
	        	<?php if ( get_option('users_can_register') ) : ?> <li><a href="<?php echo home_url() ?>/wp-register.php"><?php _e( 'Register' , 'framework' ) ?></a></li><?php endif; ?>
	            <li><a href="<?php echo home_url() ?>/wp-login.php?action=lostpassword"><?php _e( 'Lost your password?' , 'framework' ) ?></a></li>
	        </ul>
	    </div>
	<?php endif;
}

/* ==========================================================================
 *                Category Options
   ========================================================================== */
add_action ( 'edit_category_form_fields', 'mom_category_style');
    function mom_category_style( $tag ) {
	$t_id = $tag->term_id;
	$cat_meta = get_option( "category_$t_id");
    ?>
    <tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Category Posts Layout', 'framework'); ?></label></th>
	<td>	
	<label for="cat_layout">
		<select name="Cat_meta[layout]" id="cat_layout">
		    <?php
			if (!isset($cat_meta['layout'])) { $cat_meta['layout'] = ''; }
		    ?>
			<option value=""><?php _e('Posts Layout...', 'framework'); ?></option>
			<option value="def" <?php selected($cat_meta['layout'], 'def'); ?>><?php _e('Default Layout', 'framework'); ?></option>
			<option value="blog" <?php selected($cat_meta['layout'], 'blog'); ?>><?php _e('Blog Layout', 'framework'); ?></option>
		</select>
	    <br /><span class="description"><?php _e('select category layout', 'framework'); ?></span>
	</label>
	</td>
	</tr>
	<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Category blog Layout style', 'framework'); ?></label></th>
	<td>	
	<label for="cat_layout">
		<select name="Cat_meta[layout_style]" id="cat_layout_style">
		    <?php
			if (!isset($cat_meta['layout_style'])) { $cat_meta['layout_style'] = ''; }
		    ?>
			<option value=""><?php _e('Blog Posts Layout style...', 'framework'); ?></option>
			<option value="" <?php selected($cat_meta['layout_style'], ''); ?>><?php _e('Default Style', 'framework'); ?></option>
			<option value="large" <?php selected($cat_meta['layout_style'], 'large'); ?>><?php _e('Big Style', 'framework'); ?></option>
		</select>
	    <br /><span class="description"><?php _e('select category blog Layout style if you choose blog in category posts layout', 'framework'); ?></span>
	</label>
	</td>
	</tr>
	<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Color'); ?></label></th>
	<td>
	<input id="color" class="mom_color_picker" name="Cat_meta[color]" type="text" value="<?php echo $cat_meta['color'] ? $cat_meta['color'] : ''; ?>"/><br />
	<div id="colorpicker"></div>
	</td>
	</tr>
	
	<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Background Image'); ?></label></th>
	<td>	
	<label for="upload_image">
	    <input id="upload_image" type="text" size="36" name="Cat_meta[bg]" value="<?php echo $cat_meta['bg'] ? $cat_meta['bg'] : ''; ?>" style="width: auto !important;"/> 
	    <input id="upload_image_button" class="button" type="button" value="Upload Image" style="width: auto !important;"/>
	    <br /><span class="description"><?php _e('Enter a URL or upload an image', 'framework'); ?></span>
	</label>
	</td>
	</tr>

	<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Custom Main Sidebar', 'framework'); ?></label></th>
	<td>	
	<label for="cat_sidebar">
		<?php
			$sidebars = $GLOBALS['wp_registered_sidebars'];
		?>
		<select name="Cat_meta[sidebar]" id="cat_sidebar">
			<option value=""><?php _e('Select Sidebar ...', 'framework'); ?></option>
			<?php foreach ($sidebars as $sidebar) { 
				echo '<option value="'.$sidebar['id'].'"'. selected($cat_meta['sidebar'], $sidebar['id']).'>'.$sidebar['name'].'</option>';
			} ?>
		</select>
	    <br /><span class="description"><?php _e('select category main sidebar', 'framework'); ?></span>
	</label>
	</td>
	</tr>
	
	<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Custom Secondary Sidebar', 'framework'); ?></label></th>
	<td>	
	<label for="cat_ssidebar">
		<?php
			$ssidebars = $GLOBALS['wp_registered_sidebars'];
		?>
		<select name="Cat_meta[ssidebar]" id="cat_ssidebar">
			<option value=""><?php _e('Select Sidebar ...', 'framework'); ?></option>
			<?php foreach ($ssidebars as $ssidebar) { 
				echo '<option value="'.$ssidebar['id'].'"'. selected($cat_meta['ssidebar'], $ssidebar['id']).'>'.$ssidebar['name'].'</option>';
			} ?>
		</select>
	    <br /><span class="description"><?php _e('select category secondary sidebar', 'framework'); ?></span>
	</label>
	</td>
	</tr>

	<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Icon', 'framework'); ?></label></th>
	<td>
		<div class="mom_icons_selector">
		<a href="#" class="mom_select_icon button"><?php _e('Select Icon', 'framework'); ?></a><span class="or">or</span><a href="#" class="mom_upload_icon button simptip-position-top simptip-movable simptip-multiline" data-tooltip="<?php _e('Best Icon size is : 24px', 'framework'); ?>"><?php _e('Upload custom Icon', 'framework'); ?></a>
		<span class="mom_icon_prev"><i></i><a href="#" class="remove_icon enotype-icon-cross2" title="Remove Icon"></a></span>
		<input name="Cat_meta[icon]" class="mom_icon_holder" type="hidden" value="<?php echo $cat_meta['icon'] ? $cat_meta['icon'] : ''; ?>"/><br />
		<br /><span class="description"><?php _e('select category icon', 'framework'); ?></span>
		</div>
	</td>
	</tr>
	<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Category Slider', 'framework'); ?></label></th>
	<td>	
	<label for="cat_slider">
		<select name="Cat_meta[slider]" id="cat_slider">
		    <?php
			if (!isset($cat_meta['slider'])) { $cat_meta['slider'] = ''; }
		    ?>
			<option value=""><?php _e('None', 'framework'); ?></option>
			<option value="1" <?php selected($cat_meta['slider'], '1'); ?>><?php _e('Enable', 'framework'); ?></option>
			<option value="0" <?php selected($cat_meta['slider'], '0'); ?>><?php _e('Disable', 'framework'); ?></option>
		</select>
	    <br /><span class="description"><?php _e('enable or disable category slider, none mean this option will depend on theme options -> category settings', 'framework'); ?></span>
	</label>
	</td>
	</tr>
    <?php
    }
add_action ( 'edited_category', 'save_mom_category_style');
    function save_mom_category_style( $term_id ) {
	if ( isset( $_POST['Cat_meta'] ) ) {
	$t_id = $term_id;
	$cat_meta = get_option( "category_$t_id");
	$cat_keys = array_keys($_POST['Cat_meta']);
	foreach ($cat_keys as $key){
	if (isset($_POST['Cat_meta'][$key])){
	$cat_meta[$key] = $_POST['Cat_meta'][$key];
	}
    }
update_option( "category_$t_id", $cat_meta );
}
}

add_action ( 'edit_category_form_fields', 'add_styles_scripts_color');
add_action ( 'category_add_form_fields', 'add_styles_scripts_color');
function add_styles_scripts_color(){
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_script( 'mom-cats-settings', get_template_directory_uri() . '/framework/helpers/js/cats.js' );
    wp_enqueue_media();
    }
// ajax Action
add_action( 'wp_ajax_mom_loadIcon', 'mom_icon_container' );  

/* ==========================================================================
 *                Timeline
   ========================================================================== */
function mom_posts_timeline($custom_query='') { ?>
<div class="mom-blog-timeline clearfix"  data-count="8">
		     <!--<div class="tl-years">-->
<?php
		$post_meta_hp = mom_option('post_meta_hp');
if($post_meta_hp == 1) {
		$post_head = mom_option('post_head');
		$post_head_author = mom_option('post_head_author');
		$post_head_date = mom_option('post_head_date');
		$post_head_cat = mom_option('post_head_cat');
		$post_head_commetns= mom_option('post_head_commetns');
		$post_head_views = mom_option('post_head_views');
		} else {
		$post_head = 1;
		$post_head_author = 1;
		$post_head_date = 1;
		$post_head_cat = 1;
		$post_head_commetns= 1;
		$post_head_views = 1;
		}

global $wp;
if ($custom_query == '') {
$wp->query_vars['posts_per_page'] = -1;
$wp->query_vars['suppress_filters'] = 0;
$custom_query = $wp->query_vars;		
}
//print_r($custom_query);

$all_posts = get_posts($custom_query);

// this variable will contain all the posts in a associative array
// with three levels, for every year, month and posts.

$ordered_posts = array();

foreach ($all_posts as $single) {

  $year  = mysql2date('Y', $single->post_date);
  $month = mysql2date('F', $single->post_date);
  $day = mysql2date('j', $single->post_date);

  // specifies the position of the current post
  $ordered_posts[$year][$month][$day][] = $single;

}

// iterates the years
foreach ($ordered_posts as $year => $months) { ?>
    <?php foreach ($months as $month => $days ) { // iterates the moths ?>
		<?php
			$t_class = 'closed';
		?>
		<div class="tl-month">
	<span class="blog-timeline-date"><?php echo $month.', '.$year; ?></span>
        <ul class="tl-posts">
          <?php foreach ($days as $day => $posts ) { // iterates the posts ?>
          <?php foreach ($posts as $single ) { // iterates the posts ?>

	      <li class="nb5">
		    <div <?php post_class('first-item',$single->ID); ?> role="article" itemscope="" itemtype="http://schema.org/Article">
			<h2 itemprop="name"><a itemprop="url" href="<?php echo get_permalink($single->ID); ?>"><?php echo get_the_title($single->ID); ?></a></h2>
			<?php if( mom_post_image('','',$single->ID) != false ) { ?>
			<figure class="post-thumbnail"><a href="<?php echo get_permalink($single->ID); ?>">
			<img itemprop="image" src="<?php echo mom_post_image('nb5-thumb','', $single->ID ); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd','', $single->ID); ?>" alt="<?php echo get_the_title($single->ID); ?>">
			<span class="post-format-icon"></span>
			</a></figure>
			<?php } ?>
			<?php if( mom_post_image() != false ) { 
            	$mom_class = ' class="fix-right-content"';    
            } else {
                $mom_class = '';
            }
            ?>
            <div<?php echo $mom_class; ?>>
			<div class="entry-content">
			<p>
			<?php
			$post_content = get_post($single->ID);
			
			$excerpt = $post_content->post_excerpt;
			if($excerpt == ''){
			$excerpt = $post_content->post_content;
			}
			echo wp_html_excerpt(strip_shortcodes($excerpt), 100);
			?> ...
			</p>
			</div>
			<?php if($post_head != 0) { ?>
			<div class="entry-meta">
			<?php if($post_head_date != 0) { ?>
			<time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><i class="momizat-icon-calendar"></i><?php echo mysql2date(mom_option('date_format'), $single->post_date); ?></time>
			<?php } ?>
			<?php if($post_head_commetns != 0) { ?>
			<div class="comments-link">
			<i class="momizat-icon-bubbles4"></i><a href="<?php echo get_permalink($single->ID); ?>">
			    	<?php
					$num_comments = get_comments_number($single->ID); // get_comments_number returns only a numeric value
						if ( comments_open() ) {
							if ( $num_comments == 0 ) {
								$comments = __('0 Comments', 'framework');
							} elseif ( $num_comments > 1 ) {
								$comments = $num_comments . __(' Comments', 'framework');
							} else {
								$comments = __('1 Comment', 'framework');
							}
							$write_comments = '<a class="comment_number" href="' . get_comments_link($single->ID) .'">'. $comments.'</a>';
						} else {
							//$write_comments =  __('Comments off', 'framework');
							$write_comments = '';
						}
				?>
								<?php echo $write_comments; ?>

			</a>
			</div>
			<?php } ?>
			</div>
			<?php } ?>
            </div>
		    </div>
		</li>

          <?php } // ends foreach $posts ?>
		
         <?php } // ends foreach $days ?>
        </ul> <!-- ul.posts -->
	</div>
    <?php } // ends foreach for $months ?>

 <!-- </div>--> <?php
} // ends foreach for $ordered_posts
?>
		<a href="#" class="blog-timeline-more" data-offset="8"><?php _e('Show More post', 'framework'); ?><span class="enotype-icon-arrow-down2"></span></a>
</div> <!--.mom-timeline-->
<?php }

/* ==========================================================================
 *                Content ads
   ========================================================================== */
add_action('mom_before_content', 'mom_content_ads');
function mom_content_ads() {
  $posh = mom_option('content_ads_position');
  $rs = mom_option('content_right_banner_id');
  $ls = mom_option('content_left_banner_id');
  $pos = '';
  if (is_singular()) {
	global $post;
    $poshs = get_post_meta($post->ID, 'mom_content_ads_fixed', true);
    if ($poshs != '') {
      $posh = $poshs;
    }

	$prs = get_post_meta($post->ID, 'mom_content_right_banner', true);
	$pls = get_post_meta($post->ID, 'mom_content_left_banner', true);
	
	if ($prs != '') {
	  $rs = $prs;
	}
	if ($pls != '') {
	  $ls = $pls;
	}
  }  


  if ($posh == 1) {
    $pos = 'mca-fixed';
  }    
?>

<?php if ($rs != '') { ?>
  <div class="mom_contet_ads mc-ad-right <?php echo $pos; ?>">
      <?php echo do_shortcode('[ad id="'.$rs.'"]'); ?>
  </div>
<?php } ?>
<?php if ($ls != '') { ?>
  <div class="mom_contet_ads mc-ad-left <?php echo $pos; ?>">
      <?php echo do_shortcode('[ad id="'.$ls.'"]'); ?>
  </div>
<?php } ?>
<?php }
/* ==========================================================================
 *                Category page content
   ========================================================================== */
function mom_category_content ($cols = 2) {
  $cols = 'grid-col-'.$cols;
                          		if(mom_option('cat_posts_layout') == 'blog' || $cat_layout == 'blog') { 
	                        		$style = '';
	                        		if(mom_option('cat_posts_layout_style') == 'large' || $cat_layout_style == 'large') {
		                        		$style = 'large';
	                        		} else {
		                        		$style = '';
	                        		}
                        		?>
                               		<div class="blog_posts">
                               		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							   			<?php mom_blog_post($style); ?>
                               		<?php
                                    endwhile;
                                    else:  ?>
                                    <!-- Else in here -->
                                    <?php endif; ?>
                                    <?php mom_pagination(); ?>
                               		</div>
                               		<?php } else { ?>
                            <div class="site-content page-wrap">
	                                <?php if(mom_option('cat_swi')) { ?>
	                                <div class="f-tabbed-head">
	                                    <ul class="f-tabbed-sort cat-sort">
	                                        <li class="grid active"><a href="#"><span class="brankic-icon-grid"></span><?php _e(' Grid', 'framework') ?></a></li>
	                                        <li class="list"><a href="#"><span class="brankic-icon-list2"></span><?php _e(' List', 'framework') ?></a></li>
	                                    </ul>
	                                </div>
	                                <?php } ?>
	                                
	                                <?php 
	                                $catswi = mom_option('cat_swi_def');
	                                $swiclass = 'cat-grid '.$cols;
	                                if($catswi == 'list') {
		                                $swiclass = 'cat-list';
	                                }
	                                $srclass = '';
	                                if(mom_option('cat_swi') != true) {
		                                $srclass = ' no-head';	
	                                }
	                                ?>
	                                <div class="cat-body<?php echo $srclass; ?>">
	                                    <ul class="nb1 <?php echo $swiclass; ?> clearfix">
	                                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	                                        <li <?php post_class(); ?> itemscope="" itemtype="http://schema.org/Article">
	                                            <h2 itemprop="name" class="cat-list-title"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	                                            <?php if($post_head != 0) { ?>
	                                            <div class="cat-list-meta entry-meta">
	                                                <?php if($post_head_author != 0) { ?>
	                                                <div class="author-link">
	                                                <?php _e('Posted by', 'framework') ?> <a itemprop="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" rel="author"><?php echo get_the_author() ?></a>
	                                                </div>
	                                                <?php } ?>
	                                                <?php if($post_head_date != 0) { ?>
	                                                <span>|</span><time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><?php _e('Date: ', 'framework') ?><?php the_time($dateformat); ?></time> 
	                                                <?php } ?>
	                                                <?php if($post_head_commetns != 0) { ?>
	                                                <div class="comments-link">
	                                                <span>|</span><a href="<?php the_permalink(); ?>"> <?php comments_number(__( '0 comments', 'framework' ), __( '(1) Comment', 'framework' ),__( '(%) Comments', 'framework' )); ?></a>
	                                                </div>
	                                                <?php } ?>
	                                                <?php if($post_head_views != 0) { ?>
	                                                <div class="post-views">
	                                                <span>|</span><?php echo getPostViews(get_the_ID()); ?>
	                                                </div>
	                                                <?php } ?>
	                                            </div>
	                                            <?php } ?>
	                                            <?php if( mom_post_image() != false ) { ?>
	                                            <figure class="post-thumbnail"><a href="<?php the_permalink(); ?>">
	                                                <img itemprop="image" src="<?php echo mom_post_image('nb1-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>">
	                                                <span class="post-format-icon"></span>
	                                            </a></figure>
	                                            <?php } ?>
	                                            <h2 itemprop="name" class="cat-grid-title"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	                                            <div class="entry-content cat-grid-meta">
	                                                <p>
	                                                    <?php global $post;
	                                                    $excerpt = $post->post_excerpt;
	                                                    if($excerpt==''){
	                                                    $excerpt = get_the_content('');
	                                                    }
	                                                    echo wp_html_excerpt(strip_shortcodes($excerpt),105);
	                                                    ?> ...
	                                                </p>
	                                            </div>
	                                            <?php 
	                                            if( mom_post_image() != false ) { 
		                                        	$mom_class = ' class="fix-right-content"';    
		                                        } else {
			                                        $mom_class = '';
		                                        }
	                                            ?>
	                                            
	                                            <div<?php echo $mom_class; ?>>
		                                            <div class="entry-content cat-list-meta">
		                                                <p>
		                                                    <?php global $post;
		                                                    $excerpt = $post->post_excerpt;
		                                                    if($excerpt==''){
		                                                    $excerpt = get_the_content('');
		                                                    }
		                                                    echo wp_html_excerpt(strip_shortcodes($excerpt),200);
		                                                    ?> ...
		                                                </p>
		                                            </div>
		                                            <?php if($post_head != 0) { ?>
		                                            <div class="cat-grid-meta entry-meta">
		                                            	<?php if($post_head_date != 0) { ?>
		                                                <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><?php the_time($dateformat); ?> </time>
		                                                <?php } ?>
		                                                <?php if($post_head_author != 0) { ?>
		                                                <div class="author-link">
		                                                    |<?php _e(' by ', 'framework') ?><a itemprop="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" rel="author"><?php echo get_the_author() ?></a>
		                                                </div>
		                                                <?php } ?>
		                                                <?php if($post_head_commetns != 0) { ?>
		                                                <div class="comments-link">
		                                                    |<a href="<?php the_permalink(); ?>"> <?php comments_number(__( '0 comments', 'framework' ), __( '(1) Comment', 'framework' ),__( '(%) Comments', 'framework' )); ?></a>
		                                                </div>
		                                                <?php } ?>
		                                            </div>
		                                            <?php } ?>
		                                            <?php if(is_rtl()) { ?>
		                                            <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read more', 'framework'); ?> <i class="fa-icon-double-angle-left"></i></a>
		                                            <?php } else { ?>
		                                            <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read more', 'framework'); ?> <i class="fa-icon-double-angle-right"></i></a>
													<?php } ?>
	                                            </div>	
	                                        </li>
	                                        <?php
	                                        endwhile;
	                                        else:  ?>
	                                        <!-- Else in here -->
	                                        <?php endif; ?>
	                                    </ul>
	                                    
	                                    <?php mom_pagination(); ?>
	                                </div>
                            </div>
                            <?php } 
		      
}

/* ==========================================================================
 *                Allow SVG in media uploader 
   ========================================================================== */
function mom_custom_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'mom_custom_mime_types' );

?>