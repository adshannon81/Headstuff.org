<?php

function mom_nb_head ($style, $cat, $display, $number_of_posts, $sub_categories, $orderby, $nb_excerpt) {
	if ($display == 'category') {

if ($sub_categories == 'yes') {
	$args = array(
		'child_of' => $cat,
		'hide_empty' => 0
	  );
	$categories = get_categories($args);
?>
                            <ol class="nb-tabbed-head" data-nbs="<?php echo $style; ?>" data-number_of_posts="<?php echo $number_of_posts; ?>" data-orderby="<?php echo $orderby; ?>" data-nb_excerpt="<?php echo $nb_excerpt; ?>">
                                <li class="all active"><a href="#" data-cat_id="" data-parent_cat="<?php echo $cat; ?>"><?php _e('All', 'framework'); ?></a></li>
				<?php
				foreach($categories as $category) { 
				  echo '<li><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s", 'framework'), $category->name ) . '" ' . ' data-cat_id="'.$category->term_id.'">' . $category->name.'</a> </li>';
				  }
				?>
                            </ol>
<?php } } }

function mom_news_boxes($atts, $content = null) {
	extract(shortcode_atts(array(
        'style' => 'nb1',
        'title' => '',
		'display' => '',
		'cat' => '',
		'tag' => '',
        'number_of_posts' => '4',
        'orderby' => '',
		'nb_excerpt' => '',
		'sub_categories' => 'no',
		'show_more' => 'yes',
		'show_more_event' => '',
		'post_type' => ''
	), $atts));
	$ajax_class = '';
	if ($show_more_event == 'ajax') {
		$ajax_class = 'show_more_ajax';
	}
	if ($style == 'nb6' && $number_of_posts == '4') {
		$number_of_posts = '3';
	}
	ob_start();
            $dateformat = mom_option('date_format');
            
            global $wpdb;
			$tag_ID = $wpdb->get_var("SELECT * FROM ".$wpdb->terms." WHERE `name` = '".$tag."'");
                
        if($display == 'category') {
        	if($title == '') { 
				$nb_title = get_cat_name($cat);
			} else {
				$nb_title = $title;
			}
			$nb_link = get_category_link($cat);
	    } elseif ($display == 'tag') {
			if($title == '') { 
				$nb_title = $tag;
			} else {
				$nb_title = $title;
			}
			$nb_link = get_tag_link($tag_ID);
	    } else {
			$nb_title = $title;
			$nb_link = '#';
	    }
	    
	    $sm_Atts = 'data-nbs="'.$style.'" data-number_of_posts="'.$number_of_posts.'" data-cat_id="'.$cat.'" data-nb_excerpt="'.$nb_excerpt.'"';

		$post_meta_hp = mom_option('post_meta_hp');
		/*
if ($post_meta_hp === null) {
			$post_meta_hp = 1;
		}
*/
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
                    
            <?php if($style == 'nb2') { ?>
                    
                    <section class="section news-box <?php if($display == 'category') { ?>cat_<?php echo $cat ; } ?>"><!--News box 2-->
                                
                        <header class="block-title">
                            <h2><a href="<?php echo $nb_link; ?>"><?php echo $nb_title; ?></a></h2>
				<?php mom_nb_head($style, $cat, $display, $number_of_posts, $sub_categories, $orderby, $nb_excerpt); ?>
                        </header>
                        
                        <div class="nb2">
                            <?php
                            if($display == 'category') {
                            	$query = new WP_Query( array( 'cat' => $cat, 'posts_per_page' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                            } elseif($display == 'tag') {
                                $query = new WP_Query( array( 'tag' => $tag, 'posts_per_page' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                            } else {
                                $query = new WP_Query( array( 'posts_per_page' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                            }
                            if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                            ?>
                            <div <?php post_class('first-item'); ?> role="article" itemscope="" itemtype="http://schema.org/Article">
                                <?php if( mom_post_image() != false ) { ?>
                                <figure class="post-thumbnail"><a href="<?php the_permalink(); ?>">
                                    <img itemprop="image" src="<?php echo mom_post_image('nb1-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>">
                                    <span class="post-format-icon"></span>
                                </a></figure>
                                <?php } ?>
                                
                                <?php 
                                if( mom_post_image() != false ) { 
                                	$mom_class = ' class="fix-right-content"';    
                                } else {
                                    $mom_class = '';
                                }
                                ?>
                                <div<?php echo $mom_class; ?>>
                                	<?php if($post_head != 0) { ?>
	                                <div class="entry-meta">
	                                <?php if($post_head_date != 0) { ?>
	                                    <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><i class="momizat-icon-calendar"></i><?php mom_date_format(); ?></time>
	                                    <?php } ?>
	                                    <?php if($post_head_commetns != 0) { ?>
	                                    <div class="comments-link">
	                                        <i class="momizat-icon-bubbles4"></i><a href="<?php comments_link(); ?>"><?php comments_number(__( '(0) Comments', 'framework' ), __( '(1) Comment', 'framework' ),__( '(%) Comments', 'framework' )); ?></a>
	                                    </div>
	                                    <?php } ?>
	                                </div>
	                                <?php } ?>
	                                <h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	                                <div class="entry-content">
	                                <?php if($nb_excerpt != '0') { ?>  
	                                    <p>
	                                        <?php global $post;
	                                        $excerpt = $post->post_excerpt;
	                                        if($excerpt==''){
	                                        $excerpt = get_the_content('');
	                                        }
											if($nb_excerpt == ''){
	                                        echo wp_html_excerpt(strip_shortcodes($excerpt), 145, '...');
											} else {
											echo wp_html_excerpt(strip_shortcodes($excerpt), $nb_excerpt, '...');	
											}
	                                        ?>
	                                    </p>
	                                <?php } ?>
	                                </div>
                                </div>
                            </div>
                            <?php
                            endwhile;
                            else:
                            endif;
                            wp_reset_postdata();
                            ?>
                            
                            <ul>
                                <?php
                                if($display == 'category') {
                                	$query = new WP_Query( array( 'cat' => $cat, 'posts_per_page' => $number_of_posts, 'offset' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                } elseif($display == 'tag') {
                                    $query = new WP_Query( array( 'tag' => $tag, 'posts_per_page' => $number_of_posts, 'offset' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                } else {
                                    $query = new WP_Query( array( 'posts_per_page' => $number_of_posts, 'offset' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                }
                                if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                                ?>
                                <li role="article" itemscope="" itemtype="http://schema.org/Article">
                                    <h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <?php if($post_head != 0) { ?>
                                    <div class="entry-meta">
                                    	<?php if($post_head_date != 0) { ?>
                                        <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><?php mom_date_format(); ?></time>
                                        <?php } ?>
                                        <?php if($post_head_commetns != 0) { ?>
                                        <div class="comments-link">
                                            <a href="<?php comments_link(); ?>"><?php comments_number(__( '(0) Comments', 'framework' ), __( '(1) Comment', 'framework' ),__( '(%) Comments', 'framework' )); ?></a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                </li>
                                <?php
                                endwhile;
                                else:
                                endif;
                                wp_reset_postdata();
                                ?>
                            </ul>
                        </div>
			
                            <?php if ($show_more == 'yes') { ?>
			<footer class="newb2 show-more <?php echo $ajax_class; ?>" <?php echo $sm_Atts; ?>>
                                <a href="<?php echo $nb_link; ?>" data-post_type="<?php echo $post_type; ?>" data-offset="<?php echo absint($number_of_posts+1); ?>" data-orig-offset="<?php echo absint($number_of_posts+1); ?>"><?php _e('Show More News', 'framework'); ?></a>
                        </footer>
			<?php } ?>
                        
                    </section><!--News box 2-->
            
            <?php } elseif($style == 'nb3') { ?>
            
                    <section class="section news-box <?php if($display == 'category') { ?>cat_<?php echo $cat ; } ?>"><!--News box 3-->
                                
                        <header class="block-title">
                            <h2><a href="<?php echo $nb_link; ?>"><?php echo $nb_title; ?></a></h2>
				<?php mom_nb_head($style, $cat, $display, $number_of_posts, $sub_categories, $orderby, $nb_excerpt); ?>
                        </header>
                        
                        <div class="nb3">
                            <?php
                            if($display == 'category') {
                            	$query = new WP_Query( array( 'cat' => $cat, 'posts_per_page' => 2, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                            } elseif($display == 'tag') {
                                $query = new WP_Query( array( 'tag' => $tag, 'posts_per_page' => 2, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                            } else {
                                $query = new WP_Query( array( 'posts_per_page' => 2, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                            }
                            if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                            ?>
                            <div <?php post_class('first-item'); ?> role="article" itemscope="" itemtype="http://schema.org/Article">
                                <?php if( mom_post_image() != false ) { ?>
                                <figure class="post-thumbnail"><a href="<?php the_permalink(); ?>">
                                    <img itemprop="image" src="<?php echo mom_post_image('nb1-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>">
                                    <span class="post-format-icon"></span>
                                </a></figure>
                                <?php } ?>
                                <?php 
                                if( mom_post_image() != false ) { 
                                	$mom_class = ' class="fix-right-content"';    
                                } else {
                                    $mom_class = '';
                                }
                                ?>
                                <div<?php echo $mom_class; ?>>
                                <h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <div class="entry-content">
                                <?php if($nb_excerpt != '0') { ?>  
                                    <p>
	                                        <?php global $post;
	                                        $excerpt = $post->post_excerpt;
	                                        if($excerpt==''){
	                                        $excerpt = get_the_content('');
	                                        }
											if($nb_excerpt == ''){
	                                        echo wp_html_excerpt(strip_shortcodes($excerpt), 115, '...');
											} else {
											echo wp_html_excerpt(strip_shortcodes($excerpt), $nb_excerpt, '...');	
											}
	                                        ?>
	                                    </p>
	                            <?php } ?>
                                </div>
                                <?php if($post_head != 0) { ?>
                                <div class="entry-meta">
                                	<?php if($post_head_date != 0) { ?>
                                    <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><i class="momizat-icon-calendar"></i><?php mom_date_format(); ?></time>
                                    <?php } ?>
                                    <?php if($post_head_commetns != 0) { ?>
                                    <div class="comments-link">
                                        <i class="momizat-icon-bubbles4"></i><a href="<?php comments_link(); ?>"><?php comments_number(__( '(0) Comments', 'framework' ), __( '(1) Comment', 'framework' ),__( '(%) Comments', 'framework' )); ?></a>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                </div>
                            </div>
                            <?php
                            endwhile;
                            else:
                            endif;
                            wp_reset_postdata();
                            ?>
                            
                            <ul>
                                <?php
                                if($display == 'category') {
                                	$query = new WP_Query( array( 'cat' => $cat, 'posts_per_page' => $number_of_posts, 'offset' => 2, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                } elseif($display == 'tag') {
                                    $query = new WP_Query( array( 'tag' => $tag, 'posts_per_page' => $number_of_posts, 'offset' => 2, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                } else {
                                    $query = new WP_Query( array( 'posts_per_page' => $number_of_posts, 'offset' => 2, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                }
                                if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                                ?>
                                <li role="article" itemscope="" itemtype="http://schema.org/Article">
                                    <?php if( mom_post_image() != false ) { ?>
                                    <figure class="post-thumbnail"><a href="<?php the_permalink(); ?>">
                                        <img itemprop="image" src="<?php echo mom_post_image('nb3-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>">
                                    </a></figure>
                                    <?php } ?>
                                    <h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <?php if($post_head != 0) { ?>
                                    <div class="entry-meta">
                                    	<?php if($post_head_date != 0) { ?>
                                        <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><i class="momizat-icon-calendar"></i><?php mom_date_format(); ?></time>
                                        <?php } ?>
                                        <?php if($post_head_commetns != 0) { ?>
                                        <div class="comments-link">
                                            <i class="momizat-icon-bubbles4"></i><a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                </li>
                                <?php
                                endwhile;
                                else:
                                endif;
                                wp_reset_postdata();
                                ?>
                            </ul>
                        </div>
                        
                        <?php if ($show_more == 'yes') { ?>
                        <footer class="show-more <?php echo $ajax_class; ?>" <?php echo $sm_Atts; ?>>
                                <a href="<?php echo $nb_link; ?>" data-post_type="<?php echo $post_type; ?>" data-offset="<?php echo absint($number_of_posts+2); ?>" data-orig-offset="<?php echo absint($number_of_posts+2); ?>"><?php _e('Show More News', 'framework'); ?></a>
                        </footer>
			<?php } ?>
                        
                    </section><!--News box 3-->
                    
            <?php } elseif($style == 'nb4') { ?>
                    
                    <section class="section news-box <?php if($display == 'category') { ?>cat_<?php echo $cat ; } ?>"><!--News box 4-->
                                
                        <header class="block-title">
                            <h2><a href="<?php echo $nb_link; ?>"><?php echo $nb_title; ?></a></h2>
				<?php mom_nb_head($style, $cat, $display, $number_of_posts, $sub_categories, $orderby, $nb_excerpt); ?>
                        </header>
                        
                        <div class="nb4">
                            <?php
                            if($display == 'category') {
                            	$query = new WP_Query( array( 'cat' => $cat, 'posts_per_page' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                            } elseif($display == 'tag') {
                                $query = new WP_Query( array( 'tag' => $tag, 'posts_per_page' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                            } else {
                                $query = new WP_Query( array( 'posts_per_page' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                            }
                            if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                            ?>
                            <div <?php post_class('first-item'); ?> role="article" itemscope="" itemtype="http://schema.org/Article">
                                <?php if( mom_post_image() != false ) { ?>
                                <figure class="post-thumbnail"><a href="<?php the_permalink(); ?>">
                                    <img itemprop="image" src="<?php echo mom_post_image('nb1-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>">
                                    <span class="post-format-icon"></span>
                                </a></figure>
                                <?php } ?>
                                <?php 
                                if( mom_post_image() != false ) { 
                                	$mom_class = ' class="fix-right-content"';    
                                } else {
                                    $mom_class = '';
                                }
                                ?>
                                <div<?php echo $mom_class; ?>>
                                <h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <div class="entry-content">
                                <?php if($nb_excerpt != '0') { ?>  
                                    <p>
	                                        <?php global $post;
	                                        $excerpt = $post->post_excerpt;
	                                        if($excerpt==''){
	                                        $excerpt = get_the_content('');
	                                        }
											if($nb_excerpt == ''){
	                                        echo wp_html_excerpt(strip_shortcodes($excerpt), 110, '...');
											} else {
											echo wp_html_excerpt(strip_shortcodes($excerpt), $nb_excerpt, '...');	
											}
	                                        ?>
	                                    </p>
	                            <?php } ?>
                                </div>
                                <?php if($post_head != 0) { ?>
                                <div class="entry-meta">
                                    <?php if($post_head_date != 0) { ?>
                                    <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><i class="momizat-icon-calendar"></i><?php mom_date_format(); ?></time>
                                    <?php } ?>
                                    <?php if($post_head_commetns != 0) { ?>
                                    <div class="comments-link">
                                        <i class="momizat-icon-bubbles4"></i><a href="<?php comments_link(); ?>"><?php comments_number(__( '(0) Comments', 'framework' ), __( '(1) Comment', 'framework' ),__( '(%) Comments', 'framework' )); ?></a>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                </div>
                            </div>
                            <?php
                            endwhile;
                            else:
                            endif;
                            wp_reset_postdata();
                            ?>
                            
                            <ul>
                                <?php
                                if($display == 'category') {
                                	$query = new WP_Query( array( 'cat' => $cat, 'posts_per_page' => $number_of_posts, 'offset' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                } elseif($display == 'tag') {
                                    $query = new WP_Query( array( 'tag' => $tag, 'posts_per_page' => $number_of_posts, 'offset' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                } else {
                                    $query = new WP_Query( array( 'posts_per_page' => $number_of_posts, 'offset' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                }
                                if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                                ?>
                                <li role="article" itemscope="" itemtype="http://schema.org/Article">
                                    <?php if( mom_post_image() != false ) { ?>
                                    <figure class="post-thumbnail"><a href="<?php the_permalink(); ?>">
                                        <img itemprop="image" src="<?php echo mom_post_image('nb3-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>">
                                    </a></figure>
                                    <?php } ?>
                                    <h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <?php if($post_head != 0) { ?>
                                    <div class="entry-meta">
                                        <?php if($post_head_date != 0) { ?>
                                        <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><i class="momizat-icon-calendar"></i><?php mom_date_format(); ?></time>
                                        <?php } ?>
                                       <!--
 <div class="comments-link">
                                            <a href="<?php comments_link(); ?>"><?php comments_number(__( '(0) Comments', 'framework' ), __( '(1) Comment', 'framework' ),__( '(%) Comments', 'framework' )); ?></a>
                                        </div>
-->
                                        
                                    </div>
                                    <?php } ?>
                                </li>
                                <?php
                                endwhile;
                                else:
                                endif;
                                wp_reset_postdata();
                                ?>
                            </ul>
                        </div>
                        
                        <?php if ($show_more == 'yes') { ?>
                        <footer class="show-more <?php echo $ajax_class; ?>" <?php echo $sm_Atts; ?>>
                                <a href="<?php echo $nb_link; ?>" data-post_type="<?php echo $post_type; ?>" data-offset="<?php echo absint($number_of_posts+1); ?>" data-orig-offset="<?php echo absint($number_of_posts+1); ?>"><?php _e('Show More News', 'framework'); ?></a>
                        </footer>
			<?php } ?>
                        
                    </section><!--News box 4-->
                    
            <?php } elseif($style == 'nb5') { ?>
                
                    <section class="section news-box <?php if($display == 'category') { ?>cat_<?php echo $cat ; } ?>"><!--News box 5-->
                                
                        <header class="block-title">
                            <h2><a href="<?php echo $nb_link; ?>"><?php echo $nb_title; ?></a></h2>
				<?php mom_nb_head($style, $cat, $display, $number_of_posts, $sub_categories, $orderby, $nb_excerpt); ?>
                        </header>
                        
                        <div class="nb5">
                            <?php
                            if($display == 'category') {
                            	$query = new WP_Query( array( 'cat' => $cat, 'posts_per_page' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                            } elseif($display == 'tag') {
                                $query = new WP_Query( array( 'tag' => $tag, 'posts_per_page' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                            } else {
                                $query = new WP_Query( array( 'posts_per_page' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                            }
                            if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                            ?>
                            <div <?php post_class('first-item'); ?> role="article" itemscope="" itemtype="http://schema.org/Article">
                                <h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <?php if( mom_post_image() != false ) { ?>
                                <figure class="post-thumbnail"><a href="<?php the_permalink(); ?>">
                                    <img itemprop="image" src="<?php echo mom_post_image('nb5-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>">
                                    <span class="post-format-icon"></span>
                                </a></figure>
                                <?php } ?>
                                <?php if( mom_post_image() != false ) { 
                                	$mom_class = ' class="fix-right-content"';    
                                } else {
                                    $mom_class = '';
                                }
                                ?>
                                <div<?php echo $mom_class; ?>>
                                <div class="entry-content">
                                <?php if($nb_excerpt != '0') { ?>  
                                    <p>
	                                        <?php global $post;
	                                        $excerpt = $post->post_excerpt;
	                                        if($excerpt==''){
	                                        $excerpt = get_the_content('');
	                                        }
											if($nb_excerpt == ''){
	                                        echo wp_html_excerpt(strip_shortcodes($excerpt), 180, '...');
											} else {
											echo wp_html_excerpt(strip_shortcodes($excerpt), $nb_excerpt, '...');	
											}
	                                        ?>
	                                    </p>
	                            <?php } ?>
                                </div>
                                <?php if($post_head != 0) { ?>
                                <div class="entry-meta">
                                	<?php if($post_head_date != 0) { ?>
                                    <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><i class="momizat-icon-calendar"></i><?php mom_date_format(); ?></time>
                                    <?php } ?>
                                    <?php if($post_head_commetns != 0) { ?>
                                    <div class="comments-link">
                                        <i class="momizat-icon-bubbles4"></i><a href="<?php comments_link(); ?>"><?php comments_number(__( '(0) Comments', 'framework' ), __( '(1) Comment', 'framework' ),__( '(%) Comments', 'framework' )); ?></a>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                </div>
                            </div>
                            <?php
                            endwhile;
                            else:
                            endif;
                            wp_reset_postdata();
                            ?>
                            
                            <ul>
                                <?php
                                if($display == 'category') {
                                	$query = new WP_Query( array( 'cat' => $cat, 'posts_per_page' => $number_of_posts, 'offset' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                } elseif($display == 'tag') {
                                    $query = new WP_Query( array( 'tag' => $tag, 'posts_per_page' => $number_of_posts, 'offset' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                } else {
                                    $query = new WP_Query( array( 'posts_per_page' => $number_of_posts, 'offset' => 1, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                }
                                if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                                ?>
                                <li role="article" itemscope="" itemtype="http://schema.org/Article">
                                    <h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <?php if($post_head != 0) { ?>
                                    <div class="entry-meta">
                                    	<?php if($post_head_date != 0) { ?>
                                        <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><?php mom_date_format(); ?></time>
                                        <?php } ?>
										<?php if($post_head_commetns != 0) { ?>
                                        <div class="comments-link">
                                            <a href="<?php comments_link(); ?>"><?php comments_number(__( '(0) Comments', 'framework' ), __( '(1) Comment', 'framework' ),__( '(%) Comments', 'framework' )); ?></a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                </li>
                                <?php
                                endwhile;
                                else:
                                endif;
                                wp_reset_postdata();
                                ?>
                            </ul>
                        </div>
                        
                        <?php if ($show_more == 'yes') { ?>
                        <footer class="show-more <?php echo $ajax_class; ?>" <?php echo $sm_Atts; ?>>
                                <a href="<?php echo $nb_link; ?>" data-post_type="<?php echo $post_type; ?>" data-offset="<?php echo absint($number_of_posts+1); ?>" data-orig-offset="<?php echo absint($number_of_posts+1); ?>"><?php _e('Show More News', 'framework'); ?></a>
                        </footer>
			<?php } ?>
                         
                    </section><!--News box 5-->
                
            <?php } elseif($style == 'nb6') { ?>
                    
                    <section class="section news-box <?php if($display == 'category') { ?>cat_<?php echo $cat ; } ?>"><!--news box 6-->
                                
                        <header class="block-title">
                            <h2><a href="<?php echo $nb_link; ?>"><?php echo $nb_title; ?></a></h2>
				<?php mom_nb_head($style, $cat, $display, $number_of_posts, $sub_categories, $orderby, $nb_excerpt); ?>
                        </header>
                        
                        <div class="nb6">
                            <ul>
                                <?php
                                if($display == 'category') {
                                	$query = new WP_Query( array( 'cat' => $cat, 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                } elseif($display == 'tag') {
                                    $query = new WP_Query( array( 'tag' => $tag, 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                } else {
                                    $query = new WP_Query( array( 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                }
                                if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                                ?>
                                <li <?php post_class(); ?> role="article" itemscope="" itemtype="http://schema.org/Article">
                                    <?php if( mom_post_image() != false ) { ?>
                                    <figure class="post-thumbnail"><a href="<?php the_permalink(); ?>">
                                        <img itemprop="image" src="<?php echo mom_post_image('scroller-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>">
                                        <span class="post-format-icon"></span>
                                    </a></figure>
                                    <?php } ?>
                                    <?php if( mom_post_image() != false ) { 
									$mom_class = ' class="fix-right-content"';    
									} else {
									$mom_class = '';
									}
									?>
									<div<?php echo $mom_class; ?>>
                                    <h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <div class="entry-content">
                                    <?php if($nb_excerpt != '0') { ?> 
                                        <p>
	                                        <?php global $post;
	                                        $excerpt = $post->post_excerpt;
	                                        if($excerpt==''){
	                                        $excerpt = get_the_content('');
	                                        }
											if($nb_excerpt == ''){
	                                        echo wp_html_excerpt(strip_shortcodes($excerpt), 120, '...');
											} else {
											echo wp_html_excerpt(strip_shortcodes($excerpt), $nb_excerpt, '...');	
											}
	                                        ?>
	                                    </p>
                                    <?php } ?>
                                    </div>
                                    <?php if($post_head != 0) { ?>
                                    <div class="entry-meta">
                                    	<?php if($post_head_date != 0) { ?>
                                        <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><i class="momizat-icon-calendar"></i><?php mom_date_format(); ?></time>
                                        <?php } ?>
                                        <?php if($post_head_commetns != 0) { ?>
                                        <div class="comments-link">
                                            <i class="momizat-icon-bubbles4"></i><a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
									</div>
                                </li>
                                <?php
                                endwhile;
                                else:
                                endif;
                                wp_reset_postdata();
                                ?>
                            </ul>
                        </div>
                        
                        <?php if ($show_more == 'yes') { ?>
                        <footer class="show-more <?php echo $ajax_class; ?>" <?php echo $sm_Atts; ?>>
                                <a href="<?php echo $nb_link; ?>" data-post_type="<?php echo $post_type; ?>" data-offset="<?php echo $number_of_posts; ?>" data-orig-offset="<?php echo $number_of_posts; ?>"><?php _e('Show More News', 'framework'); ?></a>
                        </footer>
			<?php } ?>
                        
                    </section><!--news box 6-->
                    
            <?php } elseif($style == 'list') { ?>

		<section class="section news-box nb1 news-list <?php if($display == 'category') { ?>cat_<?php echo $cat ; } ?>"><!--News box 1-->
			                                    
                            <header class="block-title">
                                <h2><a href="<?php echo $nb_link; ?>"><?php echo $nb_title; ?></a></h2>
				<?php mom_nb_head($style, $cat, $display, $number_of_posts, $sub_categories, $orderby, $nb_excerpt); ?>
                            </header>
                            
                            <ul>
                                <?php
                                if($display == 'category') {
                                	$query = new WP_Query( array( 'cat' => $cat, 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                } elseif($display == 'tag') {
                                    $query = new WP_Query( array( 'tag' => $tag, 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                } else {
                                    $query = new WP_Query( array( 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                }
                                if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                                ?>
                                <li <?php post_class(); ?> itemscope="" itemtype="http://schema.org/Article">
                                    <h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <div class="entry-content">
                                    <?php if($nb_excerpt != '0') { ?>    
                                        <p>
	                                        <?php global $post;
	                                        $excerpt = $post->post_excerpt;
	                                        if($excerpt==''){
	                                        $excerpt = get_the_content('');
	                                        }
											if($nb_excerpt == ''){
	                                        echo wp_html_excerpt(strip_shortcodes($excerpt), 115, '...');
											} else {
											echo wp_html_excerpt(strip_shortcodes($excerpt), $nb_excerpt, '...');	
											}
	                                        ?>
	                                    </p>
	                                <?php } ?>
                                    </div>
                                    <?php if($post_head != 0) { ?>
                                    <div class="entry-meta">
                                    <?php if($post_head_date != 0) { ?>
                                        <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><i class="momizat-icon-calendar"></i><?php mom_date_format(); ?></time>
                                        <?php } ?>
                                        <?php if($post_head_cat != 0) { ?>
                                            <span class="cat-link">
                                                <i class="momizat-icon-folder-open"></i><?php the_category(', '); ?>
                                            </span>
                                            <?php } ?>
                                            <?php if($post_head_commetns != 0) { ?>
                                        <span class="comments-link">
                                            <i class="momizat-icon-bubbles4"></i><a href="<?php comments_link(); ?>"><?php comments_number(__( '(0) Comments', 'framework' ), __( '(1) Comment', 'framework' ),__( '(%) Comments', 'framework' )); ?></a>
                                            
                                        </span>
                                        <?php } ?>
					<div class="clear"></div>
                                    </div>
                                    <?php } ?>
                                </li>
                                <?php
                                endwhile;
                                else:
                                endif;
                                wp_reset_postdata();
                                ?>
                            </ul>
                            <?php if ($show_more == 'yes') { ?>
                            <footer class="show-more <?php echo $ajax_class; ?>" <?php echo $sm_Atts; ?> >
                                <a href="<?php echo $nb_link; ?>" data-post_type="<?php echo $post_type; ?>" data-offset="<?php echo $number_of_posts; ?>" data-orig-offset="<?php echo $number_of_posts; ?>"><?php _e('Show More News', 'framework'); ?></a>
                            </footer>
			    <?php } ?>
                        
                    </section><!--News box 1-->

            <?php } else { ?>
	    
		<section class="section news-box nb1 <?php if($display == 'category') { ?>cat_<?php echo $cat ; } ?>"><!--News box 1-->
			                                    
                            <header class="block-title">
                                <h2><a href="<?php echo $nb_link; ?>"><?php echo $nb_title; ?></a></h2>
				<?php mom_nb_head($style, $cat, $display, $number_of_posts, $sub_categories, $orderby, $nb_excerpt); ?>
                            </header>
                            
                            <ul>
                                <?php
                                if($display == 'category') {
                                	$query = new WP_Query( array( 'cat' => $cat, 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                } elseif($display == 'tag') {
                                    $query = new WP_Query( array( 'tag' => $tag, 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                } else {
                                    $query = new WP_Query( array( 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'post_type' => $post_type, 'no_found_rows' => true, 'cache_results' => false ) );
                                }
                                if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                                ?>
                                <li <?php post_class(); ?> itemscope="" itemtype="http://schema.org/Article">
                                    <?php if( mom_post_image() != false ) { ?>
                                    <figure class="post-thumbnail"><a href="<?php the_permalink(); ?>">
                                        <img itemprop="image" src="<?php echo mom_post_image('nb1-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>">
                                        <span class="post-format-icon"></span>
                                    </a></figure>
                                    <?php } ?>
                                    <?php if( mom_post_image() != false ) { 
									$mom_class = ' class="fix-right-content"';    
									} else {
									$mom_class = '';
									}
									?>
									<div<?php echo $mom_class; ?>>
                                    <h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <div class="entry-content">
                                    <?php if($nb_excerpt != '0') { ?>    
                                        <p>
	                                        <?php global $post;
	                                        $excerpt = $post->post_excerpt;
	                                        if($excerpt==''){
	                                        $excerpt = get_the_content('');
	                                        }
											if($nb_excerpt == ''){
	                                        echo wp_html_excerpt(strip_shortcodes($excerpt), 115, '...');
											} else {
											echo wp_html_excerpt(strip_shortcodes($excerpt), $nb_excerpt, '...');	
											}
	                                        ?>
	                                    </p>
	                                <?php } ?>
                                    </div>
                                    <?php if($post_head != 0) { ?>
                                    <div class="entry-meta">
                                    <?php if($post_head_date != 0) { ?>
                                        <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><i class="momizat-icon-calendar"></i><?php mom_date_format(); ?></time>
                                        <?php } ?>
                                        <?php if($post_head_commetns != 0) { ?>
                                        <div class="comments-link">
                                            <i class="momizat-icon-bubbles4"></i><a href="<?php comments_link(); ?>"><?php comments_number(__( '(0) Comments', 'framework' ), __( '(1) Comment', 'framework' ),__( '(%) Comments', 'framework' )); ?></a>
                                            
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
									</div>
                                </li>
                                <?php
                                endwhile;
                                else:
                                endif;
                                wp_reset_postdata();
                                ?>
                            </ul>
                            <?php if ($show_more == 'yes') { ?>
                            <footer class="show-more <?php echo $ajax_class; ?>" <?php echo $sm_Atts; ?> >
                                <a href="<?php echo $nb_link; ?>" data-post_type="<?php echo $post_type; ?>" data-offset="<?php echo $number_of_posts; ?>" data-orig-offset="<?php echo $number_of_posts; ?>"><?php _e('Show More News', 'framework'); ?></a>
                            </footer>
			    <?php } ?>
                        
                    </section><!--News box 1-->
		
	    <?php } ?>

	<?php 
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

add_shortcode("newsbox", "mom_news_boxes");