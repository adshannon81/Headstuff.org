<?php
/*
    Template Name: Magazine
*/
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"><![endif]-->
	
	<title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<meta name="description" content="">
	<?php if(mom_option('enable_responsive') != true) { ?>
	<meta name="viewport" content="user-scalable=yes, minimum-scale=0.25, maximum-scale=3.0" />
	<?php } else {  ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php } ?>
    
	<?php if ( mom_option('custom_favicon') != 'false') { ?>
	<link rel="shortcut icon" href="<?php echo mom_option('custom_favicon', 'url'); ?>" />
	<?php } ?>
	<?php if ( mom_option('apple57_favicon') != 'false') { ?>
	<link rel="apple-touch-icon" href="<?php echo mom_option('apple57_favicon', 'url'); ?>" />
	<?php } ?>
	<?php if ( mom_option('apple72_favicon') != 'false') { ?>
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo mom_option('apple72_favicon', 'url'); ?>" />
	<?php } ?>
	<?php if ( mom_option('apple114_favicon') != 'false') { ?>
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo mom_option('apple114_favicon', 'url'); ?>" />
	<?php } ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


	<!--[if lt IE 9]>
	<script src="<?php echo MOM_HELPERS; ?>/js/html5.js"></script>
	<script src="<?php echo MOM_HELPERS; ?>/js/IE9.js"></script>
	<![endif]-->
	<?php if(mom_option('main_font') == '') { ?>
	<link href='http://fonts.googleapis.com/css?family=Archivo+Narrow:400,700' rel='stylesheet' type='text/css'>
	<?php } ?>
	<?php $dateformat = mom_option('date_format'); ?>
    <?php wp_head(); ?>
    <?php
	global $post;
    $magdisplay = get_post_meta($post->ID, 'mom_mag_display', true);
    $orderby = get_post_meta($post->ID, 'mom_mag_orderby', true);
    $magcat = get_post_meta($post->ID, 'mom_mag_cat', true);
    $magposts = get_post_meta($post->ID, 'mom_mag_posts', true);
    $maglogo = get_post_meta($post->ID, 'mom_mag_logo', true);
    if($maglogo == '') {
		$maglogo = MOM_IMG. '/magazine-logo.png';    
    }
    $magauto = get_post_meta($post->ID, 'mom_mag_auto', true);
    $maginterval = get_post_meta($post->ID, 'mom_mag_interval', true);
    
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
    </head>
    <body <?php body_class('magazine-wrap'); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
	    	<header class="fixed-header">
		    	<div class="inner">
			    	<div class="logo" itemscope="itemscope" itemtype="http://schema.org/Organization">
		                <a href="<?php echo esc_url(home_url()); ?>" itemprop="url" title="<?php bloginfo('name'); ?>"><img itemprop="logo" src="<?php echo $maglogo; ?>" alt="<?php bloginfo('name'); ?>"></a>
		                <meta itemprop="name" content="<?php bloginfo('name'); ?>">
		            </div>
		            
		            <?php get_template_part( 'framework/includes/navigation' ); ?>
		            
		    	</div>
	    	</header>
	    	
	    	<div class="magazine-container">
			<div class="bb-custom-wrapper">
				
				<div id="bb-bookblock" class="bb-bookblock">
					<?php
                                        if($magdisplay == 'cat'){
                                        	$query = new WP_Query( array( 'cat' => $magcat, 'posts_per_page' => $magposts, 'orderby' => $orderby ) );
                                        } else {
                                        	$query = new WP_Query( array( 'posts_per_page' => $magposts, 'orderby' => $orderby ) );
                                        }
                                        if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                                        ?>
                                            <div class="bb-item" itemscope="" itemtype="http://schema.org/Article">
                                            	<!-- Loading -->
                                            	<div id="circularG">
													<img src="<?php echo MOM_IMG ?>/mag-loader.gif">
												</div>
                                            	<!-- Loading -->
                                                <div itemprop="image" class="magazine-page-img" style="background-image: url(<?php echo mom_post_image('full'); ?>);background-attachment: scroll;"></div>
                                                <div class="ma-content-wrap">
                                                        <h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                                                        <?php if($post_head != 0) { ?>
                                                        <div class="entry-meta">
								    <?php if($post_head_author != 0) { ?>
								    <div class="author-link">
			                                            <?php _e('Posted by: ', 'framework'); ?><?php the_author_link(); ?>
			                                            </div>
			                                            <?php } ?>
			                                            <?php if($post_head_date != 0) { ?>
			                                            <div class="entry-date">
			                                            <?php _e('Date:', 'framework'); ?> <time datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><?php the_time($dateformat); ?></time>
			                                            </div>
			                                            <?php } ?>
			                                            <?php if($post_head_cat != 0) { ?>
			                                            <div class="cat-link">
			                                            <?php _e('in:', 'framework'); ?> <a href=""><?php the_category(', ') ?> </a>
			                                            </div>
			                                            <?php } ?>
                                                        </div>
                                                        <?php } ?>
                                                        <div class="entry-content">
                                                                <p>
                                                                    <?php global $post;
                                                                    $excerpt = $post->post_excerpt;
                                                                    if($excerpt==''){
                                                                    $excerpt = get_the_content('');
                                                                    }
                                                                    echo wp_html_excerpt(strip_shortcodes($excerpt), 245);
                                                                    ?> ...
                                                                </p>
                                                        </div>
                                                        <?php if(is_rtl()) { ?>
                                                        <a class="read-more" href="<?php the_permalink(); ?>"><i class="fa-icon-double-angle-left"></i> <?php _e('Read more', 'framework'); ?></a>
                                                        <?php } else { ?>
                                                        <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read more', 'framework'); ?> <i class="fa-icon-double-angle-right"></i></a>
														<?php } ?>
                                                </div>
                                            </div>
					<?php
                                        endwhile;
                                        else:
                                        endif;
                                        wp_reset_postdata();
                                        ?>
				</div>

				<nav class="magazine-nav">
					<a id="bb-nav-prev" href="#" class="bb-custom-icon bb-custom-left"><i class="enotype-icon-arrow-left7"></i></a>
					<a id="bb-nav-next" href="#" class="bb-custom-icon bb-custom-right"><i class="enotype-icon-uniE6D8"></i></a>
				</nav>

			</div>

		</div><!-- /container -->
                
        <script type="text/javascript">
        jQuery(document).ready(function($) {
	        $('.mom-megamenu ul.sub-menu li').mouseenter(function() {
			    var id = $(this).attr('id');
			    var id = id.split('-');
			    //console.log(id[2]);
			    $(this).parent().find('li').removeClass('active');
			    $(this).addClass('active');
			    $(this).parent().next('.sub-mom-megamenu, .sub-mom-megamenu2').find('.mom-cat-latest').hide();
			    $(this).parent().next('.sub-mom-megamenu, .sub-mom-megamenu2').find('#mom-mega-cat-'+id[2]).show();
			});
			
			// Responsive menus
	$('.top-menu-holder').click(function() {
	    $('.device-top-nav').slideToggle();
	    $(this).toggleClass('active');
	});
	$('.device-menu-holder').click(function() {
	    if ($(this).hasClass('active')) {
		    $('.device-menu li').each(function() {
			if ($(this).find('.mom_mega_wrap').length !== 0) {
			} else {
			    $(this).find('.sub-menu').slideUp();
			}
		    });
		    $('.device-menu').find('.dm-active').removeClass('dm-active');
		    $('.device-menu').find('.mom_custom_mega').slideUp();
	    }
	    $('.device-menu').slideToggle();
	    $(this).toggleClass('active');
	});
	$('.responsive-caret').click(function() {
	    var li = $(this).parent();
	    if (li.hasClass('dm-active') || li.find('.dm-active').length !== 0 || li.find('.sub-menu').is(':visible') || li.find('.mom_custom_mega').is(':visible') ) {
		li.removeClass('dm-active');
		li.children('.sub-menu').slideUp();
		if (li.find('.mom_mega_wrap').length === 0) {
		    	li.find('.sub-menu').slideUp();
		}
		if (li.hasClass('mom_default_menu_item') || li.find('.cats-mega-wrap').length !== 0) {
		    li.find('.sub-menu').slideUp();
		    li.find('.mom-megamenu').slideUp();
		    li.find('.sub-mom-megamenu').slideUp();
		    li.find('.sub-mom-megamenu2').slideUp();
		}
		li.find('.dm-active').removeClass('dm-active');
		if (li.find('.mom_custom_mega').length !== 0) {
		    li.find('.mom_custom_mega').slideUp();
		}
	
	    } else {
		$('.device-menu').find('.dm-active').removeClass('dm-active');
		li.addClass('dm-active');
		li.children('.sub-menu').slideDown();
		if (li.find('.cats-mega-wrap').length !== 0) {
		    li.find('.sub-menu').slideDown();
		    li.find('.mom-megamenu').slideDown();
		    li.find('.sub-mom-megamenu').slideDown();
		    li.find('.sub-mom-megamenu2').slideDown();
		}
		if (li.find('.mom_custom_mega').length !== 0) {
		    li.find('.mom_custom_mega').slideDown();
		}
	
	    }
	})
	$('.the_menu_holder_area').html($('.device-menu').find('.current-menu-item').children('a').html());
		});
        </script>
		<script type="text/javascript">
        jQuery(document).ready(function($) {
        var sh = true;
	      if (navigator.userAgent.match(/chrome/i) ){
	      	sh = false;
	      };
	      
	      var aut = false;
	      <?php if($magauto) { ?>
	      var aut = true;
	      <?php } ?>
	      
	      <?php if($maginterval) { ?>
	      var tim = <?php echo $maginterval; ?>;
	      <?php } else { ?>
	      var tim = 3000;
	      <?php } ?>
			var Page = (function() {
				
				var config = {
						$bookBlock : $( '#bb-bookblock' ),
						$navNext : $( '#bb-nav-next' ),
						$navPrev : $( '#bb-nav-prev' )
					},
					
      					init = function() {
						
						config.$bookBlock.bookblock( {
							speed : 1000,
							shadowSides : 0.8,
							shadowFlip : 0.4,
							autoplay : aut,
							interval : tim,
							shadows     : sh,
							<?php if( is_rtl() ) { ?>
							direction : 'rtl'
							<?php } ?>
						} );
						initEvents();
					},
					initEvents = function() {
						
						var $slides = config.$bookBlock.children();

						// add navigation events
						config.$navNext.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'next' );
							return false;
						} );

						config.$navPrev.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'prev' );
							return false;
						} );
						
						// add swipe events
						$slides.on( {
							'swipeleft' : function( event ) {
								config.$bookBlock.bookblock( 'next' );
								return false;
							},
							'swiperight' : function( event ) {
								config.$bookBlock.bookblock( 'prev' );
								return false;
							}
						} );

						// add keyboard events
						$( document ).keydown( function(e) {
							var keyCode = e.keyCode || e.which,
								arrow = {
									left : 37,
									up : 38,
									right : 39,
									down : 40
								};

							switch (keyCode) {
								case arrow.left:
									config.$bookBlock.bookblock( 'prev' );
									break;
								case arrow.right:
									config.$bookBlock.bookblock( 'next' );
									break;
							}
						} );
					};

					return { init : init };

			})();
                   	Page.init();
                    });
                    
		</script>
             <?php wp_footer(); ?>
	</body>
</html>	    	