<?php
function mom_posts_share($url, $style=null) {
    $url = urlencode($url);
    $desc = wp_html_excerpt(strip_shortcodes(get_the_content()), 160);
    $img = urlencode(mom_post_image('large'));
    $title = get_the_title();
    $window_title = __('Share This', 'framework');
    $window_width = 600;
    $window_height = 455;
?>
<script>
    jQuery(document).ready(function($) {
        var url = '<?php echo $url; ?>'; 
        // twitter
        jQuery.getJSON(
            'ht'+'tp://urls.api.twitter.com/1/urls/count.json?url='+url+'&callback=?',
            function (data) {
		    //console.log(data.count);
		    $('.share-twitter .count').text(data.count);
                }
        );

        // facebook
        jQuery.getJSON(
            'ht'+'tp://api.facebook.com/method/links.getStats?urls='+url+'&format=json',
            function (data) {
                //console.log(data[0].like_count);
                $('.share-facebook .count').text(data[0].like_count);
            }
        );

        // linkedin
        jQuery.getJSON(
	    'http://www.linkedin.com/countserv/count/share?format=jsonp&url='+url+'&callback=?',
            function (data) {

                //console.log(data.count);
                $('.share-linkedin .count').text(data.count);
            }
        );

        // Pintrest
        jQuery.getJSON(
	    'http://api.pinterest.com/v1/urls/count.json?url='+url+'&callback=?',
            function (data) {
                //console.log(data.count);
                $('.share-pin .count').text(data.count);
            }
        );	
    });
    

</script>
<?php
	$plusone = 0;
	$plusone = mom_getGoogleCount($url);
?>	
		<div class="mom-share-post">
		        <h4><?php _e( 'share', 'framework' ) ?></h4>
		        <div class="mom-share-buttons">
		            	<?php if(mom_option('sharee_fb') != 0) { ?>
		                <a href="#" onclick="window.open('http://www.facebook.com/sharer.php?s=100&p[url]=<?php echo $url; ?>&p[title]=<?php print(urlencode(the_title())); ?>&p[summary]=<?php print(urlencode(wp_html_excerpt(get_the_content(), 160))); ?>&p[images[0]=<?php echo $img; ?>', 'Share this', 'width=<?php echo $window_width; ?>,height=<?php echo $window_height; ?>');" class="share-facebook"><i class="enotype-icon-facebook"></i><span class="count">0</span></a>
		                <?php } ?>
		                <?php if(mom_option('sharee_tw') != 0) { ?>
		                <a href="#" onclick="window.open('http://twitter.com/home?status=<?php print(urlencode(the_title())); ?>+<?php echo $url; ?>', 'Post this On twitter', 'width=<?php echo $window_width; ?>,height=<?php echo $window_height; ?>');" class="share-twitter"><i class="momizat-icon-twitter"></i><span class="count">0</span></a>
		                <?php } ?>
		                <?php if(mom_option('sharee_go') != 0) { ?>
		                <a href="#" onclick="window.open('https://plus.google.com/share?url=<?php echo $url; ?>', 'Share', 'width=<?php echo $window_width; ?>,height=<?php echo $window_height; ?>');" class="share-google"><i class="momizat-icon-google-plus"></i><span class="count"><?php echo $plusone; ?></span></a>
		                <?php } ?>
		                <?php if(mom_option('sharee_lin') != 0) { ?>
		                <a href="#" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php print(urlencode(the_title())); ?>&source=<?php echo home_url(); ?>', 'Share This', 'width=<?php echo $window_width; ?>,height=<?php echo $window_height; ?>');" class="share-linkedin"><i class="fa-icon-linkedin"></i><span class="count">0</span></a>
		                <?php } ?>
		                <?php if(mom_option('sharee_pin') != 0) { ?>
		                <a href="#" onclick="window.open('http://pinterest.com/pin/create/bookmarklet/?media=<?php echo mom_post_image('medium'); ?>&url=<?php echo esc_url($url); ?>&is_video=false&description=<?php print(urlencode(the_title())); ?>', 'Share this', 'width=<?php echo $window_width; ?>,height=<?php echo $window_height; ?>');" class="share-pin"><i class="enotype-icon-pinterest"></i><span class="count">0</span></a>
		                <?php } ?>
		                <?php if(mom_option('sharee_mail') != 0) { ?>
		                <a href="mailto:?subject=<?php print(urlencode(the_title())); ?>&amp;body=<?php print(urlencode(wp_html_excerpt(get_the_content(), 160))); ?> Read More : <?php echo $url; ?>" class="share-email"><i class="dashicons dashicons-email-alt"></i></a>
		                <?php } ?>		                
		        </div>
		        <!--
<a href="#" class="sh_arrow"><span><?php _e( 'More', 'framework' ) ?></span><br>
		            <i class="icon-double-angle-down"></i>
		        </a>
-->
		</div>
<?php
}
function mom_getGoogleCount($url) {
    $googleURL = wp_remote_get('https://plusone.google.com/_/+1/fastbutton?url=' .  $url );
    if (!is_wp_error($googleURL)) {
    preg_match('/window\.__SSR = {c: ([\d]+)/', $googleURL['body'], $results);
    if( isset($results[0]))
        return (int) str_replace('window.__SSR = {c: ', '', $results[0]);
    return "0";
    } else {
	return '0';
    }
}