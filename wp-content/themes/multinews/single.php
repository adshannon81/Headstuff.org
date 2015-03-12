<?php get_header(); ?>

<?php
    global $post;
    //page layout
    $layout = get_post_meta(get_the_ID(), 'mom_page_layout', true);
    //post settings
    $HFI = get_post_meta(get_the_ID(), 'mom_hide_feature', true);
    $DPS = get_post_meta(get_the_ID(), 'mom_blog_ps', true);
    $DPN = get_post_meta(get_the_ID(), 'mom_blog_np', true);
    $DAB = get_post_meta(get_the_ID(), 'mom_blog_ab', true);
    $DRP = get_post_meta(get_the_ID(), 'mom_blog_rp', true);
    $DPC = get_post_meta(get_the_ID(), 'mom_blog_pc', true);
    // story_higlight
    $SHE = get_post_meta($post->ID, 'mom_hide_highlights', true);
    $SH = get_post_meta($post->ID, 'mom_post_highlights', true);
    $mom_post_layout = get_post_meta($post->ID, 'mom_post_layout', true);
    if ($mom_post_layout == '') {
	$mom_post_layout = mom_option('post_layout');
    }
    $default_image_click = get_post_meta($post->ID, 'mom_default_image_click', true);
    if ($default_image_click == '') {
	$default_image_click = mom_option('post_layout_default_img');
    }
    $catid = get_the_category( $post->ID );
    $cat_data = get_option("category_".$catid[0]->term_id);
	if($cat_data != '') { 
		$cat_icon = isset($cat_data['icon']) ? $cat_data['icon'] : '' ; 
	} else {
		$cat_icon = '';
	}
	$postbreadcrumb = mom_option('post_bread');
    $posticon = mom_option('post_icon');
