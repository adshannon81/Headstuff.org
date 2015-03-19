<!DOCTYPE html>

<!--[if IE 8]> <html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]> <html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head>

<?php 
/*
 * Match wp_head() indent level
 */
?>
<meta name="blitz" content="mu-e800f202-c82e7eff-16650048-d243c98a">
<meta charset="UTF-8" />
<title><?php wp_title(''); // stay compatible with SEO plugins ?></title>


<link rel="pingback" href="http://www.headstuff.org/xmlrpc.php">
<link rel="shortcut icon" href="http://www.headstuff.org/wp-content/uploads/2015/02/hsfav1.ico">
<link rel="apple-touch-icon-precomposed" href="http://www.headstuff.org/wp-content/uploads/2015/02/hsfav2.png">

<?php wp_head(); ?>
	
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->


<?php


/*############  Get page Category #############*/
$logo_url = "http://headstuff.org/wp-content/uploads/2014/03/";
$header_image = $logo_url."home.png";

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


$header_image = $logo_url.$catName.".png";

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

$header_image = $logo_url.$title.".png";

}



elseif(is_category()) {

	$title = single_cat_title("", false);
  	if($title == 'Podcast' || $title == 'Shop') {
		$logo_url = "http://headstuff.org/wp-content/uploads/2015/02/";
  	}
  	
	$categoryID = get_cat_ID($title);
  	$categoryName = get_cat_name($categoryID);
	$ancestors = get_ancestors($categoryID, 'category');
  
  	if (empty($ancestors) == false) {
		$ancestorCategoryID = $ancestors[0];
		$ancestorTitle = get_cat_name($ancestorCategoryID);
		$header_image = $logo_url.$ancestorTitle.".png";

	}
  	else { $header_image = $logo_url.$categoryName.".png"; };
	  
	if($title == "Legends of the Months" || $title == "Featured") {
	
		$header_image = $logo_url."home.png";
	
  	}
		

}
  
  
/*############  End - Get page Category #############*/


?>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47318151-1', 'auto');
	ga('require', 'displayfeatures');
  ga('send', 'pageview');


</script>


</head>

<body <?php body_class(); ?>>

<div class="main-wrap">

	<div class="top-bar">

		<div class="wrap">
			<section class="top-bar-content">
			
				<div class="trending-ticker">
					<span class="heading"><?php echo Bunyad::options()->topbar_ticker_text; // filtered html allowed for admins ?></span>

					<ul>
						<?php $query = new WP_Query('orderby=date&order=desc'); ?>
						
						<?php while($query->have_posts()): $query->the_post(); ?>
						
							<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
						
						<?php endwhile; ?>
						
						<?php wp_reset_postdata(); ?>
					</ul>
				</div>

				<div class="search">
					<form action="<?php echo esc_url(home_url('/')); ?>" method="get">
						<input type="text" name="s" class="query" value="<?php the_search_query(); ?>" placeholder="<?php _e('Search...', 'bunyad'); ?>" />
						<button class="search-button" type="submit"><i class="fa fa-search"></i></button>
					</form>
				</div> <!-- .search -->

				<?php dynamic_sidebar('top-bar'); ?>
				
			</section>
		</div>
		
	</div>


	<div id="main-head" class="main-head">
		
		<div class="wrap">
		
		  <header class="<?php echo $title ?>"><!--<?php var_dump($categoryName); var_dump($title); var_dump(count($ancestors)); ?>--!>
			  <div class="title">
				<a href="http://headstuff.org" title="Headstuff" rel="home">
					<img src="<?php echo $header_image; ?>" class="logo-image" alt="Headstuff" />
				</a>
				
				</div>
				
				<div class="right">
					<?php 
						dynamic_sidebar('header-right');
					?>
				</div>
			</header>
			
			<nav class="navigation cf" data-sticky-nav="<?php echo Bunyad::options()->sticky_nav; ?>">
				<div class="mobile"><a href="#" class="selected"><span class="text"><?php _e('Navigate', 'bunyad'); ?></span><span class="current"></span> <i class="fa fa-bars"></i></a></div>
				
				<?php 
	
	if ( wp_is_mobile() ) { 
	
	$mobile = array(

    'menu'            => 'mobile-menu',
	'menu_class'      => 'menu',
	'fallback_cb'     => '',
	'walker'          => 'Bunyad_Menu_Walker');
	
	echo wp_nav_menu( $mobile ); 
}

	else { $desktop = array(
	'menu'            => 'category-menu',
	'menu_class'      => 'menu',
	'fallback_cb'     => '',
	'walker'          => 'Bunyad_Menu_Walker');
	echo wp_nav_menu( $desktop );
}

?>
			</nav>
			
		</div>
		
	</div>
	

	<div class="wrap">
		<?php Bunyad::core()->breadcrumbs(); ?>
	</div>
