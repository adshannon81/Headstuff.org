<?php 

add_action('widgets_init','mom_recent_comments');

function mom_recent_comments() {
	register_widget('mom_recent_comments');
	}

class mom_recent_comments extends WP_Widget {
	function mom_recent_comments() {
			
		$widget_ops = array('classname' => 'mom_comments','description' => __('Widget display Recent Comments with avatar','framework'));
/*		$control_ops = array( 'twitter name' => 'momizat', 'count' => 3, 'avatar_size' => '32' );
*/		
		$this->WP_Widget('mom_comments',__('Momizat - Recent Comments','framework'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
	$title = apply_filters('widget_title', $instance['title'] );
	$count = $instance['count'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

?>
<ul class="latest-comment-list">
	<?php
	global $wpdb;

	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,45) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $count";
	$comments = $wpdb->get_results($sql);
	foreach ($comments as $comment) :
	?>
    <li>
        <figure><a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>"><?php echo get_avatar( $comment, '70' ); ?></a></figure>
        <cite><a href="<?php echo $comment->comment_author_url; ?>"><?php echo strip_tags($comment->comment_author); ?></a></cite>
        <time><?php _e('on', 'framework');?> <?php echo strip_tags($comment->comment_date_gmt); ?></time>
        <span><?php _e('in :' , 'framework'); ?> <a href="<?php echo get_permalink($comment->ID); ?>" rel="bookmark"><?php 
			$excerpt = $comment->post_title;
			echo wp_html_excerpt($excerpt,25);
            ?> ...</a></span>
        <div class="comment-body">
            <p><?php 
			$excerpt = $comment->com_excerpt;
			echo wp_html_excerpt($excerpt,145);
            ?> ...</p>
        </div>
    </li>
    <?php endforeach; ?>            
    <?php wp_reset_query(); ?>
</ul>

<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['count'] = $new_instance['count'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'title' => __('Comments', 'framework'),
			'count' => '5'
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
    	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('title:', 'framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of comments', 'framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" class="widefat" />
		</p>


   <?php 
}
	} //end class