?>
				<?php if($mom_post_layout == 'layout1') { ?>
				
				<div class="post-layout1" style="background: url('<?php echo mom_post_image('full'); ?>') no-repeat center;"><div class="pl2-shadow"></div></div>
				
				<?php } else if($mom_post_layout == 'layout2') { ?>
				
				<div class="post-layout2" style="background: url('<?php echo mom_post_image('full'); ?>') no-repeat center;">
					<div class="pl2-shadow">	
						<div class="pl2-tab-wrap">
							<div class="inner">
								<h1 itemprop="name" class="entry-title"><?php the_title(); ?></h1>
			                    <?php if(mom_option('post_head')) { get_template_part( 'framework/includes/post-head' ); } ?>
							</div>
						</div>
					</div>
				</div>
				
				<?php } else if($mom_post_layout == 'layout3') { ?>
				
				<div class="post-layout3" style="background: url('<?php echo mom_post_image('full'); ?>') no-repeat center;">
					<div class="pl3-shadow">	
							<div class="inner">
								<div class="pl2-bottom">
									<?php if(mom_option('breadcrumb') != 0) { ?>
				                    <?php if($postbreadcrumb) { ?>
				                    <div class="post-crumbs entry-crumbs">
							<?php if ($cat_icon != '') { 
								if (0 === strpos($cat_icon, 'http')) {
									echo '<div class="crumb-icon"><i class="img_icon" style="background-image: url('.$cat_icon.')"></i></div>';
								} else {
									echo '<div class="crumb-icon"><i class="'.$cat_icon.'"></i></div>';
								}
							} ?>
				                        <?php mom_breadcrumb(); ?>
				                    </div>
				                    <?php } ?>
				                    <?php } ?>
									<h1 itemprop="name" class="entry-title"><?php the_title(); ?></h1>
				                    <?php if(mom_option('post_head')) { get_template_part( 'framework/includes/post-head' ); } ?>
								</div>
							</div>
					</div>
				</div>
				
				<?php } else if($mom_post_layout == 'layout4') { ?>

					<div class="inner pl4">
					<section class="section">
						<div class="post-layout4">
						    <img src="<?php echo mom_post_image('full'); ?>" alt="<?php the_title(); ?>">
							<div class="pl3-shadow">	
										<div class="pl2-bottom pl4-content">
											<?php if(mom_option('breadcrumb') != 0) { ?>
						                    <?php if($postbreadcrumb) { ?>
						                    <div class="post-crumbs entry-crumbs">
							<?php if ($cat_icon != '') { 
								if (0 === strpos($cat_icon, 'http')) {
									echo '<div class="crumb-icon"><i class="img_icon" style="background-image: url('.$cat_icon.')"></i></div>';
								} else {
									echo '<div class="crumb-icon"><i class="'.$cat_icon.'"></i></div>';
								}
							} ?>
						                        <?php mom_breadcrumb(); ?>
						                    </div>
						                    <?php } ?>
						                    <?php } ?>
											<h1 itemprop="name" class="entry-title"><?php the_title(); ?></h1>
						                    <?php if(mom_option('post_head')) { get_template_part( 'framework/includes/post-head' ); } ?>
										</div>
							</div>
						</div>
					</section>
					</div>
				
				<?php } ?>
                <div class="main-container"><!--container-->
                    
                    <?php if($mom_post_layout != 'layout3' && $mom_post_layout != 'layout4') { ?>
                    <?php if(mom_option('breadcrumb') != 0) { ?>
                    <?php if($postbreadcrumb) { ?>
                    <div class="post-crumbs entry-crumbs">
							<?php if ($cat_icon != '') { 
								if (0 === strpos($cat_icon, 'http')) {
									echo '<div class="crumb-icon"><i class="img_icon" style="background-image: url('.$cat_icon.')"></i></div>';
								} else {
									echo '<div class="crumb-icon"><i class="'.$cat_icon.'"></i></div>';
								}
							} ?>
                        <?php mom_breadcrumb(); ?>
                    </div>
                    <?php } ?>
                    <?php } } ?>
					
					<?php if ($layout != 'fullwidth') { ?>
                    <div class="main-left"><!--Main Left-->
                    	<div class="main-content" role="main"><!--Main Content-->
                    <?php } ?>
                            <div class="site-content page-wrap">
	                            <?php 
                                while ( have_posts() ) :
				the_post();
                                setPostViews(get_the_ID());
                                ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope="" itemtype="http://schema.org/Article">
                                    <?php if($mom_post_layout != 'layout2' && $mom_post_layout != 'layout3' && $mom_post_layout != 'layout4') { ?>
                                    <header>
                                        <h1 itemprop="name" class="entry-title"><?php the_title(); ?></h1>
                                        
                                        <?php if(mom_option('post_head')) { get_template_part( 'framework/includes/post-head' );} ?>
                                        
                                    </header>
                                    <?php } ?>
                                    
                                    <div class="entry-content clearfix">
                                                                                
                                        <?php get_template_part('framework/includes/post-formats'); ?>
                                        
                                        <?php if(mom_option('post_fimage')) {
					    
					    if( $HFI != 1 && has_post_thumbnail() ) { $has_image = 'has_f_image';} else { $has_image = '';}
					if($mom_post_layout != 'default') {$has_image = '';}
									    ?>
                                        <div class="entry-content-data <?php echo $has_image; ?>">
					<?php if($mom_post_layout == 'default') { ?>
                                        <?php if( $HFI != 1 && has_post_thumbnail() ) { ?>
                                        	<?php if ($HFI != 1) { 
	                                        if(mom_option('post_feaimage') != 0) {
						    $img_class = '';
						    $pt_zoom_start = '';
						    $pt_zoom_end = '';
						    if ($default_image_click == 'zoom') {
							$img_class = 'pt-zoom';
							$pt_zoom_start = '<a href="'.mom_post_image('full').'" class="lightbox_link">';
							$pt_zoom_end = '</a>';
						    }
                                        	?>
						
                                        	<?php if ( has_post_thumbnail()) { ?>
                                            <figure class="post-thumbnail <?php echo $img_class; ?>" itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
						<?php echo $pt_zoom_start; ?>
                                                <?php the_post_thumbnail('big-thumb-hd'); ?>
						<?php echo $pt_zoom_end; ?>
                                                <?php if ($default_image_click != 'zoom') { ?><span class="img-toggle"><i class="<?php if ( is_rtl() ) { ?>momizat-icon-arrow-down-left2<?php } else { ?>momizat-icon-arrow-down-right2<?php }  ?>"></i></span><?php } ?>
                                            </figure>
                                            <?php } 
	                                             } } }
					} //post layout
                                            ?>
                                            <?php if ($SHE != 0) { 
	                                            if(mom_option('post_story') != 0) { 
                                            ?>
                                            <?php if ($SH != '') { ?> 
											<div class="story-highlights">
											    <h4><?php _e('Story Highlights', 'framework'); ?></h4>
											    <ul>
													<?php
													$SH = '<li>'.str_replace(array("\r","\n\n","\n"),array('',"\n","</li>\n<li>"),trim($SH,"\n\r")).'</li>';
													echo $SH;
													?>
											    </ul>
											</div>
										    <?php } } } ?>
                                        </div>
                                        <?php } ?>
                                        <?php the_content(); ?>
                                        <?php wp_link_pages( array( 'before' => '<div class="my-paginated-posts">' . __( 'Pages:', 'framework' ), 'after' => '</div>' ) ); ?>		
                                    <div class="clearfix"></div>
                                    </div>
                                </article>
                                <?php
								endwhile;
								wp_reset_query();
								?>
                                <div class="clear"></div>
                                                                
                                <?php
                                if(mom_option('post_tags')) {
                                    the_tags( '<div class="entry-tag-links"><span>' . __( 'Tags:', 'framework' ) . '</span>', '', '</div>' );
                                }
                                ?>
                                
                               
                                <?php 
                                if(mom_option('post_sharee')) {
                                if ($DPS != 1) { mom_posts_share(get_permalink()); }
                                } 
                                ?>
                                
                                <?php
                                if(mom_option('post_nav')) {
                                if ($DPN != 1) { ?>
                                <div class="post-nav-links">
                                    <div class="post-nav-prev">
                                        <?php previous_post_link( '%link','<span>'. __( 'Previous :', 'framework' ).'</span> %title' ); ?>
                                    </div>
                                    <div class="post-nav-next">
                                        <?php next_post_link( '%link', '<span>'. __( 'Next :', 'framework' ).'</span> %title' ); ?>
                                    </div>
                                </div>
                                <?php 
                                	} 
                                } 
                                ?>
                                
                                <?php 
                                if(mom_option('post_author')) {
                                if ($DAB != 1) { get_template_part( 'framework/includes/post-author' ); } 
                                }
                                ?>
                                
                                <?php
                                if(mom_option('post_related')) { 
                                if ($DRP != 1) { get_template_part( 'framework/includes/post-related' ); }
                                } 
                                ?>
                                
                                <?php 
                                if(mom_option('post_comments')) {
                                if ($DPC != 1) { comments_template(); } 
                                }
                                ?>
                                
                            </div>
                            
                    <?php if ($layout != 'fullwidth') { ?>
                        </div><!--Main Content-->
                    	<?php get_sidebar('left'); ?>    
                    </div><!--Main left-->
                    <?php get_sidebar(); ?>
                    <?php } ?>
                </div><!--container-->
    
            </div><!--wrap-->
            
<?php get_footer(); ?>