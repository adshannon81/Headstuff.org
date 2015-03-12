<?php 

add_action('widgets_init','mom_widget_posts');

function mom_widget_posts() {
	register_widget('mom_widget_posts');
	
	}

class mom_widget_posts extends WP_Widget {
	function mom_widget_posts() {
			
		$widget_ops = array('classname' => 'posts','description' => __('Widget display Posts order by : Popular, Random, Recent','framework'));
		$this->WP_Widget('momizat-posts',__('Momizat - Posts','framework'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$orderby = $instance['orderby'];
		$count = $instance['count'];
		$display = $instance['display'];
		$cats = isset($instance['cats']) ? $instance['cats'] : array();

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			
			$dateformat = mom_option('date_format');
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

		<ul class="post-list">
			<?php if($orderby == 'Popular') { ?>
				<?php if ($display == 'cats') {
				$catsi = implode(',', $cats);
				?>
	
				<?php $query = new WP_Query( array( 'cat' => $catsi, 'ignore_sticky_posts' => 1, 'posts_per_page' => $count, 'orderby' => 'comment_count', 'no_found_rows' => true, 'cache_results' => false ) ); ?>
				<?php } else { ?>
				<?php $query = new WP_Query( array( 'ignore_sticky_posts' => 1, 'posts_per_page' => $count, 'orderby' => 'comment_count', 'no_found_rows' => true, 'cache_results' => false ) ); ?>
				<?php } ?>
			<?php } elseif($orderby == 'Random') { ?>
				<?php if ($display == 'cats') {
				$catsi = implode(',', $cats);
				
				?>
				<?php $query = new WP_Query( array( 'cat' => $catsi, 'ignore_sticky_posts' => 1, 'posts_per_page' => $count, 'orderby' => 'rand', 'no_found_rows' => true, 'cache_results' => false ) ); ?>
				<?php } else { ?>
				<?php $query = new WP_Query( array( 'ignore_sticky_posts' => 1, 'posts_per_page' => $count, 'orderby' => 'comment_count', 'no_found_rows' => true, 'cache_results' => false ) ); ?>
				<?php } ?>
			<?php } elseif($orderby == 'Recent') { ?>
				<?php if ($display == 'cats') {
				$catsi = implode(',', $cats);
				?>
				<?php $query = new WP_Query( array( 'cat' => $catsi, 'ignore_sticky_posts' => 1, 'posts_per_page' => $count, 'no_found_rows' => true, 'cache_results' => false ) ); ?>
				<?php } else { ?>
				<?php $query = new WP_Query( array( 'ignore_sticky_posts' => 1, 'posts_per_page' => $count, 'no_found_rows' => true, 'cache_results' => false ) ); ?>
				<?php } ?>
			<?php } ?>
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

			<li itemscope="" itemtype="http://schema.org/Article">
				<?php if( mom_post_image() != false ) { ?>
				<figure class="post-thumbnail"><a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark">
				<img itemprop="image" src="<?php echo mom_post_image('postlist-thumb'); ?>" data-hidpi="<?php echo mom_post_image('media1-thumb'); ?>" alt="<?php the_title(); ?>">
				</a></figure>
				<?php } ?>
				<h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php if($post_head != 0) { ?>
				<div class="entry-meta">
					<?php if($post_head_date != 0) { ?>
				    <time class="entry-date" datetime="<?php the_time('c'); ?>" itemprop="dateCreated"><i class="momizat-icon-calendar"></i><?php the_time($dateformat); ?></time>
				    <?php } ?>
				    <?php if($post_head_commetns != 0) { ?>
				    <div class="comments-link">
					<i class="momizat-icon-bubbles4"></i><a href="<?php the_permalink(); ?>"><?php comments_number(__( '(0) Comments', 'framework' ), __( '(1) Comment', 'framework' ),__( '(%) Comments', 'framework' )); ?></a>
				    </div>
				    <?php } ?>
				</div>
				<?php } ?>
				<a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more...', 'framework'); ?></a>
			</li>

			<?php endwhile; ?>
			<?php  else:  ?>
			<!-- Else in here -->
			<?php  endif; ?>
			<?php wp_reset_postdata(); ?>
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
		$instance['orderby'] = $new_instance['orderby'];
		$instance['display'] = $new_instance['display'];
		$instance['cats'] = $new_instance['cats'];


		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Most Popular','framework'), 
			'count' => 3,
 			);
		$instance = wp_parse_args( (array) $instance, $defaults );
		if (isset($instance['orderby'])) { $orderbyS = $instance['orderby'];} else {$orderbyS = ''; }
		if (isset($instance['display'])) { $displayS = $instance['display'];} else {$displayS = ''; }
		$cats = isset($instance['cats']) ? $instance['cats'] : array();
		$categories = get_categories('hide_empty=0');
	?>
	<script>
		jQuery(document).ready(function($) {
			$('#<?php echo $this->get_field_id( 'display' ); ?>').change( function () {
				if ($(this).val() !== 'latest') {
					$('#<?php echo $this->get_field_id('cats'); ?>').parent().fadeIn();
				}
				
			});
				if ($('#<?php echo $this->get_field_id( 'display' ); ?>').val() !== 'latest') {
					$('#<?php echo $this->get_field_id('cats'); ?>').parent().fadeIn();
				}
		});
	</script>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e('orderby', 'framework') ?></label>
		<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
		<option <?php if ( 'Popular' == $orderbyS ) echo 'selected="selected"'; ?>>Popular</option>
		<option <?php if ( 'Random' == $orderbyS ) echo 'selected="selected"'; ?>>Random</option>
		<option <?php if ( 'Recent' == $orderbyS ) echo 'selected="selected"'; ?>>Recent</option>
		</select>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e('display', 'framework') ?></label>
		<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" class="widefat">
		<option <?php if ( 'latest' == $displayS ) echo 'selected="selected"'; ?> value="latest"><?php _e('Latest Posts', 'framework'); ?></option>
		<option <?php if ( 'cats' == $displayS ) echo 'selected="selected"'; ?> value="cats"><?php _e('Category/s', 'framework'); ?></option>
		</select>
		</p>

		<p class="hidden">
		<label for="<?php echo $this->get_field_id( 'cats' ); ?>"><?php _e('cats', 'framework') ?></label>
		<select id="<?php echo $this->get_field_id( 'cats' ); ?>" name="<?php echo $this->get_field_name( 'cats' ); ?>[]" class="widefat" multiple="multiple">
		<?php foreach ($categories as $cat) { ?>
			<option <?php echo in_array($cat->cat_ID, $cats)? 'selected="selected"':'';?> value="<?php echo $cat->cat_ID; ?>"><?php echo $cat->cat_name; ?></option>
		<?php } ?>
		</select>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number Of Posts:','framework'); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" class="widefat" />
		</p>
   <?php 
}
	} //end class