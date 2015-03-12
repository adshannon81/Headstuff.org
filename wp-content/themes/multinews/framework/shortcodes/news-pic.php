<?php
function mom_news_pics($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => 'Latest Posts',
		'display' => '',
		'cat' => '',
		'tag' => '',
		'orderby' => '',
		'count' => '8',
	), $atts));
    
    ob_start();
    
    global $wpdb;
        $tag_ID = $wpdb->get_var("SELECT * FROM ".$wpdb->terms." WHERE 'name' = '".$tag."'");
        
        if($display == 'category') {
            $np_title = get_cat_name($cat);
            $np_link = get_category_link($cat);
        } elseif ($display == 'tag') {
            $np_title = $tag;
            $np_link = get_tag_link($tag_ID);
        } else {
            $np_title = $title;
            $np_link = '#';
        }
?>
<section class="section nip-box <?php if($display == 'category') { ?>cat_<?php echo $cat ; } ?>"><!--news pics-->
    <header class="block-title">
        <h2><?php echo $np_title; ?></h2>
    </header>
    
    <div class="nip clearfix">
            <?php
            if($display == 'category') {
            	$query = new WP_Query( array( 'cat' => $cat, 'posts_per_page' => 1, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
            } elseif($display == 'tag') {
            	$query = new WP_Query( array( 'tag' => $tag, 'posts_per_page' => 1, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
            } else {
            	$query = new WP_Query( array( 'posts_per_page' => 1, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
            }
            if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
            ?>
            <?php if( mom_post_image() != false ) { ?>
            <div class="first-item" itemscope="" itemtype="http://schema.org/Article">
                <figure class="post-thumbnail"><a class="simptip-position-top simptip-movable half-arrow simptip-multiline" itemprop="url" href="<?php the_permalink(); ?>" data-tooltip="<?php the_title(); ?>">
                    <img itemprop="image" src="<?php echo mom_post_image('npic-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>">
                </a></figure>
            </div>
            <?php } ?>
            <?php
            endwhile;
            else:
            endif;
            wp_reset_postdata();
            ?>
            <ul>
                    <?php
                    if($display == 'category') {
                    	$query = new WP_Query( array( 'cat' => $cat, 'posts_per_page' => $count, 'offset' => 1, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
                    } elseif($display == 'tag') {
                    	$query = new WP_Query( array( 'tag' => $tag, 'posts_per_page' => $count, 'offset' => 1, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
                    } else {
                    	$query = new WP_Query( array( 'posts_per_page' => $count, 'offset' => 1, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
                    }
                    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                    ?>
                    <?php if( mom_post_image() != false ) { ?>
                    <li class="simptip-position-top simptip-movable half-arrow simptip-multiline" data-tooltip="<?php the_title(); ?>" itemscope="" itemtype="http://schema.org/Article">
                    <figure class="post-thumbnail"><a itemprop="url" href="<?php the_permalink(); ?>">
                        <img itemprop="image" src="<?php echo mom_post_image('np-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>">
                    </a></figure>
                    </li>
                    <?php } ?>
                    <?php
                    endwhile;
                    else:
                    endif;
                    wp_reset_postdata();
                    ?>
            </ul>
        </div>
    
</section><!--news pics-->
<?php
$content = ob_get_contents();
    ob_end_clean();

    return $content;
}
add_shortcode("newspic", "mom_news_pics");