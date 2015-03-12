<?php 
function mom_blog_post($style = 1) {
    global $post;
    
	if ($style == 'large') { 
	    get_template_part( 'framework/includes/blog-big' );
	} else { 
	    get_template_part( 'framework/includes/blog' );
	} 
	
	
}

function mom_blog_single ($style) { global $post;
    if ($style == 'large') { 
	    get_template_part( 'framework/includes/blog-big' );
	} else { 
	    get_template_part( 'framework/includes/blog' );
	} 
	wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'framework' ), 'after' => '</div>' ) ); 

} ?>