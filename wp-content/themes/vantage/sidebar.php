<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package vantage
 * @since vantage 1.0
 * @license GPL 2.0
 */
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php do_action( 'before_sidebar' ); ?>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>

<div>

<!--
<?php
    $args=array(
      'category_name' => $post->post_name,
      'showposts'=>5,
      'caller_get_posts'=>5
    );
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
      echo '5 recent category Posts ';
      while ($my_query->have_posts()) : $my_query->the_post(); ?>
        <p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
       <?php
      endwhile;
    } //if ($my_query)
  wp_reset_query();  // Restore global post data stomped by the_post().
?>
-->
</div>



	<?php do_action( 'after_sidebar' ); ?>
</div><!-- #secondary .widget-area -->

