<?php
class td_block_video_playlist extends td_block {


    function __construct() {
        $this->block_id = 'video_playlist';

        //$this->$playlist_name = $plist_name;
        add_shortcode('td_video_youtube', array($this, 'render_youtube'));
        add_shortcode('td_video_vimeo', array($this, 'render_vimeo'));
    }


    function render_youtube($atts){
        return $this->render_generic($atts, 'youtube');
    }

    function render_vimeo($atts){

        //load the froogaloop library for vimeo
        wp_enqueue_script('td-froogaloop', get_template_directory_uri() . '/js/vimeo_froogaloop.js', array('jquery'), TD_THEME_VERSION, true); //load at beginning

        return $this->render_generic($atts, 'vimeo');
    }


    function render_generic($atts, $list_type){

        $post_column_number = '';

        if(is_single()) {
            global $post;

            //get the playlists in post meta if any
            $playlist_video_db = get_post_meta($post->ID, td_video_playlist_support::$td_playlist_video_key, true);

            //get the column number on single post page
            $td_post_theme_settings = get_post_meta($post->ID, 'td_post_theme_settings', true);
            if (!empty($td_post_theme_settings['td_sidebar_position'])) {
                if($td_post_theme_settings['td_sidebar_position'] == 'no_sidebar'){
                    $post_column_number = 3;
                } else {
                    $post_column_number = 2;
                }
            } else {
                $post_column_number = 2;
            }

        } else {
            extract(shortcode_atts(
                array(
                    'custom_title' => ''
                ),$atts));
        }

        $this->block_uid = td_global::td_generate_unique_id(); //update unique id on each render
        $buffy = ''; //output buffer


        $buffy .= '<div class="td_block_wrap td_block_video_playlist">';

            //get the block title
            //$buffy .= $this->get_block_title($atts);

            $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
                //inner content of the block
                $buffy .= $this->inner($playlist_video_db, $list_type, $post_column_number);
            $buffy .= '</div>';

        $buffy .= '</div> <!-- ./block_video_playlist -->';
        return $buffy;
    }

    function inner($playlist_video_db, $list_type, $td_column_number = '') {
        //global $post;

        $buffy = '';

        $td_block_layout = new td_block_layout();
        if (empty($td_column_number)) {
            $td_column_number = $td_block_layout->get_column_number(); // get the column width of the block
        }

        //$td_post_count = 0; // the number of posts rendered
        $td_current_column = 1; //the current column
        //echo $td_column_number;

        $vimeo_js_player_placeholder = '';//use only for vimeo to hold the js for the player
        if($list_type == 'youtube') {
            //array key for youtube in the pos meta db array
            $list_name = 'youtube_ids';
        } else {
            //array key for vimeo in the pos meta db array
            $list_name = 'vimeo_ids';
        }

        if(!empty($playlist_video_db) and !empty($playlist_video_db[$list_name])){

            $first_video_id = '';
            $contor_first_video = 0;
            $js_object = '';
            $click_video_container = '';

            foreach($playlist_video_db[$list_name] as $video_id => $video_data) {

                //take the id of first video
                if($contor_first_video == 0) {$first_video_id = $video_id;}
                $contor_first_video++;

                //add comma (,) for next value
                if(!empty($js_object)) {$js_object .= ',';}
                $js_object .= "\n'td_".$video_id."':{";

                $video_data_propeties = '';

                //get thumb
                $playlist_structure_thumb = '';
                if(!empty($video_data['thumb'])){
                    $playlist_structure_thumb = '<div class="td_video_thumb"><img src="' . $video_data['thumb'] . '"></div>';
                    //$video_data_propeties .= 'thumb:"' . $video_data['thumb'] . '",';
                }

                //get title
                $playlist_structure_title = '<div class="td_video_title_and_time">';
                    if(!empty($video_data['title'])){
                        $playlist_structure_title .= '<div class="td_video_title">' . $video_data['title'] . '</div>';
                        $video_data_propeties .= 'title:"' . $video_data['title'] . '",';
                    }

                    //get time
                    $playlist_structure_time = '';
                    if(!empty($video_data['time'])){

                        $get_video_time = '';
                        if(substr($video_data['time'], 0, 3) == '00:') {
                            $get_video_time = substr($video_data['time'], 3);
                        } else {
                            $get_video_time = $video_data['time'];
                        }

                        $playlist_structure_title .= '<div class="td_video_time">' . $get_video_time . '</div>';
                        $video_data_propeties .= 'time:"' . $get_video_time . '"';
                    }
                $playlist_structure_title .= '</div>';

                //creating click-able playlist video
                $click_video_container .= '<a id="td_' . $video_id . '" class="td_click_video td_click_video_' . $list_type . '"> ' . $playlist_structure_thumb . $playlist_structure_title . '</a>';

                $js_object .= $video_data_propeties . "}";
            }



            if(!empty($js_object)) {
                $js_object = 'var td_' . $list_type . '_list_ids = {' .$js_object. '}';
            }

            //creating column number classes
            $column_number_class = 'td_video_playlist_column_2';
            if($td_column_number == 3) {
                $column_number_class = 'td_video_playlist_column_3';
            }

            //creating title wrapper if any
            $td_video_title = '';
            if(!empty($playlist_video_db[$list_type . '_title'])) {
                $td_video_title = '<div class="td_video_playlist_title"><div class="td_video_title_text">' . $playlist_video_db[$list_type . '_title'] . '</div></div>';
            }


            //autoplay
            $td_playlist_autoplay = 0;
            $td_class_autoplay_control = 'td-sp-video-play';
            if(!empty($playlist_video_db[$list_type . '_auto_play']) and intval($playlist_video_db[$list_type . '_auto_play']) > 0) {
                $td_playlist_autoplay = 1;

                $td_class_autoplay_control = 'td-sp-video-pause';
            }

            //check how many video ids we have; if there are more then 5 then add a class that is used on chrome to add the playlist scroll bar
            $td_class_number_video_ids = '';
            $td_playlist_video_count = count($playlist_video_db[$list_name]);
            if(intval($td_playlist_video_count) > 5) {
                $td_class_number_video_ids = 'td_add_scrollbar_to_playlist';
            }

            //$js_object is there so we can take the string and parsit as json to create an object in jQuery
            return '<div class="td_wrapper_video_playlist ' . $column_number_class . '">
                       ' . $td_video_title . '
                       <div class="td_wrapper_player td_wrapper_player_' . $list_type . '" data-first-video="' . $first_video_id . '" data-autoplay="' . $td_playlist_autoplay . '">
                            <div id="player_' . $list_type . '"></div>
                       </div><div class="td_container_video_playlist " >
                                                <div class="td_video_controls_playlist_wrapper"><div class="td_video_stop_play_control"><a class="' . $td_class_autoplay_control . ' td-sp td_' . $list_type . '_control"></a></div><div id="td_current_video_play_title_' . $list_type . '" class="td_video_title_playing"></div><div id="td_current_video_play_time_' . $list_type . '" class="td_video_time_playing"></div></div>
                                                <div id="td_' . $list_type . '_playlist_video" class="td_playlist_clickable ' . $td_class_number_video_ids . '">' . $click_video_container . '</div>
                       </div>
                    </div>
                    <script>' . $js_object . '</script>';
        }


        //current column
        if ($td_current_column == $td_column_number) {
            $td_current_column = 1;
        } else {
            $td_current_column++;
        }

        $buffy .= $td_block_layout->close_all_tags();
        return $buffy;
    }


