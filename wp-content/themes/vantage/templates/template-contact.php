<?php
/**
 * This template displays contact pages
 
 * @package vantage
 * @since vantage 1.0
 * @license GPL 2.0
 * 
 * Template Name: Contact Page
 */

get_header(); ?>

<div id="primary-contact" class="content-area">
	<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="entry-main">

					<?php do_action('vantage_entry_main_top') ?>

					<div class="entry-content">
						<h1 id="entry-title-contact">Contact</h1>
						<div style="min-width:400px; width:50%; float:left; padding-right:50px;">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'vantage' ) ); ?>
						</div>
						<div style="min-width:400px; width:40%; float:left; padding-right:50px;">
							<table >
								<tbody>
									<tr>
										<td>
											<h3>HeadStuff Collaborators:</h3>
										</td>
										<td>
											<h3>HeadStuff Contacts:</h3>
										</td>
									</tr>
									
									<?php
									
										//$table = '';
										$blogusers = get_users('orderby=post_count&order=DESC');
										
										foreach($blogusers as $user) {
											$userMeta = get_userdata($user->ID);
											
											//$nickname = the_author_meta('nickname', $user->ID);
											//$twitter = the_author_meta('twitter', $user->ID);
											/*$contact = '';
											if(empty($twitter)){
												$webaddress = the_author_meta('user_url', $user->ID);
												if($webaddress != ''){
													$contact = '<a href="'.$webaddress.'" target="_blank">'.$webaddress.'</a>';
												}
											}
											else{
												$contact = '<a href="http://twitter.com/'.$twitter.'" target="_blank">'.$twitter.'</a>';
											}
											echo '<tr><td>'.$nickname.'</td><td>'.$contact.'</td></tr>';
											//$table = $table. '<tr><td>'.$nickname.'</td><td>'.$contact.'</td></tr>';
											//echo '<tr><td>'.$userMeta->nickname.'</td><td>'.$userMeta->twitter.'</td></tr>';
											*/
											
											$contact = '';
											if($userMeta->twitter =='' ){
												if( $userMeta->user_url != '' ){
													$contact = '<a href="'.$userMeta->user_url.'" target="_blank">'.$userMeta->user_url.'</a>';
												}
											}
											else{
												$contact = '<a href="http://twitter.com/'.$userMeta->twitter.'" target="_blank">@'.$userMeta->twitter.'</a>';
											}
											echo '<tr><td>'.$userMeta->nickname.'</td><td>'.$contact.'</td></tr>';
										}
										//echo $table;
										
									?>
									
								</tbody>
							</table>
						</div>

						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'vantage' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

					<?php do_action('vantage_entry_main_bottom') ?>

				</div>

			</article><!-- #post-<?php the_ID(); ?> -->

		<?php endwhile; // end of the loop. ?>

	</div><!-- #content .site-content -->
</d