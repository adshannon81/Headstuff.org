<?php

function mom_blog_sc($atts, $content) {
	extract(shortcode_atts(array(
	'style' => '',
	'display' => '',
	'category' => '',
	'tag' => '',
	'posts_per_page' => 9,
	'offset' => '',
	'excerpt' => '',
	'pagination' => ''
	), $atts));
	
	ob_start();

	?>
	    <div class="blog_posts">
		<?php
		global $paged;
		if ($display == 'category') {
			$args = array(
			'posts_per_page' => $posts_per_page,
			'paged' => $paged ,
			'cat' => $category,
			'offset' => $offset,
			'cache_results' => false
		); 
		} elseif ($display == 'tag') {
			$args = array(
			'posts_per_page' => $posts_per_page,
			'paged' => $paged ,
			'tag' => $tag,
			'offset' => $offset,
			'cache_results' => false
		); 
		} else {
			$args = array(
				'posts_per_page' => $posts_per_page,
				'paged' => $paged ,
				'offset' => $offset,
				'cache_results' => false
			); 
		}

		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
			<?php mom_blog_post($style); ?>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.', 'framework'); ?></p>
		<?php endif; ?>
		<?php if($pagination != 'no') { ?>
		<?php mom_pagination($query->max_num_pages); ?>
		<?php } ?>
		<?php wp_reset_query(); ?>

      </div> <!-- blog posts -->
<?php

	$content = ob_get_contents();
	ob_end_clean();
	return $content;

	
	}

add_shortcode('blog', 'mom_blog_sc');

function mom_blog_list_sc($atts, $content) {
	extract(shortcode_atts(array(
	'style' => '',
	'display' => '',
	'category' => '',
	'tag' => '',
	'offset' => '',
	'excerpt' => '',
	'posts_per_page' => 2,
	), $atts));
	
	ob_start();
	?>
	      <div class="blog_posts_list">
		<?php
		global $paged;
		if ($display == 'category') {
			$args = array(
			'posts_per_page' => $posts_per_page,
			'paged' => $paged ,
			'cat' => $category,
			'offset' => $offset,
			'cache_results' => false
		); 
		} elseif ($display == 'tag') {
			$args = array(
			'posts_per_page' => $posts_per_page,
			'paged' => $paged ,
			'tag' => $tag,
			'offset' => $offset,
			'cache_results' => false
		); 
		} else {
			$args = array(
				'posts_per_page' => $posts_per_page,
				'paged' => $paged ,
				'offset' => $offset,
				'cache_results' => false
			); 
		}

		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
			<?php mom_blog_single($style); ?>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.', 'framework'); ?></p>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
	
	      </div> <!-- blog posts -->
	<?php

	$content = ob_get_contents();
	ob_end_clean();
	return $content;

	
	}

add_shortcode('blog_list', 'mom_blog_list_sc');

?>