<?php get_header(); ?>
<?php
    global $post;
    echo do_shortcode('[ad id="'.$post->ID.'"]');
    echo do_shortcode('[gap height="10"]');
?>
<?php get_footer(); ?>