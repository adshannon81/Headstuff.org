<div class="top-bar"><!--topbar-->
    <div class="inner"><!--inner-->
<?php
if(mom_option('today_date')) {
$date_format = mom_option('today_date_format');
?>
<div class="today_date">
<p><?php  echo date_i18n( $date_format , strtotime("11/15-1976") ); ?></p>
</div>
<?php } ?>

            <?php if(mom_option('tb_left_content') == 'custom') {
    echo do_shortcode(mom_option('tb_custom_text'));
} elseif (mom_option('tb_left_content') == 'social') { ?>
    <ul class="top-social-icon">
	<?php get_template_part( 'framework/includes/social' ); ?>
    </ul>
<?php } else { ?>
    <?php if ( has_nav_menu( 'topnav' ) ) { 
    wp_nav_menu( array( 'container' => 'ul' , 'menu_class' => 'top-menu', 'theme_location' => 'topnav'));
/*     Mobile Menu */
	?>  
    <div class="mom_visibility_device device-top-menu-wrap mobile-menu">
      <div class="top-menu-holder"><i class="fa-icon-align-justify mh-icon"></i></div>
      <?php  wp_nav_menu ( array( 'menu_class' => 'device-top-nav','container'=> 'ul', 'theme_location' => 'topnav', 'walker' => new mom_topmenu_custom_walker() )); ?>
     </div>
    
    <?php } else { ?> <i class="menu-message"><?php _e('Select your Top Menu from wp menus', 'framework'); ?></i> <?php } ?>
<?php } ?>
            
<div class="top-bar-right">
<?php if(mom_option('tb_right_content') == 'custom') {
    echo do_shortcode(mom_option('tb_custom_text'));
} elseif (mom_option('tb_right_content') == 'menu') { ?>
    <?php if ( has_nav_menu( 'topnav' ) ) { 
    wp_nav_menu( array( 'container' => 'ul' , 'menu_class' => 'top-menu', 'theme_location' => 'topnav'));
/*     Mobile Menu */
	?>
    <div class="mom_visibility_device device-top-menu-wrap mobile-menu">
      <div class="top-menu-holder"><i class="fa-icon-align-justify mh-icon"></i></div>
      <?php  wp_nav_menu ( array( 'menu_class' => 'device-top-nav','container'=> 'ul', 'theme_location' => 'topnav', 'walker' => new mom_topmenu_custom_walker() )); ?>
     </div>
    
    <?php } else { ?> <i class="menu-message"><?php _e('Select your Top Menu from wp menus', 'framework'); ?></i> <?php } ?>
<?php } else { ?>
    <ul class="top-social-icon">
	<?php get_template_part( 'framework/includes/social' );
	if(mom_option('tb_search_disable')) { ?>
	<li class="top-search"><a href="#"></a></li>
		<div class="search-dropdown">
			<form class="mom-search-form" method="get" action="<?php echo home_url(); ?>/">
			    <input type="text" id="tb-search" class="sf" name="s" placeholder="<?php _e('Enter keywords and press enter', 'framework') ?>" required="" autocomplete="off">
				<?php if(mom_option('ajax_search_disable')) { ?><span class="sf-loading"><img src="<?php echo MOM_IMG; ?>/ajax-search-nav.png" alt=""></span><?php } ?>
			</form>
			<?php if(mom_option('ajax_search_disable')) { ?>
			<div class="ajax-search-results"></div>
			<?php } ?>
	    </div>
	<?php } ?>
    </ul>
<?php } ?>
</div>
            
        </div><!--inner-->
    </div><!--topbar-->