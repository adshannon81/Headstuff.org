<?php
	if ( is_singular()) {
	$layout = get_post_meta(get_queried_object_id(), 'mom_page_layout', TRUE);
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
	$site_width = mom_option('site_width');

	if (strpos($layout,'both') !== false) {

?>
<aside class="secondary-sidebar" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar"><!--secondary sidebar-->
	<?php
    if(is_home()) {
    
	    $homesidebar = mom_option('hp_lsidebar');
	    if($homesidebar)
	    dynamic_sidebar ( sanitize_title($homesidebar) );
	    else dynamic_sidebar( 'Secondary sidebar' );
	    
    } elseif (is_category()) {
    	
    	$cat_data = get_option("category_".get_query_var('cat'));
    	$cus_sidebar = isset($cat_data['ssidebar']) ? $cat_data['ssidebar'] : '' ;
    	$catsidebar = mom_option('cat_lsidebar');
    	
    	if (!empty($cus_sidebar)) {
		    dynamic_sidebar($cus_sidebar);
		} elseif($catsidebar) {
	    	dynamic_sidebar ( sanitize_title($catsidebar) );
	    } else { 
	    	dynamic_sidebar( 'Secondary sidebar' );
	    }
	    
	} elseif (is_single()) {
	    if(function_exists('is_bbpress') && is_bbpress()) {
		    $custom_sidebar = mom_option('bbpress_left_sidebar');
		    if(function_exists('is_buddypress') && is_buddypress()) {
			$custom_sidebar = mom_option('buddypress_left_sidebar');
		    }
		    if (!empty($custom_sidebar)) {
			dynamic_sidebar($custom_sidebar);		    
		    } else {
			dynamic_sidebar( 'Secondary sidebar' );
		    }
	    } elseif(function_exists('is_buddypress') && is_buddypress()) {
		    $custom_sidebar = mom_option('buddypress_left_sidebar');
		    if (!empty($custom_sidebar)) {
			dynamic_sidebar($custom_sidebar);		    
		    } else {
			dynamic_sidebar( 'Secondary sidebar' );
		    }
	    } else {
		
		global $post;
		$custom_sidebar = get_post_meta(get_queried_object_id(), 'mom_left_sidebar', TRUE);
		$postsidebar = mom_option('post_lsidebar');
		
		if (!empty($custom_sidebar)) {
		    dynamic_sidebar($custom_sidebar);		    
		} elseif($postsidebar) {
	    dynamic_sidebar ( sanitize_title($postsidebar) );
	    } else {
	    dynamic_sidebar( 'Secondary sidebar' );
	    }
	    }
	    
	} elseif(is_page()) {
	    if(function_exists('is_bbpress') && is_bbpress()) {
		    $custom_sidebar = mom_option('bbpress_left_sidebar');
		    if (!empty($custom_sidebar)) {
			dynamic_sidebar($custom_sidebar);		    
		    } else {
			dynamic_sidebar( 'Secondary sidebar' );
		    }
	    } elseif(function_exists('is_buddypress') && is_buddypress()) {
		    $custom_sidebar = mom_option('buddypress_left_sidebar');
		    if (!empty($custom_sidebar)) {
			dynamic_sidebar($custom_sidebar);		    
		    } else {
			dynamic_sidebar( 'Secondary sidebar' );
		    }
	    } else {		
		global $post;
		$custom_psidebar = get_post_meta(get_queried_object_id(), 'mom_left_sidebar', TRUE);
		$pagessidebar = mom_option('page_lsidebar');
		
		if (!empty($custom_psidebar)) {
		    dynamic_sidebar($custom_psidebar);		    
		} elseif($pagessidebar) {
	    dynamic_sidebar ( sanitize_title($pagessidebar) );
	    } else {
	    dynamic_sidebar( 'Secondary sidebar' );
	    }
	}
		
	} elseif(is_archive()) {
		
		$archivesidebar = mom_option('archive_lsidebar');

		if(function_exists ( "is_woocommerce" ) && is_woocommerce()) {
	
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
		
		$archivesidebar = get_post_meta($woo_page_id, 'mom_left_sidebar', TRUE);
	}
	
	if(function_exists('is_bbpress') && is_bbpress()) {
		    $archivesidebar = mom_option('bbpress_left_sidebar');
	} 

	if(function_exists('is_buddypress') && is_buddypress()) {
		    $archivesidebar = mom_option('buddypress_left_sidebar');
	} 
	    if($archivesidebar)
	    dynamic_sidebar ( sanitize_title($archivesidebar) );
	    else dynamic_sidebar( 'Secondary sidebar' );
	
	} else {
		
		dynamic_sidebar( 'Secondary sidebar' );
		
	}
	?>
</aside><!--secondary sidebar-->
<?php } ?>