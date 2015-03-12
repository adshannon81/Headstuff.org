<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php if(mom_option('enable_responsive') != true) { ?>
	<meta name="viewport" content="user-scalable=yes, minimum-scale=0.25, maximum-scale=3.0" />
	<?php } else {  ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php } ?>
    
	<?php if ( mom_option('custom_favicon') != 'false') { ?>
	<link rel="shortcut icon" href="<?php echo mom_option('custom_favicon', 'url'); ?>" />
	<?php } ?>
	<?php if ( mom_option('apple_touch_icon', 'url') != '') { ?>
	<link rel="apple-touch-icon" href="<?php echo mom_option('apple_touch_icon', 'url'); ?>" />
	<?php } else { ?>
	<link rel="apple-touch-icon" href="<?php echo MOM_URI; ?>/apple-touch-icon-precomposed.png" />
	<?php } ?>
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<!--[if lt IE 9]>
	<script src="<?php echo MOM_HELPERS; ?>/js/html5.js"></script>
	<script src="<?php echo MOM_HELPERS; ?>/js/IE9.js"></script>
	<![endif]-->
<?php wp_head(); ?>
</head>
    <body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <?php do_action('mom_first_on_body'); ?>
    	<?php if(mom_option('bg_ads') == true) { ?>
        	<a style="height:<?php echo mom_option('bg_ads_h', 'height'); ?>" class="ad_bg" href="<?php echo mom_option('bg_ads_url'); ?>" target="_blank">&nbsp;</a>
        <?php } ?>
        <?php
        $mom_layout = '';
	$theme_layout = mom_option('theme_layout');
	if (is_singular()) {
	    $theme_layout = get_post_meta($post->ID, 'mom_theme_layout', true);
	    if ($theme_layout == '') {
		$theme_layout = mom_option('theme_layout');
	    }
	}
        if($theme_layout == 'boxed') {
            $mom_layout = ' class="fixed_wrap fixed clearfix"';
        } else if($theme_layout == 'boxed2') {
            $mom_layout = ' class="fixed_wrap fixed2 clearfix"';
        } else {
            $mom_layout = ' class="fixed_wrap"';
        }
        ?>
        <div<?php echo $mom_layout; ?>><!--fixed layout-->
            <div class="wrap clearfix"><!--wrap-->
                <header class="header"><!--Header-->
                
                <div id="header-wrapper"><!-- header wrap -->
				<?php if(mom_option('tb_disable')) { get_template_part( 'framework/includes/topbar' );  } ?>
                    
                    <div class="header-wrap"><!--header content-->
                        <div class="inner"><!--inner-->
                        <?php if(mom_option('logo_type') == 'logo_image') { ?>
                            <div class="logo" itemscope="itemscope" itemtype="http://schema.org/Organization">
                                <a href="<?php echo esc_url(home_url()); ?>" itemprop="url" title="<?php bloginfo('name'); ?>">
                                <?php if(mom_option('logo_img', 'url') != '') { ?>
                                		<img itemprop="logo" src="<?php echo mom_option('logo_img','url'); ?>" alt="<?php bloginfo('name'); ?>"/>  
                                <?php } else { ?>
                                		<?php if(mom_option('header_style') == ''){ ?>
                                		<img itemprop="logo" src="<?php echo MOM_IMG ?>/logo.png" alt="<?php bloginfo('name'); ?>"/>
                                		<?php } else { ?>
                                		<img itemprop="logo" src="<?php echo MOM_IMG ?>/logo-dark.png" alt="<?php bloginfo('name'); ?>"/>
                                		<?php } ?>
                                <?php } ?>
				    <?php if(mom_option('retina_logo_img','url') != '') { ?>
<img itemprop="logo" class="mom_retina_logo" src="<?php echo mom_option('retina_logo_img','url'); ?>" width="<?php echo mom_option('logo_img','width'); ?>" height="<?php echo mom_option('logo_img','height'); ?>" alt="<?php bloginfo('name'); ?>" />
                                 <?php } else { ?>
		                                 <?php if(mom_option('logo_img', 'url') != '') { ?>
                                        <img itemprop="logo" class="mom_retina_logo" src="<?php echo mom_option('logo_img','url'); ?>" width="<?php echo mom_option('logo_img','width'); ?>" height="<?php echo mom_option('logo_img','height'); ?>" alt="<?php bloginfo('name'); ?>" />

						 <?php } else { ?>
                                 		<?php if(mom_option('header_style') == ''){ ?>
	                                     <img itemprop="logo" class="mom_retina_logo" src="<?php echo MOM_IMG ?>/logo-hd.png" width="<?php echo mom_option('logo_img','width'); ?>" height="<?php echo mom_option('logo_img','height'); ?>" alt="<?php bloginfo('name'); ?>"/>  
	                                      <?php } else { ?>
	                                      <img itemprop="logo" class="mom_retina_logo" src="<?php echo MOM_IMG ?>/logo-hd-dark.png" width="<?php echo mom_option('logo_img','width'); ?>" height="<?php echo mom_option('logo_img','height'); ?>" alt="<?php bloginfo('name'); ?>"/>  
	                                      <?php } ?>
					      <?php } ?>
                                    <?php } ?>
                                </a>
                                <meta itemprop="name" content="<?php bloginfo('name'); ?>">
                            </div>
                        <?php } else { ?>
                            <div class="logo" itemscope="itemscope" itemtype="http://schema.org/Organization">
                                <h1 class="site_title"><a href="<?php echo esc_url(home_url()); ?>" itemprop="url" title="MultiNews" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<h2 class="site_desc"><?php bloginfo( 'description' ); ?></h2>
                                <meta itemprop="name" content="<?php bloginfo('name'); ?>">
                            </div>
                        <?php } ?>
                            
			<?php if(mom_option('h_banner_disable')) { ?>
                <div class="header-banner">
				<?php echo do_shortcode('[ad id="'.mom_option('header_banner').'"]'); ?>
			    </div>
			<?php } ?>
                            
                        </div><!--inner-->
                    </div><!--header content-->
                </div><!-- header wrap -->
					
					<?php get_template_part( 'framework/includes/navigation' ); ?>
                    
                    <?php if(mom_option('bn_bar')) { get_template_part( 'framework/includes/breaking' ); } ?>
                
                </header><!--Header-->
                <?php do_action('mom_before_content'); ?>