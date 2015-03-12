<?php 

add_action('widgets_init','mom_social_counter');

function mom_social_counter() {
	register_widget('mom_social_counter');
	}

class mom_social_counter extends WP_Widget {
	function mom_social_counter() {
			
		$widget_ops = array('classname' => 'momizat-social_counter','description' => __('Widget display a count of your social networks followers/fans numbers','framework'));
/*		$control_ops = array( 'twitter name' => 'momizat', 'count' => 3, 'avatar_size' => '32' );
*/		
		$this->WP_Widget('momizatSocialCounter',__('Momizat - Social Counter','framework'),$widget_ops);

		}
	
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
	$title = apply_filters('widget_title', $instance['title'] );
	$rss_text = $instance['rss_text'];
	$rss_link = $instance['rss_link'];
	$twitter = $instance['twitter'];
	$facebook = $instance['facebook'];
	$googlep = $instance['googlep'];
	$dribbble = $instance['dribbble'];
	$youtube = $instance['youtube'];
	$vimeo = $instance['vimeo'];
	$soundcloud = $instance['soundcloud'];
	$instagram = $instance['instagram'];
	$behance = $instance['behance'];
	$delicious = $instance['delicious'];
	$pinterest = $instance['pinterest'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

if ($rss_link == '') {
	$rss_link = get_bloginfo('rss2_url');
}

?>
						<ul class="social-counter">
                            <?php if ($twitter != '') { ?>
                            <li class="sc-twitter">
                                <div class="sc-header">
                                    <a href="http://twitter.com/<?php echo $twitter; ?>" target="_blank">
                                    	<i class="momizat-icon-twitter"></i>
										<small><?php _e('Followers', 'framework'); ?></small>
									</a>
                                </div>
                                <div class="sc-footer">
                                    <span><?php echo mom_sc_twitter($twitter); ?></span>
                                </div>
                            </li>
                            <?php } ?>
                            
                            <?php if ($facebook != '') { ?>
                            <li class="sc-facebook">
                                <div class="sc-header">
                                    <a href="<?php echo mom_sc_facebook($facebook, 'link'); ?>" target="_blank">
                                    	<i class="enotype-icon-facebook"></i>
										<small><?php _e('Fans', 'framework'); ?></small>
									</a>
                                </div>
                                <div class="sc-footer">
                                    <span><?php echo mom_sc_facebook($facebook); ?></span>
                                </div>
                            </li>
                            <?php } ?>
                            
                            <?php if ($rss_text != '') { ?>
                            <li class="sc-rss">
                                <div class="sc-header">
                                    <a href="<?php echo $rss_link; ?>" target="_blank">
                                    	<i class="enotype-icon-rss"></i>
										<small><?php _e('Subscribers', 'framework'); ?></small>
									</a>
                                </div>
                                <div class="sc-footer">
                                    <span><?php echo $rss_text; ?></span>
                                </div>
                            </li>
                            <?php } ?>
                                
                            <?php if ($googlep != '') { ?>
                            <li class="sc-google">
                                <div class="sc-header">
                                    <a href="<?php echo mom_sc_googleplus($googlep, 'link'); ?>" target="_blank">
                                    	<i class="momizat-icon-google-plus"></i>
										<small><?php _e('Subscribers', 'framework'); ?></small>
									</a>
                                </div>
                                <div class="sc-footer">
                                    <span><?php echo mom_sc_googleplus($googlep); ?></span>
                                </div>
                            </li>
                            <?php } ?>
                                
                            <?php if ($youtube != '') { ?>
                            <li class="sc-youtube">
                                <div class="sc-header">
                                    <a href="<?php echo mom_sc_youtube($youtube, 'link'); ?>" target="_blank">
                                    	<i class="fa-icon-youtube"></i>
										<small><?php _e('Subscribers', 'framework'); ?></small>
									</a>
                                </div>
                                <div class="sc-footer">
                                    <span><?php echo mom_sc_youtube($youtube); ?></span>
                                </div>
                            </li>
                            <?php } ?>
                                                 
                            <?php if ($vimeo != '') { ?>
                            <li class="sc-vimeo">
                                <div class="sc-header">
                                    <a href="<?php echo mom_sc_vimeo($vimeo, 'link'); ?>" target="_blank">
                                    	<i class="momizat-icon-vimeo"></i>
										<small><?php _e('Fans', 'framework'); ?></small>
									</a>
                                </div>
                                <div class="sc-footer">
                                    <span><?php echo mom_sc_vimeo($vimeo); ?></span>
                                </div>
                            </li>
                            <?php } ?>
                             
                            <?php if ($dribbble != '') { ?>
                            <li class="sc-dribble">
                                <div class="sc-header">
                                    <a href="<?php echo mom_sc_dribbble($dribbble, 'link'); ?>" target="_blank">
                                    	<i class="momizat-icon-dribbble3"></i>
										<small><?php _e('Followers', 'framework'); ?></small>
									</a>
                                </div>
                                <div class="sc-footer">
                                    <span><?php echo mom_sc_dribbble($dribbble); ?></span>
                                </div>
                            </li>
                            <?php } ?>
                            
                            <?php if ($soundcloud != '') { ?>
                            <li class="sc-soundcloude">
                                <div class="sc-header">
                                    <a href="<?php echo mom_sc_soundcloud($soundcloud, 'link'); ?>" target="_blank">
                                    	<i class="momizat-icon-soundcloud"></i>
										<small><?php _e('Followers', 'framework'); ?></small>
									</a>
                                </div>
                                <div class="sc-footer">
                                    <span><?php echo mom_sc_soundcloud($soundcloud); ?></span>
                                </div>
                            </li>
                            <?php } ?>
                            
                            <?php if ($instagram != '') { ?>
                            <li class="sc-instgram">
                                <div class="sc-header">
                                    <a href="<?php echo mom_sc_instagram($instagram, 'link'); ?>" target="_blank">
                                    	<i class="momizat-icon-instagram"></i>
										<small><?php _e('Followers', 'framework'); ?></small>
									</a>
                                </div>
                                <div class="sc-footer">
                                    <span><?php echo mom_sc_instagram($instagram); ?></span>
                                </div>
                            </li>
                            <?php } ?>
                            
                            <?php if ($behance != '') { ?>
                            <li class="sc-behance">
                                <div class="sc-header">
                                    <a href="<?php echo mom_sc_behance($behance, 'link'); ?>" target="_blank">
                                    	<i class="enotype-icon-behance"></i>
										<small><?php _e('Followers', 'framework'); ?></small>
									</a>
                                </div>
                                <div class="sc-footer">
                                    <span><?php echo mom_sc_behance($behance); ?></span>
                                </div>
                            </li>
                            <?php } ?>
                            
                            <?php if ($pinterest != '') { ?>
                            <li class="sc-pin">
                                <div class="sc-header">
                                    <a href="<?php echo $pinterest; ?>" target="_blank">
                                    	<i class="enotype-icon-pinterest"></i>
										<small><?php _e('Followers', 'framework'); ?></small>
									</a>
                                </div>
                                <div class="sc-footer">
                                    <span><?php echo mom_sc_pinterest($pinterest); ?></span>
                                </div>
                            </li>
                            <?php } ?>
							
                            <?php if ($delicious != '') { ?>
                            <li class="sc-delicious">
                                <div class="sc-header">
                                    <a href="<?php echo mom_sc_delicious($delicious, 'link'); ?>" target="_blank">
                                    	<i class="momizat-icon-delicious"></i>
										<small><?php _e('Followers', 'framework'); ?></small>
									</a>
                                </div>
                                <div class="sc-footer">
                                    <span><?php echo mom_sc_delicious($delicious); ?></span>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['rss_text'] = $new_instance['rss_text'];
			$instance['rss_link'] = $new_instance['rss_link'];
			$instance['twitter'] = $new_instance['twitter'];
			$instance['facebook'] = $new_instance['facebook'];
			$instance['googlep'] = $new_instance['googlep'];
			$instance['dribbble'] = $new_instance['dribbble'];
			$instance['youtube'] = $new_instance['youtube'];
			$instance['vimeo'] = $new_instance['vimeo'];
			$instance['soundcloud'] = $new_instance['soundcloud'];
			$instance['instagram'] = $new_instance['instagram'];
			$instance['behance'] = $new_instance['behance'];
			$instance['delicious'] = $new_instance['delicious'];
			$instance['pinterest'] = $new_instance['pinterest'];
			delete_transient('mom_twitter_followers');
			delete_transient('mom_facebook_followers');
			delete_transient('mom_facebook_page_url');
			delete_transient('mom_googleplus_followers');
			delete_transient('mom_googleplus_page_url');
			delete_transient('mom_dribbble_followers');
			delete_transient('mom_dribbble_page_url');
			 delete_transient('mom_youtube_followers');
			delete_transient('mom_youtube_page_url');
			delete_transient('mom_vimeo_followers');
			delete_transient('mom_vimeo_page_url');
			delete_transient('mom_soundcloud_followers');
			delete_transient('mom_soundcloud_page_url');
			delete_transient('mom_behance_followers');
			delete_transient('mom_behance_page_url');
			delete_transient('mom_instagram_followers');
			delete_transient('mom_instagram_page_url');
			delete_transient('mom_delicious_followers');
			delete_transient('mom_delicious_page_url');
			delete_transient('mom_pinterest_followers');
		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('Socials Counter', 'framework'),
			'rss_text' => '1000+',
			'rss_link' => '',
			'twitter' => 'momizat',
			'facebook' => '161633160519240',
			'googlep' => '',
			'dribbble' => '',
			'youtube' => '',
			'vimeo' => '',
			'soundcloud' => '',
			'instagram' => '',
			'behance' => '',
			'delicious' => '',
			'pinterest' => '',
 			);
		$instance = wp_parse_args( (array) $instance, $defaults );
                
                
                
                ?>
	<div class="mom_meta_note">
		<p><?php _e("Before add this widget you must make sure you fill all required data in theme options -> <a target='_blank' href='".admin_url('themes.php?page=theme_options')."'>API's Authentication</a>", "theme"); ?> </p>
	</div>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('title:', 'framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'rss_text' ); ?>"><?php _e('rss number or text', 'framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'rss_text' ); ?>" name="<?php echo $this->get_field_name( 'rss_text' ); ?>" value="<?php echo $instance['rss_text']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'rss_link' ); ?>"><?php _e('RSS Link (leave empty to use default rss link)', 'framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'rss_link' ); ?>" name="<?php echo $this->get_field_name( 'rss_link' ); ?>" value="<?php echo $instance['rss_link']; ?>" class="widefat" />
		</p>


