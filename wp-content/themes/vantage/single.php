<?php
/**
 * The Template for displaying all single posts.
 *
 * @package vantage
 * @since vantage 1.0
 * @license GPL 2.0
 */


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
if(isset($catDetail->cat_name)) {
	$catName = $catDetail->cat_name;
}

if($catName == '') {
	$category = get_the_category(); 
	$catName = $category[0]->cat_name;
}


get_header(); ?>

<a class="cat-title-link" href="http://headstuff.org/index.php/<?php echo $catName;?>/">
<div id="cat-title" class="cat-title-<?php
echo $catName;
?>">
<h1 ><?php 
echo $catName;
?></h1></div>
</a>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>

		<?php if( siteorigin_setting('navigation_post_nav') ) vantage_content_nav( 'nav-below' ); ?>

		<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
			<?php comments_template( '', true ); ?>
		<?php endif; ?>

	<?php endwhile; // end of the loop. ?>

	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->
<div style="visibility: hidden;"><?php echo $catName ?></div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>