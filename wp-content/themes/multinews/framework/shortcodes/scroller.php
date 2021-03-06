<?php
function mom_scrollers($atts, $content = null) {
	extract(shortcode_atts(array(
        'style' => 'sc1',
        'title' => '',
        'title_size' => '17',
        'sub_title' => '',
		'display' => 'latest',
		'cats' => '',
		'tags' => '',
		'orderby' => '',
		'number_of_posts' => '5',
		'auto_play' => '3000',
		'speed' => '300',
	), $atts));
	
	ob_start();
	wp_enqueue_script('owl');
        
        $dateformat = mom_option('date_format');
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
        $authormeta = mom_option('post_head_author');
        $rndn = rand(0,100);
            
        global $wpdb;
        $tag_ID = $wpdb->get_var("SELECT * FROM ".$wpdb->terms." WHERE 'name' = '".$tags."'");
        
        if($display == 'cats') {
        	if($title == '') { 
	            $nb_title = get_cat_name($cats);
	            $nb_link = get_category_link($cats);
            } else {
				$nb_title = $title;
            }
        } elseif ($display == 'tags') {
        	if($title == '') { 
	            $nb_title = $tags;
	            $nb_link = get_tag_link($tag_ID);
	        } else {
				$nb_title = $title;
            }
        } else {
            $nb_title = $title;
            $nb_link = '';
        }
        
        if($auto_play != '') {
	        $autoplay = 'true';
        } else {
	        $autoplay = 'false';
        }
	$link_start = '';
	$link_end = '';
	if ($nb_link != '') {
		$link_start = '<a href="'.$nb_link .'">';
		$link_end = '</a>';
	}
	?>
        <script>
            jQuery(document).ready(function($) {
             //Scroller
	      <?php if($style == 'sc1') { ?>
            $(".sw-<?php echo $rndn; ?>").owlCarousel({
              autoplay:<?php echo $autoplay; ?>,
		autoplayTimeout:<?php echo $auto_play; ?>,
              slideSpeed : <?php echo $speed ; ?>,
			  <?php if(is_rtl()) { ?>
			  rtl: true,
			  <?php } ?>
              items : 4,
              lazyLoad : true,
              /* itemsScaleUp: true, */
              navigation : true,
              /* loop:true, */
		//autoWidth:true,
		autoHeight:         true,
			  margin: 1,
			  nav:true,
			  responsiveClass:true,
              responsive:{
                  1024:{
	                  items:4,
                  },
                  970:{
		            	items:4  
	              },	
              	  795:{
		            	items:2  
	              },
		  678:{
		            	items:2  
	              },
	              567:{
		            	items:2  
	              },
	              450:{
		            	items:1  
	              },
	              360:{
		            	items:1  
	              },
	              320:{
		            	items:1  
	              },
              }
            });
            
	    <?php } else { ?>
            //Scroller2
            $(".sw2-<?php echo $rndn; ?>").owlCarousel({
              autoplay:<?php echo $autoplay; ?>,
			  autoplayTimeout:<?php echo $auto_play; ?>,
              slideSpeed : <?php echo $speed ; ?>,
              <?php if(is_rtl()) { ?>
			  rtl: true,
			  <?php } ?>
              items : 4,
              lazyLoad : true,
              itemsScaleUp: true,
              loop: true,
              navigation : true,
              autoWidth:          true,
              autoHeight:         true,
              nav:true,
              responsiveClass:true,
              responsive:{
	              1024:{
	                  items:4,
                  },
                  970:{
		            	items:4  
	              },	
              	  795:{
		            	items:2  
	              },
				  678:{
		            	items:2  
	              },
	              567:{
		            	items:2  
	              },
	              450:{
		            	items:1  
	              },
	              360:{
		            	items:1  
	              },
	              320:{
		            	items:1  
	              },
              }
            });
	    <?php } ?>
            
          });
        </script>
                
                <?php if($style == 'sc1') { ?>
                                
                    <section class="section scroller-section">
                        
                        <header class="section-header">
                        	<?php if($title_size == '17') { ?>
                            <h2 class="section-title"><?php echo $link_start.$nb_title.$link_end; ?></h2>
                            <?php } else { ?>
                            <h1 class="section-title2"><?php echo $link_start.$nb_title.$link_end; ?></h1>
                            <?php } ?>
                            <?php if($sub_title != '') { ?><span class="mom-sub-title"><?php echo $sub_title; ?></span><?php } ?>
                        </header>
                        
                        <div class="scroller">
                            <ul class="scroller-wrap sw-<?php echo $rndn; ?>">
                                <?php
	                            if($display == 'cats') {
	                            	$squery = new WP_Query( array( 'cat' => $cats, 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
	                            } elseif($display == 'tags') {
	                                $squery = new WP_Query( array( 'tag' => $tags, 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
	                            } else {
	                                $squery = new WP_Query( array( 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
	                            }
	                            if ( $squery->have_posts() ) : while ( $squery->have_posts() ) : $squery->the_post();
	                            ?>
                                <li class="scroller-item" itemscope="" itemtype="http://schema.org/Article">
                                    <a itemprop="url" href="<?php the_permalink(); ?>">
                                        <figure class="post-thumbnail"><img itemprop="image" src="<?php echo mom_post_image('scroller-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>"></figure>
                                        <h2 itemprop="name"><?php the_title(); ?></h2>
                                        <?php if($post_head != 0) { ?>
                                        <div class="entry-meta">
                                            <?php if ($post_head_author == 1) { ?>
					    <div class="author-link">
                                                <i class="momizat-icon-user3"></i><a itemprop="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" rel="author"><?php echo get_the_author() ?></a>
                                            </div>
					    <?php } ?>
					    <?php if($post_head_date != 0) { ?>
                                            <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><i class="momizat-icon-calendar"></i><?php the_time('Y/m/d'); ?></time>
                                            <?php } ?>
					    <?php if($post_head_cat != 0) { ?>
					    <div class="cat-link">
                                                <i class="momizat-icon-folder-open"></i><?php $category = get_the_category(); echo '<a class="category" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>'; ?>
                                            </div>
					    <?php } ?>
                                        </div>
                                        <?php } ?>
                                    </a>
                                </li>
                                <?php
                                endwhile;
                                else:
                                endif;
                                wp_reset_postdata();
                                ?>
                            </ul>
                        </div>
                        
                    </section>
                <?php } else { ?>
                            	
                    <section class="section scroller-section">
                        <header class="section-header">
                            <?php if($title_size == '17') { ?>
                            <h2 class="section-title"><?php echo $link_start.$nb_title.$link_end; ?></h2>
                            <?php } else { ?>
                            <h1 class="section-title2"><?php echo $link_start.$nb_title.$link_end; ?></h1>
                            <?php } ?>
                            <?php if($sub_title != '') { ?><span class="mom-sub-title"><?php echo $sub_title; ?></span><?php } ?>
                        </header>
                        
                        <div class="scroller2">
                            <ul class="scroller2-wrap sw2-<?php echo $rndn; ?>">
                               <?php
	                            if($display == 'cats') {
	                            	$query = new WP_Query( array( 'cat' => $cats, 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
	                            } elseif($display == 'tags') {
	                                $query = new WP_Query( array( 'tag' => $tags, 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
	                            } else {
	                                $query = new WP_Query( array( 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
	                            }
	                            if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
	                            ?>
                                <li class="scroller-item" itemscope="" itemtype="http://schema.org/Article">
                                    <a itemprop="url" href="<?php the_permalink(); ?>">
                                        <?php if( mom_post_image() != false ) { ?>
                                        <figure class="post-thumbnail"><img itemprop="image" src="<?php echo mom_post_image('scroller-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>"></figure>
                                        <?php } ?>
                                        <h2 itemprop="name"><?php the_title(); ?></h2>
                                        <?php if($post_head != 0) { ?>
                                        <div class="entry-meta">
                                            <?php if ($post_head_author == 1) { ?>
					    <div class="author-link">
                                                <i class="momizat-icon-user3"></i><a itemprop="author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" rel="author"><?php echo get_the_author() ?></a>
                                            </div>
					    <?php } ?>
					    <?php if($post_head_date != 0) { ?>
                                            <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><i class="momizat-icon-calendar"></i><?php the_time('Y/m/d'); ?></time>
                                            <?php } ?>
					    <?php if($post_head_cat != 0) { ?>
					    <div class="cat-link">
                                                <i class="momizat-icon-folder-open"></i><?php $category = get_the_category(); echo '<a class="category" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>'; ?>
                                            </div>
					    <?php } ?>
                                        </div>
                                        <?php } ?>
                                    </a>
                                </li>
                                <?php
                                endwhile;
                                else:
                                endif;
                                wp_reset_postdata();
                                ?>
                            </ul>
                        </div>
                    </section>
          
                <?php } ?>
	<?php 
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}
add_shortcode("scroller", "mom_scrollers");