<?php
/**
 * Part Name: Default Footer
 */
?>
<footer id="colophon" class="site-footer" role="contentinfo">

	<div id="footer-widgets" class="full-container">
		<?php dynamic_sidebar( 'sidebar-footer' ) ?>

<div class="copyright">
      <span class="line active"></span>
      
      <span class="pull-left">
	<span ><a href="http://qwerty.ie/">Web Design</a> by Qwerty.ie</span>
      </span>
      <span class="pull-right">	
	<span>Copyright © 2014 <a href="http://www.headstuff.org">Headstuff.org</a>. All Rights Reserved.</span>
      </span>
    </div> 


	</div><!-- #footer-widgets -->

	<?php $site_info_text = apply_filters('vantage_site_info', siteorigin_setting('general_site_info_text') ); if( !empty($site_info_text) ) : ?>
		<div id="site-info">
			<?php echo wp_kses_post($site_info_text) ?>
		</div><!-- .site-info -->
	<?php endif; ?>


<!--
<div style="width: auto; max-width: 1080px; color:rgb(227,217,194); margin: 0 auto; ">
<div style="max-width:600px; float:left;">HeadStuff.org is a collaborative website interested in a wide range of topics including; literature, history, science, art/photography, humour, music and film. We are always open to submissions in any of those fields, and we strive to keep the site continuously up to date and up to the same high standards of work. If you want to submit work in the hope that it will be published on HeadStuff, send an email with your work, or your ideas to: Editor@headstuff.org or if you just want to keep up with what's new on HeadStuff you can follow us on Facebook or Twitter or join our mailing list, all links are to the right.
</div>

<div>

<div style="max-width:300px;">

</div>

</div>

	<div id="links" style="float:right;">

<div class="support-text">


<a href="mailto:editor@headstuff.org?subject=Message%20from%20HeadStuff%20link" title="Email">				
					Email
				</a>
<br/>
<a href="http://www.facebook.com/theheadstuff" title="facebook">				
					Facebook
				</a>
<br/>
<a href="http://twitter.com/thisheadstuff" title="twitter">				
					Twitter
				</a>
<br/>
<a href="http://astore.amazon.co.uk/head0a-21" title="bookstore">				
					Bookstore
				</a>
<br/>

			</div>

<div style="padding-top:30px">
<a href="http://qwerty.ie/">Web Design</a> by Qwerty.ie
</div>
</div>
<div style="clear:both">
</div>
</div>
-->
</footer><!-- #colophon .site-footer -->