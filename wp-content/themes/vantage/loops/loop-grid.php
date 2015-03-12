<?php
/**
 * Loop Name: Grid
 */
?>
<?php if( have_posts() ) : $i = 0; ?>

	<div class="vantage-grid-loop">
		<?php while( have_posts() ): the_post(); $i++ ?>

			<div class="article-wrapper">

			<article <?php post_class(array('grid-post')) ?>>
<!--
				<?php if( has_post_thumbnail() ) : ?>
					<a class="grid-thumbnail" href="<?php the_permalink() ?>">
						<?php the_post_thumbnail('vantage-grid-loop') ?>
					</a>
				<?php endif; ?>

				<p><a href="<?php the_permalink() ?>"><?php the_title() ?></a></p>
				<div class="excerpt"><?php the_excerpt() ?></div>
-->

<?php if( has_post_thumbnail() ) : $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'vantage-carousel'); ?>
						<a href="<?php the_permalink() ?>" style="background-image: url(<?php echo esc_url($img[0]) ?>)">
							<div class="overlay category-<?php
$category = get_the_category(); 
echo $category[0]->cat_name;
?>"><div class="overlay-text"><?php
$category = get_the_category(); 
echo $category[0]->cat_name;
?><br/>'<?php the_title() ?>' by <?php the_author(); ?></div></div>
						</a>
					<?php else : ?>
						<a href="<?php the_permalink() ?>" class="default-thumbnail"><div class="overlay category-<?php
$category = get_the_category(); 
echo $category[0]->cat_name;
?>"><div class="overlay-text"><?php
$category = get_the_category(); 
echo $category[0]->cat_name;
?><br/>'<?php the_title() ?>' by <?php the_author(); ?></div></div></a>
					<?php endif; ?>

			</article>
			</div><!-- end article-wrapper -->


		<!--	<?php if($i % 4 == 0) : ?><div class="clear"></div><?php endif; ?>  -->
		<?php endwhile; ?>
	</div>

	<?php vantage_content_nav( 'nav-below' ); ?>

<?php endif; ?>