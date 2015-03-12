<?php
$dateformat = mom_option('date_format');
?>
<div class="entry-post-meta">
	<?php if(mom_option('post_head_author') != 0) { ?>
    <div class="author-link"><?php _e('Posted by ', 'framework'); ?><a itemprop="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" rel="author"><?php echo get_the_author() ?></a></div>
    <?php } ?>
    <?php if(mom_option('post_head_date') != 0) { ?>
    <div><?php _e('Date: ', 'framework'); ?><time itemprop="dateCreated" class="entry-date updated" datetime="<?php the_time('c'); ?>"><?php the_time($dateformat); ?></time></div>
    <?php } ?>
    <?php if(mom_option('post_head_cat') != 0) { ?>
    <div class="entry-cat"><?php _e('in: ', 'framework') ?><?php the_category(', ') ?></div>
    <?php } ?>
    <?php if(mom_option('post_head_commetns') != 0) { ?>
    <div class="comments-link"><a href="#comments"><?php comments_number(__( 'Leave a comment', 'framework' ), __( '(1) Comment', 'framework' ),__( '(%) Comments', 'framework' )); ?></a></div>
    <?php } ?>
    <?php if(mom_option('post_head_views') != 0) { ?>
    <div class="post-views"><?php echo getPostViews(get_the_ID()); ?></div>
    <?php } ?>
    <?php edit_post_link( __( 'Edit', 'framework' ), '<div class="edit-link">', '</div>' ); ?>
</div>