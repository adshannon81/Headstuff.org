<?php 
	$br_enb = '';
	if( mom_option('bn_bar_news') == false ) {
	$br_enb = ' brnews-disable';
	}
?>
<div class="breaking-news<?php echo $br_enb; ?>"><!--breaking news-->
    <div class="inner"><!--inner-->
        
    <?php if( mom_option('bn_bar_news') != false ) { ?>
    <div class="breaking-news-items">
        <span class="breaking-title"><?php echo mom_option('bn_bar_title'); ?></span>
        <div class="breaking-cont">
            <ul class="webticker">
                <?php
                $numposts = mom_option('num_br_posts');
                if (mom_option('bn_bar_display') == 'cats') {
                    $bn_query = new WP_Query( array( 'cat' => implode(', ',mom_option('bn_bar_cats')), 'posts_per_page' => $numposts, 'no_found_rows' => true, 'cache_results' => false ) );
                    if ( $bn_query->have_posts() ) : while ( $bn_query->have_posts() ) : $bn_query->the_post(); ?>
                    <li itemscope="" itemtype="http://schema.org/Article"><h4 itemprop="name"><span class="enotype-icon-arrow-right6"></span><a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4></li>
                <?php endwhile; else: endif; wp_reset_postdata();
                } elseif (mom_option('bn_bar_display') == 'tags') {
                    $bn_query = new WP_Query( array( 'tag_id' => implode(', ',mom_option('bn_bar_tags')), 'posts_per_page' => $numposts, 'no_found_rows' => true, 'cache_results' => false ) );
                    if ( $bn_query->have_posts() ) : while ( $bn_query->have_posts() ) : $bn_query->the_post(); ?>
                    <li itemscope="" itemtype="http://schema.org/Article"><h4 itemprop="name"><span class="enotype-icon-arrow-right6"></span><a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4></li>
                <?php endwhile; else: endif; wp_reset_postdata();
                } elseif (mom_option('bn_bar_display') == 'custom') { ?>
                  <?php
                    $bn_custom = '<li><h4 itemprop="name"><span class="enotype-icon-arrow-right6"></span>'.str_replace(array("\r","\n\n","\n"),array('',"\n","</h4></li>\n<li><h4 itemprop='name'><span class='enotype-icon-arrow-right6'></span>"),trim(mom_option('bn_bar_custom'),"\n\r")).'</h4></li>';
                    echo $bn_custom;
                } else {
                	$query = new WP_Query( array( 'posts_per_page' => $numposts, 'post_type' => 'post', 'no_found_rows' => true, 'cache_results' => false ) );
                    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
                    <li itemscope="" itemtype="http://schema.org/Article"><h4 itemprop="name"><span class="<?php if(is_rtl()) { ?>enotype-icon-arrow-left6<?php } else { ?>enotype-icon-arrow-right6<?php } ?>"></span><a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4></li>
                <?php endwhile; else: endif; wp_reset_postdata();
                }
                ?>
            </ul>
        </div>
	</div>	
    <?php } ?>
       
    <?php 
    if(mom_option('bn_bar_menu')) {
    if ( has_nav_menu( 'breaking' ) ) {
    ?><div class="brmenu">
    <?php wp_nav_menu( array( 'container' => 'ul', 'menu_class' => 'br-right' , 'theme_location' => 'breaking', 'walker' => new mom_custom_Walker())); ?>

    </div><?php
    } }
    ?>
        
    </div><!--inner-->
</div><!--breaking news-->
<script type="text/javascript">
jQuery(document).ready(function($) {
   //breaking news
	    $('body:not(.rtl) .breaking-cont ul.webticker').liScroll();
	    $('body.rtl .breaking-cont ul.webticker').liScrollRight();
	});
</script>