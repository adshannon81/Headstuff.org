<?php
if(mom_option('header_social')) {
    if(mom_option('hs_facebook')) { 
?>
    <li class="facebook"><a href="<?php echo mom_option('hs_facebook'); ?>" target="_blank"></a></li>
    <?php } if(mom_option('hs_twitter')) { ?>
    <li class="twitter"><a href="<?php echo mom_option('hs_twitter'); ?>" target="_blank"></a></li>
    <?php } if(mom_option('hs_youtube')) { ?>
    <li class="youtube"><a href="<?php echo mom_option('hs_youtube'); ?>" target="_blank"></a></li>
    <?php } if(mom_option('hs_google')) { ?>
    <li class="google"><a href="<?php echo mom_option('hs_google'); ?>" target="_blank"></a></li>
    <?php } if(mom_option('hs_pin')) { ?>
    <li class="pin"><a href="<?php echo mom_option('hs_pin'); ?>" target="_blank"></a></li>
    <?php } if(mom_option('hs_vimeo')) { ?>
    <li class="vimeo"><a href="<?php echo mom_option('hs_vimeo'); ?>" target="_blank"></a></li>
    <?php } if(mom_option('rss_on_off') != false) { ?>
    <li class="rss"><a href="<?php if(mom_option('hs_rss') == '') { bloginfo( 'rss2_url' ); } else { echo mom_option('hs_rss'); } ?>" target="_blank"></a></li>
    <?php }
    //print_r(mom_option('social_icons'));
    $icons = mom_option('custom_social_icons');
    if ($icons != false) {
    foreach ($icons as $icon) {
	if ( (isset($icon['image']) &&  $icon['image'] != '') || (isset($icon['icon']) &&  $icon['icon'] != '')) {
	$bgcolorh = isset($icon['bgcolorh']) ? $icon['bgcolorh'] : '';
		if ($bgcolorh != '') {
		    $bgcolorh = 'data-bghover="'.$bgcolorh.'"';
		}
	echo '<li '.$bgcolorh.'>';
	    
	    if ($icon['image'] == '' && $icon['icon'] != '') {
		echo '<a class="vector_icon" rel="'.$icon['icon'].'" href="'.$icon['url'].'"><i class="'.$icon['icon'].'"></i></a>';
	    } else {
		echo '<a class="vector_icon" href="'.$icon['url'].'"><img src="'.$icon['image'].'" alt=""></i></a>';
	    }

	echo '</li>';
	}
    }
    }
} ?>