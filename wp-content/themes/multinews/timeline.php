<?php
/*
Template Name: Timeline Page
*/
?>

<?php get_header(); ?>
<div class="main-container author-page timeline"><!--container-->
	<div class="full-main-content" role="main">
		<div class="site-content page-wrap">
			<?php mom_posts_timeline(array('posts_per_page' => -1, 'suppress_filters' => 0)); ?>
		</div>
	</div>
</div>
</div><!-- wrap -->
<?php get_footer(); ?>
