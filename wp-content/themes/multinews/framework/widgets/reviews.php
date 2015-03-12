<?php 

add_action('widgets_init','mom_widget_reviews');

function mom_widget_reviews() {
	register_widget('mom_widget_reviews');
	
	}

class mom_widget_reviews extends WP_Widget {
	function mom_widget_reviews() {
			
		$widget_ops = array('classname' => 'review-widget','description' => __('Widget display Posts order by : Top , Random, Recent','framework'));
		$this->WP_Widget('momizatReviews',__('Momizat - Reviews','framework'),$widget_ops);

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
?>
		<ul class="post-list">

		<?php
			if ($orderby == 'top') {
				if ($display == 'cats') {
					$catsi = implode(',', $cats);
					$query = new WP_Query( array ( 'orderby' => 'meta_value', 'meta_key' => '_mom_review-final-score','meta_value' => 0, 'meta_compare' => '!=', "ignore_sticky_posts" => 1, 'showposts' => $count, 'cat' => $catsi, 'no_found_rows' => true, 'cache_results' => false ) );
				} else {
					$query = new WP_Query( array ( 'orderby' => 'meta_value', 'meta_key' => '_mom_review-final-score', 'meta_value' => 0, 'meta_compare' => '!=', "ignore_sticky_posts" => 1, 'showposts' => $count, 'no_found_rows' => true, 'cache_results' => false ) );
				}
			} elseif ($orderby == 'random') {
				if ($display == 'cats') {
					$catsi = implode(',', $cats);
					$query = new WP_Query( array ( 'meta_key' => '_mom_review-final-score', "orderby" => "rand",'meta_value' => 0, 'meta_compare' => '!=', "ignore_sticky_posts" => 1, 'showposts' => $count, 'cat' => $catsi, 'no_found_rows' => true, 'cache_results' => false ) );
				} else {
					$query = new WP_Query( array ( 'meta_key' => '_mom_review-final-score', "orderby" => "rand", 'meta_value' => 0, 'meta_compare' => '!=', "ignore_sticky_posts" => 1, 'showposts' => $count, 'no_found_rows' => true, 'cache_results' => false ) );
				}
			} else {
				if ($display == 'cats') {
					$catsi = implode(',', $cats);
					$query = new WP_Query( array ( 'meta_key' => '_mom_review-final-score', 'meta_value' => 0, 'meta_compare' => '!=', "ignore_sticky_posts" => 1, 'showposts' => $count, 'cat' => $catsi, 'no_found_rows' => true, 'cache_results' => false ) );
				} else {
					$query = new WP_Query( array ( 'meta_key' => '_mom_review-final-score', 'meta_value' => 0, 'meta_compare' => '!=', "ignore_sticky_posts" => 1, 'showposts' => $count, 'no_found_rows' => true, 'cache_results' => false ));
				}
			}
			if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
 			$score = get_post_meta(get_the_ID(),'_mom_review-final-score',true);
		?>
			<li itemscope="" itemtype="http://schema.org/Review">
				<?php if( mom_post_image() != false ) { ?>
				<figure class="post-thumbnail"><a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark">
				<img itemprop="image" src="<?php echo mom_post_image('postlist-thumb'); ?>" data-hidpi="<?php echo mom_post_image('media1-thumb'); ?>" alt="<?php the_title(); ?>">
				</a></figure>
				<?php } ?>
				<h2 itemprop="name"><a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="entry-review">
                    <?php
				$stars_score = number_format(($score/20), 1, '.', ',');
    				$summary = get_post_meta(get_the_ID(),'_mom_review_summary',true);
			?>
				<span class="rev-title"><?php _e('Review :', 'framework'); ?></span>
				<div class="star-rating mom_review_score"><span style="width:<?php echo $score; ?>%;"></span></div>
				<small>(<?php echo $stars_score; ?>)</small>
                </div>
                <meta itemprop="datePublished" content="<?php the_time('Y-m-d'); ?>"> <!--date and time-->
                <span class="hidden" itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating">
                    <meta itemprop="worstRating" content="1"><!--rate-->
                    <meta itemprop="bestRating" content="5"><!--rate-->
                    <meta itemprop="ratingValue" content="<?php echo $stars_score; ?>"><!--rate-->
                </span>
			</li>
			<?php endwhile; ?>
			<?php  else:  ?>
			<!-- Else in here -->
			<?php  endif; ?>
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
		$instance['orderby'] = $new_instance['orderby'];
		$instance['display'] = $new_instance['display'];
		$instance['cats'] = $new_instance['cats'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Top Reviews','framework'), 
			'count' => 5
 			);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$orderby = isset($instance['orderby']) ? $instance['orderby'] : '';
		$display = isset($instance['display']) ? $instance['display'] : '';
		$cats = isset($instance['cats']) ? $instance['cats'] : array();
		$categories = get_categories('hide_empty=0');
	
		?>
	<script>
		jQuery(document).ready(function($) {
			$('#<?php echo $this->get_field_id( 'display' ); ?>').change( function () {
				if ($(this).val() === 'cats') {
					$('#<?php echo $this->get_field_id('cats'); ?>').parent().fadeIn();
				} else {
					$('#<?php echo $this->get_field_id('cats'); ?>').parent().fadeOut();
				}
				
			});
				if ($('#<?php echo $this->get_field_id( 'display' ); ?>').val() === 'cats') {
					$('#<?php echo $this->get_field_id('cats'); ?>').parent().fadeIn();
				} else {
					$('#<?php echo $this->get_field_id('cats'); ?>').parent().fadeOut();
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
		<option value="top" <?php selected($orderby, 'top'); ?>><?php _e('Top Reviews', 'framework'); ?></option>
		<option value="recent" <?php selected($orderby, 'recent'); ?>><?php _e('Recent Reviews', 'framework'); ?></option>
		<option value="random" <?php selected($orderby, 'random'); ?>><?php _e('Random Reviews', 'framework'); ?></option>
		</select>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e('display', 'framework') ?></label>
		<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" class="widefat">
		<option value="latest" <?php selected($display, 'latest'); ?>><?php _e('Latest Reviews', 'framework'); ?></option>
		<option value="cats" <?php selected($display, 'cats'); ?>><?php _e('Category/s', 'framework'); ?></option>
		</select>
		</p>

		<p class="posts_widget_cats hidden">
		<label for="<?php echo $this->get_field_id( 'cats' ); ?>"><?php _e('Categories', 'framework') ?></label>
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