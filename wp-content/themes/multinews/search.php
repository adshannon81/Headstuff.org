    <?php get_header(); ?>
<?php
                $cats = get_categories();
                
                $category = '';
                $year = '';
                $monthnum = '';
                $filter = '';
                $sortby = '';
                if (isset($_GET['category'])) {
                           $category = $_GET['category'];     
                }
                if (isset($_GET['year'])) {
                                $year = (int)$_GET['year'];
                }
                if (isset($_GET['month'])) {
                                $monthnum = (int)$_GET['month'];
                }
                
                if (isset($_GET['format'])) {
                                $filter = $_GET['format'];
                }

                if (isset($_GET['sortby'])) {
                                $sortby = $_GET['sortby'];
                }
                
                //$months = range(1,12);
                $months = array (
                                '1' => __('January', 'framework'),
                                '2' => __('February', 'framework'),
                                '3' => __('March', 'framework'),
                                '4' => __('April', 'framework'),
                                '5' => __('May', 'framework'),
                                '6' => __('June', 'framework'),
                                '7' => __('July', 'framework'),
                                '8' => __('August', 'framework'),
                                '9' => __('September', 'framework'),
                                '10' => __('October', 'framework'),
                                '11' => __('November', 'framework'),
                                '12' => __('December', 'framework')
                );
                $formats = get_theme_support( 'post-formats' );
                
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