		<p>
		<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter Name', 'framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('facebook page ID (<a target="_blank" href="http://hellboundbloggers.com/2010/07/10/find-facebook-profile-and-page-id/">more Info</a>)', 'framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'googlep' ); ?>"><?php _e('google+ ID', 'framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'googlep' ); ?>" name="<?php echo $this->get_field_name( 'googlep' ); ?>" value="<?php echo $instance['googlep']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'dribbble' ); ?>"><?php _e('dribbble username', 'framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" value="<?php echo $instance['dribbble']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e('Youtub channel name', 'framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e('Vimeo channel name', 'framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo $instance['vimeo']; ?>" class="widefat" />
		</p>


		<p>
		<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e('pinterest full URL (Beta)', 'framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo $instance['pinterest']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e('Instagram', 'framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo $instance['instagram']; ?>" class="widefat" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'soundcloud' ); ?>"><?php _e('Soundcloud name', 'framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'soundcloud' ); ?>" name="<?php echo $this->get_field_name( 'soundcloud' ); ?>" value="<?php echo $instance['soundcloud']; ?>" class="widefat" />
		</p>


		<p>
		<label for="<?php echo $this->get_field_id( 'behance' ); ?>"><?php _e('Behance username', 'framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'behance' ); ?>" name="<?php echo $this->get_field_name( 'behance' ); ?>" value="<?php echo $instance['behance']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'delicious' ); ?>"><?php _e('Delicious username', 'framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'delicious' ); ?>" name="<?php echo $this->get_field_name( 'delicious' ); ?>" value="<?php echo $instance['delicious']; ?>" class="widefat" />
		</p>
		<p><a href="#" class="button delete-sc-cache"><?php _e('Delete cache', 'framework'); ?></a><span></span><br><small><?php _e('Your socials numbers is saved in the cache each hour if you want delete the cache now click on this button', 'framework'); ?></small></p>

   <?php 
}
	} //end class