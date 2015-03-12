<?php
global $wpalchemy_media_access;
wp_enqueue_script( 'momizat-mb-ads', get_template_directory_uri() . '/framework/ads/js/ads-meta.js', array('jquery'), '1.0', true );

?>
<div class="mom_meta_control">
    <div class="mom_tiny_form_element">
   <?php $mb->the_field('ad_size'); ?>
        <div class="mom_tiny_desc">
            <div class="mom_td_bubble">
                <label for="<?php $mb->the_name(); ?>"><?php _e('Size', 'framework'); ?></label>
                <span><?php _e('Select your ad size', 'framework'); ?></span>
            </div> <!--bubble-->
        </div> <!--desc-->
        <div class="mom_tiny_input">
<select name="<?php $mb->the_name(); ?>">
    <optgroup label="Recommended">
        <option value="300x250" <?php $mb->the_select_state('300x250'); ?>><?php _e('300 x 250 - Medium Rectangle', 'framework'); ?></option>
        <option value="336x280" <?php $mb->the_select_state('336x280'); ?>><?php _e('336 x 280 - Large Rectangle', 'framework'); ?></option>
        <option value="728x90" <?php $mb->the_select_state('728x90'); ?>><?php _e('728 x 90 - Leaderboard', 'framework'); ?></option>
        <option value="160x600" <?php $mb->the_select_state('160x600'); ?>><?php _e('160 x 600 - Wide Skyscraper', 'framework'); ?></option>
        <option value="320x50" <?php $mb->the_select_state('320x50'); ?>><?php _e('320 x 50 - Mobile Banner', 'framework'); ?></option>
    </optgroup>
    <optgroup label="Other - Horizontal">
        <option value="234x60" <?php $mb->the_select_state('234x60'); ?>><?php _e('234 x 60 - Half Banner', 'framework'); ?></option>
        <option value="320x100" <?php $mb->the_select_state('320x100'); ?>><?php _e('320 x 100 - Large Mobile Banner', 'framework'); ?></option>
        <option value="468x60" <?php $mb->the_select_state('468x60'); ?>><?php _e('468 x 60 - Banner', 'framework'); ?></option>
        <option value="970x90" <?php $mb->the_select_state('970x90'); ?>><?php _e('970 x 90 - Large Leaderboard', 'framework'); ?></option>
    </optgroup>
    <optgroup label="Other - Vertical">
        <option value="120x600" <?php $mb->the_select_state('120x600'); ?>><?php _e('120 x 600 - Skyscraper', 'framework'); ?></option>
        <option value="120x240" <?php $mb->the_select_state('120x240'); ?>><?php _e('120 x 240 - Vertical Banner', 'framework'); ?></option>
        <option value="300x600" <?php $mb->the_select_state('300x600'); ?>><?php _e('300 x 600 - Large Skyscraper', 'framework'); ?></option>
    </optgroup>
    <optgroup label="Other - Square">
        <option value="250x250" <?php $mb->the_select_state('250x250'); ?>><?php _e('250 x 250 - Square', 'framework'); ?></option>
        <option value="200x200" <?php $mb->the_select_state('200x200'); ?>><?php _e('200 x 200 - Small Square', 'framework'); ?></option>
        <option value="180x150" <?php $mb->the_select_state('180x150'); ?>><?php _e('180 x 150 - Small Rectangle', 'framework'); ?></option>
        <option value="125x125" <?php $mb->the_select_state('125x125'); ?>><?php _e('125 x 125 - Button', 'framework'); ?></option>
    </optgroup>
    <optgroup label="Other - Responsive">
        <option value="responsive" <?php $mb->the_select_state('responsive'); ?>><?php _e('Responsive ad unit (for google AdSence)', 'framework'); ?></option>
    </optgroup>
    <optgroup label="Other - Custom">
        <option value="custom-size" <?php $mb->the_select_state('custom-size'); ?>><?php _e('Custom ad size', 'framework'); ?></option>
    </optgroup>
