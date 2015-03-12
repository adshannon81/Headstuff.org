<?php
/**
 * Part Name: Default Masthead
 */


$header_image = "http://headstuff.org/wp-content/uploads/2014/03/home.png";
$title = "";

if(is_single()) {
	$postID = get_the_ID();
	$catID= $wpdb->get_var( $wpdb->prepare( 
		"
			SELECT meta_value
			FROM $wpdb->postmeta 
			WHERE meta_key = '_category_permalink' 
			AND post_id = %s
		", 
		$postID 
	) );
	$catDetail = get_category( $catID );
	$catName = '';
	
	if(isset($catDetail->name)) {
    $catName = $catDetail->name;
	}

if($catName == '') {
		$category = get_the_category(); 
		if($category)
		{
			$catName = $category[0]->cat_name;
		}
	}
	
	//if($catName == 'Legends of the Months' || $catname == 'Terrible People from History')
 if($catName == 'Topical' || $catName == 'History' || $catName == 'Literature' || $catName == 'Science' || $catName == 'Visual' || $catName == 'Humour' || $catName == 'Music' || $catName == 'Film' ) 
{
$catName = $catName;
} 
else
{
		$catName = 'Home';
	}

	$header_image = "http://headstuff.org/wp-content/uploads/2014/03/".$catName.".png";
	
	
}
elseif (is_page()){
	$title = get_the_title();
	//if($title == '' || $title == 'Legends of the Months')
	if($title != 'Topical' && $title != 'History' && $title != 'Literature' && $title != 'Science' && $title != 'Visual' && $title != 'Humour' && $title != 'Music' && $title != 'Film' ) 
	{
		$title = 'Home';
	}
	elseif($title == 'Contact Us'){
		$title = 'Contact';
	}
	$header_image = "http://headstuff.org/wp-content/uploads/2014/03/".$title.".png";
}

?>
<header id="masthead" class="site-header <?php echo $title ?>" role="banner">

	<div class="full-container hgroup">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="logo"><img src="<?php echo $header_image ?>"  alt="HeadStuff.org"/></a>

		<?php if( is_active_sidebar('sidebar-header') ) : ?>

			<div id="header-sidebar">
				<?php dynamic_sidebar( 'sidebar-header' ); ?>
			</div>

		<?php else : ?>

			<div class="support-text">
				<a href="http://www.facebook.com/theheadstuff" title="facebook" target="_blank">				
					<img src="http://qwerty.ie/headstuff/wp-content/uploads/2014/02/facebook.png" alt="facebook"/>
				</a>
				<a href="http://twitter.com/thisheadstuff" title="twitter" target="_blank">				
					<img src="http://qwerty.ie/headstuff/wp-content/uploads/2014/02/twitter.png" alt="twitter"/>
				</a>

			</div>

		<?php endif; ?>

	</div><!-- hgroup.full-container -->

	<nav role="navigation" class="site-navigation main-navigation primary <?php if( siteorigin_setting('navigation_use_sticky_menu') ) echo 'use-sticky-menu' ?>">
		<div class="full-container">
			<?php if( siteorigin_setting('navigation_menu_search') ) : ?>
				<div id="search-icon">
					<div id="search-icon-icon"><div class="icon"></div></div>
					<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
						<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" />
					</form>
				</div>
			<?php endif; ?>

			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'link_before' => '<span class="icon"></span>' ) ); ?>
		</div>
	</nav><!-- .site-navigation .main-navigation -->

</header><!-- #masthead .site-header -->