<form role="search" method="get" id="advanced-search" action="<?php echo home_url('/'); ?>">
    <div class="main-container search-page"><!--container--> 
    				<?php if(mom_option('breadcrumb') != 0) { ?>
                    <?php if(mom_option('search_bread') != false) { ?>
                    <div class="entry-crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
                        <div class="crumb-icon"><i class="momizat-icon-search"></i></div>
                        <?php mom_breadcrumb(); ?>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    
                    <?php if(mom_option('adv_search') != false) { ?>
                    <section class="section advanced-search clearfix">
                                <div class="adv-search-form">
                                    <label for="adv-s"><?php _e('keywords:', 'framework'); ?></label>
                                    <input type="text" id="adv-s" class="adv-s" placeholder="<?php _e('Enter keywords', 'framework'); ?>" value="<?php echo $s; ?>" name="s" data-nokeyword="<?php _e('Keyword is required.', 'framework'); ?>">
                                    <span class="adv-s-cat">
                                            <label for="adv-cat"><?php _e('Category:', 'framework'); ?></label>
                                            <div class="select-wrap">
                                                    <select id="adv-cat" name="category">
                                                                <?php
                                                                echo '<option value="">'.__('All', 'framework').'</option>';
                                                                foreach ( $cats as $cat ) {
                                                                echo '<option value="'.$cat->term_id.'"'.selected( $category, $cat->term_id ).'>' . $cat->name . '</option>';
                                                                }
                                                                ?>
                                                    </select>
                                                    <div class="sort-arrow"></div>
                                            </div>
                                    </span>
                                    <span class="adv-s-month">
                                            <label for="adv-year"><?php _e('Date:', 'framework'); ?></label>
                                            <div class="select-wrap">
                                                    <select id="adv-year" name="year">
                                                <?php
                                                  echo '<option value="">...</option>';
                                                echo mom_get_years('year');
                                                ?>
                                                    </select>
                                                    <div class="sort-arrow"></div>
                                            </div>
                                            <div class="select-wrap">
                                                            <select id="adv-mon" name="month">
                                                                <?php
                                                                echo '<option value="">...</option>';
                                                                foreach ($months as $val => $name) { ?>
                                                                                <option value="<?php echo $val; ?>" <?php selected( $monthnum, $val ); ?>><?php echo $name; ?></option>
                                                                <?php } ?>
                                                    </select>
                                            <div class="sort-arrow"></div>
                                            </div>
                                    </span>
                                    <span class="adv-s-format">
                                            <label for="adv-format"><?php _e('Filter by:', 'framework'); ?></label>
                                            <div class="select-wrap">
                                                    <select id="adv-format" name="format">
                                                <?php
                                                echo '<option value="">'.__('All', 'framework').'</option>';
                                                foreach ($formats[0] as $format) { ?>
                                                                <option value="<?php echo $format; ?>" <?php selected( $filter, $format ); ?>><?php echo $format; ?></option>
                                                <?php } ?>
                                                    </select>
                                                    <div class="sort-arrow"></div>
                                            </div>
                                    </span>
                                    <input type="hidden" name="go">
                                    <input type="submit" class="submit" value="<?php _e('Search', 'framework'); ?>">
                                </div>
                    </section>      
                    <?php } ?>
            <div class="full-main-content" role="main"><!--Full width Main Content-->
                
                <div class="site-content page-wrap nb1">
                                                    
                                <header class="block-title">
                                    <h2><?php printf( __( 'Search Results for: %s', 'framework' ), get_search_query() ); ?></h2>
                                        
                                        <?php if(mom_option('search_sort') != false) { ?>
                                        <div class="media-sort-form">
                                            <span class="media-sort-title"><?php _e('Sort by:', 'framework'); ?></span>
                                               <div class="media-sort-wrap">
                                                       <select id="media-sort" name="sortby">
                                                               <option value="DESC" <?php selected( $sortby, 'DESC' ); ?>><?php _e('Descending', 'framework'); ?></option>
                                                               <option value="ASC" <?php selected( $sortby, 'ASC' ); ?>><?php _e('Ascending', 'framework'); ?></option>
                                                       </select>
                                               <div class="sort-arrow"></div>
                                           </div>
                                       </div>
                                        <?php } ?>
                                </header>
                                <?php
                                $posts_pre_page = mom_option('search_count');
                                $args = '';
                             	global $paged;
                                if (isset($_GET['go'])) { 
                                if ($filter == '') {
                                                $args = array (
                                                                'post_type' => array('post', 'page'),
                                                                's' => $s,
                                                                'cat' => $category,
                                                                'year' => $year,
                                                                'monthnum' => $monthnum,
                                                                'paged' => $paged,
                                                                'posts_per_page' => $posts_pre_page,
                                                                'order' => $sortby,
                                                );
                                } else {
                                                $filter = 'post-format-'.$filter;
                                                $args = array (
                                                                'post_type' => array('post', 'page'),
                                                                's' => $s,
                                                                'cat' => $category,
                                                                'year' => $year,
                                                                'paged' => $paged,
                                                                'monthnum' => $monthnum,
                                                                'posts_per_page' => $posts_pre_page,
                                                                'order' => $sortby,
                                                                'tax_query' => array(
                                                                                array(
                                                                                  'taxonomy' => 'post_format',
                                                                                  'field' => 'slug',
                                                                                  'terms' => $filter
                                                                                )
                                                                )
                                                );

                                }
                                $advs_Query = new WP_Query($args) ;
                                if ( $advs_Query->have_posts() ) :
                                echo '<ul>';
                                while ( $advs_Query->have_posts() ) : $advs_Query->the_post();
								if(mom_option('search_page_ex') == true) { if (is_type_page()) continue; }
                                ?>
                        <li <?php post_class(); ?> itemscope="" itemtype="http://schema.org/Article">
                            <?php if (mom_post_image() != false) { ?>
                            <figure class="post-thumbnail"><a href="<?php the_permalink(); ?>">
                                <img itemprop="image" src="<?php echo mom_post_image('search-grid'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="">
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
                                <p>
                                    <?php global $post;
                                    $excerpt = $post->post_excerpt;
                                    if($excerpt==''){
                                    $excerpt = get_the_content('');
                                    }
                                    echo wp_html_excerpt(strip_shortcodes($excerpt), 115);
                                    ?> ...
                                </p>
                            </div>
                            <?php if($post_head != 0) { ?>
                            <div class="entry-meta">
                            <?php if($post_head_date != 0) { ?>
                                <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><i class="momizat-icon-calendar"></i><?php echo mom_date_format(); ?></time>
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
                <?php endwhile;
                echo '</ul>';
                   mom_pagination($advs_Query->max_num_pages); 
                else: ?>
                <p><?php _e('Sorry, no posts matched your criteria.', 'framework'); ?></p>
                <?php endif; ?>
                  <?php wp_reset_postdata(); ?>
                <?php } else { 
                              query_posts(array('posts_per_page' => $posts_pre_page, 's' => $s, 'paged' => $paged));
                              if ( have_posts() ) :
                              echo '<ul>';
                              while ( have_posts() ) : the_post(); 
                              if(mom_option('search_page_ex') == true) { if (is_type_page()) continue; }
                              ?>
                        <li <?php post_class(); ?> itemscope="" itemtype="http://schema.org/Article">
                            <?php if (mom_post_image() != false) { ?>
                            <figure class="post-thumbnail"><a href="<?php the_permalink(); ?>">
                                <img itemprop="image" src="<?php echo mom_post_image('search-grid'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="">
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
                                <p>
                                    <?php global $post;
                                    $excerpt = $post->post_excerpt;
                                    if($excerpt==''){
                                    $excerpt = get_the_content('');
                                    }
                                    echo wp_html_excerpt(strip_shortcodes($excerpt), 115);
                                    ?> ...
                                </p>
                            </div>
                            <?php if($post_head != 0) { ?>
                            <div class="entry-meta">
                                <?php if($post_head_date != 0) { ?>
                                <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><i class="momizat-icon-calendar"></i><?php echo mom_date_format(); ?></time>
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
                <?php endwhile;
                echo '</ul>';
                     mom_pagination(); 
                else: ?>
                <p><?php _e('Sorry, no posts matched your criteria.', 'framework'); ?></p>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
                <?php } ?>
                </div>
                
            </div><!--Full width Main Content-->
    </div><!--container-->
    </form>

</div><!--wrap-->

<?php get_footer(); ?>