</select>
<div class="mti_options_wrap mti_custom_size hide">
    <div class="mti_option">
        <span><?php _e('Custom size (width x height)','framework'); ?> </span>
       <?php $mb->the_field('ad_custom_size_width'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="custom_input">
        <em class="sep">x</em>
       <?php $mb->the_field('ad_custom_size_height'); ?>
        <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="custom_input">
    </div>
</div> <!--mti_options-->
        </div> <!--input-->
        <div class="clear"></div>
    </div> <!--mom_meta_item-->

    <div class="mom_tiny_form_element">
   <?php $mb->the_field('ad_layout'); ?>
        <div class="mom_tiny_desc">
            <div class="mom_td_bubble">
                <label for="<?php $mb->the_name(); ?>"><?php _e('Ads Layout', 'framework'); ?></label>
                <span><?php _e('by default each ad will be in new line', 'framework'); ?></span>
            </div> <!--bubble-->
        </div> <!--desc-->
        <div class="mom_tiny_input">
            <select name="<?php $mb->the_name(); ?>">
                <option value="" <?php $mb->the_select_state(''); ?>><?php _e('Default', 'framework'); ?></option>
                <option value="grid" <?php $mb->the_select_state('grid'); ?>><?php _e('Grid', 'framework'); ?></option>
                <option value="rotator" <?php $mb->the_select_state('rotator'); ?>><?php _e('Rotator', 'framework'); ?></option>
            </select>
            <div class="mti_options_wrap mti_rotator_options hide">
            <div class="mti_option">
                <span><?php _e('Auto Rotate','framework'); ?></span>
               <?php $mb->the_field('ad_rotate_autoscroll'); ?>
            <select name="<?php $mb->the_name(); ?>" class="small">
                <option value="true" <?php $mb->the_select_state('true'); ?>><?php _e('Yes', 'framework'); ?></option>
                <option value="false" <?php $mb->the_select_state('false'); ?>><?php _e('No', 'framework'); ?></option>
            </select>
            </div>
            <div class="mti_option">
                <span><?php _e('Time Out','framework'); ?><span class="mom-small-desc simptip-position-top simptip-movable simptip-multiline" data-tooltip="The time between slide transitions. For use with auto rotate"><i class="enotype-icon-help"></i></span></span>
               <?php $mb->the_field('ad_rotate_timeout'); ?>
                <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="custom_input" placeholder="5000"><em class="mom-mti-suffix">ms</em>
            </div>
            <div class="mti_option">
                <span><?php _e('Transition Speed','framework'); ?><span class="mom-small-desc simptip-position-top simptip-movable simptip-multiline" data-tooltip="the speed of animation"><i class="enotype-icon-help"></i></span></span>
               <?php $mb->the_field('ad_rotate_speed'); ?>
                <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="custom_input" placeholder="800"><em class="mom-mti-suffix">ms</em>
            </div>
            <div class="mti_option">
                <span><?php _e('Effect','framework'); ?><span class="mom-small-desc simptip-position-top simptip-movable simptip-multiline" data-tooltip="the slide animation effect"><i class="enotype-icon-help"></i></span></span>
               <?php $mb->the_field('ad_rotate_effect'); ?>
            <select name="<?php $mb->the_name(); ?>" class="medium">
                <option value="scrollVert3d" <?php $mb->the_select_state('scrollVert3d'); ?>><?php _e('Vertical Box', 'framework'); ?></option>
                <option value="scrollHorz3d" <?php $mb->the_select_state('scrollHorz3d'); ?>><?php _e('Horizontal Box', 'framework'); ?></option>
                <option value="fade" <?php $mb->the_select_state('fade'); ?>><?php _e('Fade', 'framework'); ?></option>
                <option value="scrollHorz" <?php $mb->the_select_state('scrollHorz'); ?>><?php _e('Horizontal Slide', 'framework'); ?></option>
                <option value="scrollVert" <?php $mb->the_select_state('scrollVert'); ?>><?php _e('Vertical Slide', 'framework'); ?></option>
            </select>
            </div>
            <div class="mti_option">
                <span><?php _e('Next&Prev Arrows','framework'); ?></span>
               <?php $mb->the_field('ad_rotate_arrows'); ?>
            <select name="<?php $mb->the_name(); ?>" class="small">
                <option value="no" <?php $mb->the_select_state('no'); ?>><?php _e('No', 'framework'); ?></option>
                <option value="yes" <?php $mb->the_select_state('yes'); ?>><?php _e('Yes', 'framework'); ?></option>
            </select>
            </div>

            </div> <!--mti_options-->
        </div> <!--input-->
        <div class="clear"></div>
    </div> <!--mom_meta_item-->

    <div class="mom_tiny_form_element">
   <?php $mb->the_field('ad_space'); ?>
        <div class="mom_tiny_desc">
            <div class="mom_td_bubble">
                <label for="<?php $mb->the_name(); ?>"><?php _e('Space', 'framework'); ?></label>
                <span><?php _e('the space between each ad with pixels', 'framework'); ?></span>
            </div> <!--bubble-->
        </div> <!--desc-->
        <div class="mom_tiny_input">
                <input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" placeholder="14">
        </div> <!--input-->
        <div class="clear"></div>
    </div> <!--mom_meta_item-->


</div> <!--mom meta wrap-->