    function get_map () {

        /*/get the generic filter array
        $generic_filter_array = td_generic_filter_array::get_array();

        //add custom filter fields to generic filter array
        array_push ($generic_filter_array,
            array(
                "param_name" => "custom_title",
                "type" => "textfield",
                "value" => "",
                "heading" => __("Optional - custom title for this block:", TD_THEME_NAME),
                "description" => "",
                "holder" => "div",
                "class" => ""
            )
        );*/

        return array(
            "name" => __("Block Video Playlist", TD_THEME_NAME),
            "base" => "td_block_video_playlist",
            "class" => "td_block_video_playlist",
            "controls" => "full",
            "category" => __('Blocks', TD_THEME_NAME),
            'icon' => 'icon-pagebuilder',
            "params" => array(
                            array(
                                "param_name" => "title",
                                "type" => "textfield",
                                "value" => "",
                                //"heading" => __("Optional - custom title for this block:", TD_THEME_NAME),
                                "heading" => "Optional - custom title for this block:",
                                "description" => "",
                                "holder" => "div",
                                "class" => ""
                            ),
                            array(
                                "param_name" => "yt",
                                "type" => "dropdown",
                                "value" => array('Youtube playlist' => 'yt', 'Vimeo playlist' => 'v'),
                                //"heading" => __("Select playlist type:", TD_THEME_NAME),
                                "heading" => "Select playlist type:",
                                "description" => "",
                                "holder" => "div",
                                "class" => ""
                            ),
                            array(
                                "param_name" => "list_ids",
                                "type" => "textfield",
                                "value" => "",
                                //"heading" => __("Optional - custom title for this block:", TD_THEME_NAME),
                                "heading" => "list of id's:",
                                "description" => "",
                                "holder" => "div",
                                "class" => ""
                            ),
                            array(
                                "param_name" => "autoplay",
                                "type" => "dropdown",
                                "value" => array('OFF' => '0', 'ON' => '1'),
                                //"heading" => __("Select playlist type:", TD_THEME_NAME),
                                "heading" => "Autoplay ON / OFF:",
                                "description" => "",
                                "holder" => "div",
                                "class" => ""
                            )
                    )
        );


    }

}

//add instance to visual composer
td_global_blocks::add_instance('Block Video Playlist', new td_block_video_playlist());
