<?php
function mom_feature_slider($atts, $content = null) {
	extract(shortcode_atts(array(
	'type' => 'def',
	'display' => 'latest',
	'cats' => '',
	'tag' => '',
	'orderby' => '',
	'number_of_posts' => '',
	'animation' => '',
	'animationin' => '',
	'animationout' => '',
	'autoplay' => '',
	'timeout' => '4000',
	'cap' => 'yes',
	'exc' => '',
	), $atts));
	
	ob_start();
	
	$rndn = rand(0,100);
	
	if ($animation == 'fade') {
		$animationout = 'fadeOut';
		$animationin = '';
	} elseif ($animation == 'slide') {
		$animationout = '';
		$animationin = '';
		
	} elseif ($animation == 'flip') {
		$animationout = 'slideOutDown';
		$animationin = 'flipInX';
	}
	if ($autoplay == 'no') {
		$autoplay = 'false';
	} else {
		$autoplay = 'true';		
	}
	
	$post_meta_hp = mom_option('post_meta_hp');
	if($post_meta_hp == 1) {
		$post_head = mom_option('post_head');
		$post_head_date = mom_option('post_head_date');
		} else {
		$post_head = 1;
		$post_head_date = 1;
		}
	
	if($type == 'video') {
		wp_enqueue_script('prettyPhoto');
	}
	?>
					<?php if($type == 'slider2') { ?> <!-- Full width Slider 2 -->
							
					<section class="section"><!--def slider-->
		                    	<div class="slider2 clearfix"> <!-- slider2 wrap -->
			                    	<?php
				                    if($display == 'cat') {
				                    	$query = new WP_Query( array( 'cat' => $cats, 'posts_per_page' => 2, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
				                    } elseif($display == 'tag') {
				                    	$query = new WP_Query( array( 'tag' => $tag, 'posts_per_page' => 2, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
				                    } else {
				                    	$query = new WP_Query( array( 'posts_per_page' => 2, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
				                    }
				                    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
				                    ?>
		                            <?php if( mom_post_image() != false ) { ?>
			                    	<div class="def-slider-item big-slider2" itemscope="" itemtype="http://schema.org/Article">
			                            <a itemprop="url" href="<?php the_permalink(); ?>"><img itemprop="image" src="<?php echo mom_post_image('catslider-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>"></a>
			                            <?php if($cap == 'yes') { ?>
			                            <div class="def-slider-cap">
			                                <div class="def-slider-title">
			                                    <h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			                                </div>
                                                <?php if($exc != false) { ?>
			                                <p class="def-slider-desc">
			                                    <?php global $post;
			                                    $excerpt = $post->post_excerpt;
			                                    if($excerpt==''){
			                                    $excerpt = get_the_content('');
			                                    }
			                                    echo wp_html_excerpt(strip_shortcodes($excerpt), $exc);
			                                    ?> ...
			                                </p>
			                                <?php } ?>
			                            </div>
			                            <?php } ?>
			                        </div>
			                        <?php } ?>
			                        <?php
		                            endwhile;
		                            else:
		                            endif;
		                            wp_reset_postdata();
		                            ?>
		                            
		                            <?php
				                    if($display == 'cat') {
				                    	$query = new WP_Query( array( 'cat' => $cats, 'posts_per_page' => 3, 'offset' => 2, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
				                    } elseif($display == 'tag') {
				                    	$query = new WP_Query( array( 'tag' => $tag, 'posts_per_page' => 3, 'offset' => 2, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
				                    } else {
				                    	$query = new WP_Query( array( 'posts_per_page' => 3, 'offset' => 2, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
				                    }
				                    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
				                    ?>
		                            <?php if( mom_post_image() != false ) { ?>
			                        <div class="def-slider-item small-slider2" itemscope="" itemtype="http://schema.org/Article">
			                            <a itemprop="url" href="<?php the_permalink(); ?>"><img itemprop="image" src="<?php echo mom_post_image('catslider-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>"></a>
			                            <?php if($cap == 'yes') { ?>
			                            <div class="def-slider-cap">
			                                <div class="def-slider-title">
			                                    <h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			                                </div>
                                                <?php if($exc != false) { ?>
			                                <p class="def-slider-desc">
			                                    <?php global $post;
			                                    $excerpt = $post->post_excerpt;
			                                    if($excerpt==''){
			                                    $excerpt = get_the_content('');
			                                    }
			                                    echo wp_html_excerpt(strip_shortcodes($excerpt), $exc);
			                                    ?> ...
			                                </p>
			                                <?php } ?>
			                            </div>
			                            <?php } ?>
			                        </div>
			                        <?php } ?>
			                        <?php
		                            endwhile;
		                            else:
		                            endif;
		                            wp_reset_postdata();
		                            ?>
		                    	</div><!-- slider2 wrap -->
		                    </section>
		                    
		            <?php } elseif($type == 'video') { ?>
	            		
	            		<section class="section mom-video-box">            
											<div class="main_tabs vid-box-wrap clearfix">
												<div class="widget-tabbed-body">
													<ul class="widget-tabbed-header">
														<li><a href="#"><?php __('Featured videos', 'framework'); ?></a></li>
														<li><a href="#"><?php __('Popular videos', 'framework'); ?></a></li>
													</ul>
													<div class="vid-<?php echo $rndn; ?> vid-vert">
														<ul class="vid-box-nav">
															<?php 
															if($display == 'cat') {
																$args = array(
																	    'post_type' => 'post',
																	    'cat' => $cats,
																	    'orderby' => $orderby,
																	    'no_found_rows' => true, 
																	    'cache_results' => false, 
																	    'posts_per_page' => $number_of_posts,
																	    'tax_query' => array(
																		    array(
																			'taxonomy' => 'post_format',
																			'field' => 'slug',
																			'terms' => array('post-format-video'),
																			'operator' => 'IN'
																		    ))
																	);
															} elseif($display == 'tag') {
																$args = array(
																	    'post_type' => 'post',
																	    'tag' => $tag,
																	    'orderby' => $orderby,
																	    'no_found_rows' => true, 
																	    'cache_results' => false, 
																	    'posts_per_page' => $number_of_posts,
																	    'tax_query' => array(
																		    array(
																			'taxonomy' => 'post_format',
																			'field' => 'slug',
																			'terms' => array('post-format-video'),
																			'operator' => 'IN'
																		    ))
																	);
															} else {
																$args = array(
																	    'post_type' => 'post',
																	    'orderby' => $orderby,
																	    'no_found_rows' => true, 
																	    'cache_results' => false, 
																	    'posts_per_page' => $number_of_posts,
																	    'tax_query' => array(
																		    array(
																			'taxonomy' => 'post_format',
																			'field' => 'slug',
																			'terms' => array('post-format-video'),
																			'operator' => 'IN'
																		    ))
																	);
															}
																                                 
															$query = new WP_Query( $args );
															$i = 0;
												             if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
															global $posts_st;
															$extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
												            if (isset($extra['video_type'])) { $video_type = $extra['video_type']; }
												            if (isset($extra['video_id'])) { $video_id = $extra['video_id']; }
												            if (isset($extra['html5_mp4_url'])) { $html5_mp4 = $extra['html5_mp4_url']; }
															$post_format = get_post_format();
															
															 $vi_height = '454';
												
															?>
															<li>
																	<figure class="post-thumbnail">
																		<a href="<?php the_permalink(); ?>">
																			<img itemprop="image" src="<?php echo mom_post_image('np-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>">
																		</a>
																	</figure>
																	<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
																	<?php if($post_head != 0) { ?>
													                 <div class="entry-meta">
													                 	<?php if($post_head_date != 0) { ?>
													                     <time datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><i class="momizat-icon-calendar"></i><?php mom_date_format(); ?></time>
													                     <?php } ?>
													                 </div>
													                 <?php } ?>
															</li>
															<?php 
															
															 $i++;
													        endwhile;
													        else:
													        endif;
													        wp_reset_postdata();
													        ?>   
														</ul>
													</div>
													<div class="nav-arr-nav">
															<a href="#" class="vid-nav0 vid-na-<?php echo $rndn; ?>"><i class="enotype-icon-arrow-up4"></i></a>
															<a href="#" class="vid-nav1 vid-na1-<?php echo $rndn; ?>"><i class="enotype-icon-arrow-down5"></i></a>
														</div>
													<div class="carousel vid-carousel-stage vidb-<?php echo $rndn; ?>">
															<ul class="vid-box-item-wrap">
																<?php 
																if($display == 'cat') {
																	$args = array(
																		    'post_type' => 'post',
																		    'cat' => $cats,
																		    'orderby' => $orderby,
																		    'no_found_rows' => true, 
																		    'cache_results' => false, 
																		    'posts_per_page' => $number_of_posts,
																		    'tax_query' => array(
																			    array(
																				'taxonomy' => 'post_format',
																				'field' => 'slug',
																				'terms' => array('post-format-video'),
																				'operator' => 'IN'
																			    ))
																		);
																} elseif($display == 'tag') {
																	$args = array(
																		    'post_type' => 'post',
																		    'tag' => $tag,
																		    'orderby' => $orderby,
																		    'no_found_rows' => true, 
																		    'cache_results' => false, 
																		    'posts_per_page' => $number_of_posts,
																		    'tax_query' => array(
																			    array(
																				'taxonomy' => 'post_format',
																				'field' => 'slug',
																				'terms' => array('post-format-video'),
																				'operator' => 'IN'
																			    ))
																		);
																} else {
																	$args = array(
																		    'post_type' => 'post',
																		    'orderby' => $orderby,
																		    'no_found_rows' => true, 
																		    'cache_results' => false, 
																		    'posts_per_page' => $number_of_posts,
																		    'tax_query' => array(
																			    array(
																				'taxonomy' => 'post_format',
																				'field' => 'slug',
																				'terms' => array('post-format-video'),
																				'operator' => 'IN'
																			    ))
																		);
																}	                                 
																$query = new WP_Query( $args );
																$i = 0;
													             if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
																global $posts_st;
																$extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
													            if (isset($extra['video_type'])) { $video_type = $extra['video_type']; }
													            if (isset($extra['video_id'])) { $video_id = $extra['video_id']; }
													            if (isset($extra['html5_mp4_url'])) { $html5_mp4 = $extra['html5_mp4_url']; }
													            if (isset($extra['audio_type'])) { $audio_type = $extra['audio_type']; } else {$audio_type = '';}					  	
															  	if (isset($extra['audio_sc'])) { $soundcloud = $extra['audio_sc']; } else {$soundcloud = '';}
															    if (isset($extra['audio_mp3']) && $extra['audio_mp3'] != '') { $mp3 = ' mp3="'.$extra['audio_mp3'].'"'; } else { $mp3 = ''; }
															    if (isset($extra['audio_ogg']) && $extra['audio_ogg'] != '') { $ogg = ' ogg="'.$extra['audio_ogg'].'"'; } else { $ogg = ''; }
															    if (isset($extra['audio_m4a']) && $extra['audio_m4a'] != '') { $m4a = ' m4a="'.$extra['audio_m4a'].'"'; } else { $m4a = ''; }
															    if (isset($extra['audio_wav']) && $extra['audio_wav'] != '') { $wav = ' wav="'.$extra['audio_wav'].'"'; } else { $wav = ''; }
															    if (isset($extra['audio_wma']) && $extra['audio_wma'] != '') { $wma = ' wma="'.$extra['audio_wma'].'"'; } else { $wma = ''; }
																$post_format = get_post_format();
																				  
																 if ($video_type == 'youtube') {
																 	$lin = "http://www.youtube.com/watch?v=".$video_id;
															     } elseif ($video_type == 'facebook') { 
															     	$lin = "http://www.facebook.com/video/embed?video_id=".$video_id;
																 } elseif ($video_type == 'vimeo') { 
																 	$lin = "http://vimeo.com/".$video_id;
																 } elseif ($video_type == 'daily') { 
																 	$lin = "http://www.dailymotion.com/embed/video/".$video_id;
																} elseif ($video_type == 'html5') { 
																	$lin = "<div class='video_frame'>".do_shortcode('[video'.$mp4.$m4v.$webm.$ogv.$wmv.$flv.$html5_poster.']')."</div>";
																} 
																?>
																<li <?php post_class('vid-item'); ?>>
																	<a class="vid-item-img" rel="prettyPhoto[iframes]" itemprop="url" href="<?php echo $lin; ?>"><img itemprop="image" src="<?php echo mom_post_image('big-thumb-hd'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>"></a>
																	<h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
																</li>
																<?php 
																$i++;
														        endwhile;
														        else:
														        endif;
														        wp_reset_postdata();
													
														        ?> 
															</ul>
															<div class="vid-items-arrnav">
														        <a href="#" class="vid-items-nav0 vid-items-nav0-<?php echo $rndn; ?>"><i class="enotype-icon-arrow-left7"></i></a>
																<a href="#" class="vid-items-nav1 vid-items-nav1-<?php echo $rndn; ?>"><i class="enotype-icon-uniE6D8"></i></a>
													        </div>
													</div>	
												</div>
											</div>
										</section>
										<script>
										jQuery(document).ready(function($){
										    $("a[rel^='prettyPhoto']").prettyPhoto();
										  });
										(function($) {
										    // This is the connector function.
										    // It connects one item from the navigation carousel to one item from the
										    // stage carousel.
										    // The default behaviour is, to connect items with the same index from both
										    // carousels. This might _not_ work with circular carousels!
										    var connector = function(itemNavigation, carouselStage) {
										        return carouselStage.jcarousel('items').eq(itemNavigation.index());
										    };
										
										    $(function() {
										        // Setup the carousels. Adjust the options for both carousels here.
										        var carouselStage      = $('.vidb-<?php echo $rndn; ?>').jcarousel();
										        var carouselNavigation = $('.vid-<?php echo $rndn; ?>').jcarousel();
										
										        // We loop through the items of the navigation carousel and set it up
										        // as a control for an item from the stage carousel.
										        carouselNavigation.jcarousel('items').each(function() {
										            var item = $(this);
										
										            // This is where we actually connect to items.
										            var target = connector(item, carouselStage);
										
										            item
										                .on('jcarouselcontrol:active', function() {
										                    carouselNavigation.jcarousel('scrollIntoView', this);
										                    item.addClass('active');
										                })
										                .on('jcarouselcontrol:inactive', function() {
										                    item.removeClass('active');
										                })
										                .jcarouselControl({
										                    target: target,
										                    carousel: carouselStage
										                });
										        });
												
										        // Setup controls for the stage carousel
										        $('.vid-items-nav0-<?php echo $rndn; ?>')
										            .on('jcarouselcontrol:inactive', function() {
										                $(this).addClass('inactive');
										            })
										            .on('jcarouselcontrol:active', function() {
										                $(this).removeClass('inactive');
										            })
										            .jcarouselControl({
										                target: '-=1'
										            });
										
										        $('.vid-items-nav1-<?php echo $rndn; ?>')
										            .on('jcarouselcontrol:inactive', function() {
										                $(this).addClass('inactive');
										            })
										            .on('jcarouselcontrol:active', function() {
										                $(this).removeClass('inactive');
										            })
										            .jcarouselControl({
										                target: '+=1'
										            });
												
												var windowSize = $(window).width();
										
										        if (windowSize <= 1165) {
											        $it = '-=4';
											        $bt = '+=4';
											    } else  if($('body').hasClass('col2')) {
											    	$it = '-=4';
											        $bt = '+=4';
										        } else {
											        $it = '-=5';
											        $bt = '+=5';
										        }	
										        // Setup controls for the navigation carousel
										        $('.vid-na-<?php echo $rndn; ?>')
										            .on('jcarouselcontrol:inactive', function() {
										                $(this).addClass('inactive');
										            })
										            .on('jcarouselcontrol:active', function() {
										                $(this).removeClass('inactive');
										            })
										            .jcarouselControl({
										                target: $it
										            });
										
										        $('.vid-na1-<?php echo $rndn; ?>')
										            .on('jcarouselcontrol:inactive', function() {
										                $(this).addClass('inactive');
										            })
										            .on('jcarouselcontrol:active', function() {
										                $(this).removeClass('inactive');
										            })
										            .jcarouselControl({
										                target: $bt
										            });
										    });
										})(jQuery);			
											</script>
											
					<?php } else { ?> <!-- Default slider --> 
					
                            <section class="section"><!--def slider-->
                                <div class="def-slider">
                                    <div class="def-slider-wrap momizat-custom-slider mcs-<?php echo $rndn; ?>">
                                        <?php
					                    if($display == 'cat') {
					                    	$query = new WP_Query( array( 'cat' => $cats, 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
					                    } elseif($display == 'tag') {
					                    	$query = new WP_Query( array( 'tag' => $tag, 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
					                    } else {
					                    	$query = new WP_Query( array( 'posts_per_page' => $number_of_posts, 'orderby' => $orderby, 'no_found_rows' => true, 'cache_results' => false ) );
					                    }
					                    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
					                    ?>
                                        <?php if( mom_post_image() != false ) { ?>
                                        <div class="def-slider-item" itemscope="" itemtype="http://schema.org/Article">
                                            <a itemprop="url" href="<?php the_permalink(); ?>"><img class="appear" itemprop="image" src="<?php echo mom_post_image('slider-thumb'); ?>" data-hidpi="<?php echo mom_post_image('big-thumb-hd'); ?>" alt="<?php the_title(); ?>"></a>
                                            <?php if($cap == 'yes') { ?>
                                            <div class="def-slider-cap">
                                                <div class="def-slider-title">
                                                    <h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                </div>
                                                <?php if($exc != false) { ?>
				                                <p class="def-slider-desc">
				                                    <?php global $post;
				                                    $excerpt = $post->post_excerpt;
				                                    if($excerpt==''){
				                                    $excerpt = get_the_content('');
				                                    }
				                                    echo wp_html_excerpt(strip_shortcodes($excerpt), $exc, '...');
				                                    ?>
				                                </p>
				                                <?php } ?>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <?php } ?>
                                        <?php
                                        endwhile;
                                        else:
                                        endif;
                                        wp_reset_postdata();
                                        ?>
                                    </div>
                                
                                </div>
                            </section><!--def slider-->
			    <script>
				jQuery(document).ready(function($) {
					var rtl = false;
					<?php if (is_rtl()) { ?>
						rtl = true;
					<?php } ?>
				//Slider
				$('.mcs-<?php echo $rndn; ?>').owlCarousel({
					animateOut: '<?php echo $animationout; ?>',
					animateIn: '<?php echo $animationin; ?>',
					autoplay:<?php echo $autoplay; ?>,
					autoplayTimeout:<?php echo $timeout; ?>,
					autoplayHoverPause:false,
					autoHeight:true,
					rtl: rtl,
					loop: true,
					items:1,
					nav: true,
					 navText: ['<span class="enotype-icon-arrow-left7"></span>',
						'<span class="enotype-icon-uniE6D8"></span>'
					],
					smartSpeed:1000,
				});
			      });
			    </script>
               <?php } ?> <!-- End Slider type -->             	
	<?php 
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

add_shortcode("feature_slider", "mom_feature_slider");