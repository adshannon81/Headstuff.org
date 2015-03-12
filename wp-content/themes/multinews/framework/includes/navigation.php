<?php
		$deffect = mom_option('dropdown-effect');
		$sticky_logo = mom_option('sticky_navigation_logo', 'url');
		$sl_w = mom_option('sticky_navigation_logo', 'width');

?>
<nav id="navigation" class="navigation <?php echo $deffect; ?>" data-sticky_logo="<?php echo $sticky_logo; ?>" data-sticky_logo_width="<?php echo $sl_w; ?>" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement"><!--Navigation-->
<div class="inner"><!--inner-->
	<a href="<?php echo esc_url(home_url()); ?>" class="sticky_logo"><img src="<?php echo $sticky_logo; ?>" alt="<?php bloginfo('name'); ?>"></a>
		<?php if ( has_nav_menu( 'main' ) ) { 
        wp_nav_menu ( array( 'menu_class' => 'main-menu main-default-menu mom_visibility_desktop','container'=> 'ul', 'theme_location' => 'main', 'walker' => new mom_custom_Walker()  )); ?>
                        <?php
                        if (file_exists(get_template_directory() . '/demo/demo.php')) {
                            global $mom_iconic_menu;
                                wp_nav_menu ( array( 'menu_class' => 'main-menu mom_visibility_desktop display_none iconic_menu','container'=> 'ul', 'menu' => $mom_iconic_menu, 'walker' => new mom_custom_Walker()  ));
                        }
                        ?>	
         <div class="mom_visibility_device device-menu-wrap">
            <div class="device-menu-holder">
                <i class="momizat-icon-paragraph-justify2 mh-icon"></i> <span class="the_menu_holder_area"><i class="dmh-icon"></i><?php _e('Menu', 'framework'); ?></span><i class="mh-caret"></i>
            </div>
        <?php wp_nav_menu ( array( 'menu_class' => 'device-menu' ,'container'=> 'ul', 'theme_location' => 'main', 'walker' => new mom_custom_Walker()  )); ?>
        </div>
        <?php } else { ?> <i class="menu-message"><?php _e('Select your Main Menu from wp menus', 'framework'); ?></i> <?php }?>
<div class="clear"></div>
</div><!--inner-->
</nav><!--Navigation-->