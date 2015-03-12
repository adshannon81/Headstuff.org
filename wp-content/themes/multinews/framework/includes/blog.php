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
?>
<article <?php post_class('blog-post nb1'); ?> itemscope="" itemtype="http://schema.org/Article">
	<h2 itemprop="name">
		<a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>
	<?php if($post_head != 0) { ?>
	<div class="entry-meta">
		<?php if($post_head_author != 0) { ?>
		<div class="author-link">
        <?php _e('Posted by ', 'framework') ?><a itemprop="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" rel="author"><?php echo get_the_author() ?></a>
        </div>
        <?php } ?>
        <?php if($post_head_date != 0) { ?>
		<span>|</span><time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><?php mom_date_format(); ?></time>
		<?php } ?>
		<?php if($post_head_cat != 0) { ?>
		<div class="cat-link">
        <span>|</span><?php _e('in :', 'framework') ?> <?php the_category(', ') ?>
        </div>
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
	<figure class="post-thumbnail">
		<a href="<?php the_permalink(); ?>">
			<img itemprop="image" src="<?php echo mom_post_image('blog-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>">
			<span class="post-format-icon"></span>
		</a>
	</figure>
	<?php } ?>
	<div class="entry-content">
		<?php 
			echo wp_html_excerpt(strip_shortcodes(get_the_content()), 170); 
		?>
	</div>
	<?php if(is_rtl()) { ?>
    <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read more', 'framework'); ?> <i class="fa-icon-double-angle-left"></i></a>
    <?php } else { ?>
    <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read more', 'framework'); ?> <i class="fa-icon-double-angle-right"></i></a>
	<?php } ?>
</article>