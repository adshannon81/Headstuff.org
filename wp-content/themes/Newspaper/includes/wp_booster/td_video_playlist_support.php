<?php

/*  ----------------------------------------------------------------------------
    tagDiv video playlist support
    - creates the array to be saved in post meta

structure : all possible cases

    array(
       youtube_lists = array(
            array(1, 2, 3, 4, 5),
            array(2 ,3 ,4)
       ),

       vimeo_lists = array(
            array(a, b, c)
       ),

       youtube_ids = array(
            1 => array(title, thumb, time),
            2 => array(title, thumb, time),
            3 => array(title, thumb, time)
       ),

       vimeo_ids = array(
            a => array(title, thumb, time),
            b => array(title, thumb, time),
            c => array(title, thumb, time)
       )
    )
 */

class td_video_playlist_support {

    static $td_playlist_video_key = 'td_playlist_video';


    //put the filter to get data when the post is saved
    static function init() {
        if(is_admin()) {
            add_filter('save_post', array( __CLASS__, 'save_playlist_hook'));
        }
    }


    //parse the content and id playlist video shortcode is found then save that shortcode data in post_meta as an array of arrays
    static function save_playlist_hook($post_id){

        $td_playlist_video = array();

        //check for saved playlists in post meta
        $td_playlist_video_db = get_post_meta($post_id, self::$td_playlist_video_key, true);

        if(!empty($_POST['post_content'])) {
            $post_content = $_POST['post_content'];


            //HANDLE YOUTUBE
            $youtube_regular_expresion = '/\[td_video_youtube(.*)title=(.*)yt=(.*)auto_play=(.*)\/]/i';

            if (preg_match($youtube_regular_expresion, $post_content)) {

                //get youtube playlist's (shortcode)
                preg_match_all($youtube_regular_expresion, $post_content, $matches_youtube);

                //get an array of youtube list; array_filter = remove empty arrays
                $youtube_id_array = array_filter(self::get_ids_from_list($matches_youtube[3]));

                if(!empty($youtube_id_array)) {
                    //$td_playlist_video['lists_youtube'] = $youtube_id_array;

                    //get the info for the videos
                    $td_playlist_video['youtube_ids'] = self::get_video_info_data(array($youtube_id_array, $td_playlist_video_db, 'youtube_ids'));

                    //save title
                    $title_for_save_youtube = self::get_title($matches_youtube[2][0]);
                    if(!empty($title_for_save_youtube)) {
                        $td_playlist_video['youtube_title'] = $title_for_save_youtube;
                    }

                    //save autoplay
                    $autoplay_youtube = self::get_autoplay($matches_youtube[4][0]);
                    if($autoplay_youtube > 0) {
                        $td_playlist_video['youtube_auto_play'] = 1;
                    }

                }
            }


            //HANDLE VIMEO
            $vimeo_regular_expresion = '/\[td_video_vimeo(.*)title=(.*)v=(.*)auto_play=(.*)\/]/i';

            if (preg_match($vimeo_regular_expresion, $post_content)) {

                //get vimeo playlist's (shortcode)
                preg_match_all($vimeo_regular_expresion, $post_content, $matches_vimeo);

                //get an array of youtube list; array_filter = remove empty arrays
                $vimeo_id_array =  array_filter(self::get_ids_from_list($matches_vimeo[3]));

                if(!empty($vimeo_id_array)) {
                    //$td_playlist_video['lists_vimeo'] = $vimeo_id_array;

                    //get the info for the videos
                    $td_playlist_video['vimeo_ids'] = self::get_video_info_data(array($vimeo_id_array, $td_playlist_video_db, 'vimeo_ids'));

                    //save title
                    $title_for_save_vimeo = self::get_title($matches_vimeo[2][0]);
                    if(!empty($title_for_save_vimeo)) {
                        $td_playlist_video['vimeo_title'] = $title_for_save_vimeo;
                    }

                    //save autoplay
                    $autoplay_vimeo = self::get_autoplay($matches_vimeo[4][0]);
                    if($autoplay_vimeo > 0) {
                        $td_playlist_video['vimeo_auto_play'] = 1;
                    }

                }
            }
        }

        //add or edit the video playlist for this post
        if(!empty($td_playlist_video) or !empty($td_playlist_video_db)){

            update_post_meta($post_id, self::$td_playlist_video_key, $td_playlist_video);
        }

        //self::write_output_data($td_playlist_video);

    }


    /*
     * return an array of video id's
     * */
    static function get_ids_from_list ($array_id_list){

        if(empty($array_id_list)){
            return;
        }

        $buffy = array();

        //parse the $array_id_list with video ids; remove this foreach because we don't have more then one youtube video player on page
        //$array_count = 0;
        //foreach($array_id_list as $list_video_ids) {

           $list_video_ids = trim($array_id_list[0]);

           $explode_vide_ids = explode('\"',$list_video_ids);


            if(!empty($explode_vide_ids[1])) {

                //this is needed because we could have more space between each movie id
                $remove_spaces = trim(str_replace(array('&nbsp;', ' '),array(''), htmlentities($explode_vide_ids[1], ENT_QUOTES)));

                $video_id_explode = explode(',', $remove_spaces);
                $video_id_explode = array_map('trim',$video_id_explode);//extra trim just in case

                //make an array of video id's'
                //$video_array = array();
                foreach($video_id_explode as $video_id) {
                    $trim_video_id = trim($video_id);

                    //$video_array[] = $trim_video_id;

                    //check to see in we don't have duplicates ids
                    if (!in_array($trim_video_id, $buffy)) {
                        $buffy[] = $trim_video_id;
                    }
                }

                /*if(!empty($video_array)) {
                    $buffy[$array_count] = $video_array;
                    $array_count++;
                }*/
            }
        //}

        return $buffy;
    }


    /*
     * return an array of video id's
     * */
    static function get_video_info_data ($array_param){

        $list_to_parse = $array_param[0];

        $data_from_db = $array_param[1];

        $video_provider = $array_param[2];

        $buffy = array();

        //self::write_output_data($data_from_db, 'w', 'db_data.txt');

        //get the info data for videos
        //foreach($list_to_parse as $array_id_video) {

            foreach($list_to_parse as $id_video) {

                $id_video = trim($id_video);//possible to have spaces

                if(!empty($data_from_db[$video_provider][$id_video])) {
                    $buffy[$id_video] = $data_from_db[$video_provider][$id_video];

                } else {

                    //get the info data for video
                    switch ($video_provider) {
                        case 'youtube_ids':
                            $response = file_get_contents('http://gdata.youtube.com/feeds/api/videos/' . $id_video . '?format=5&alt=json');
                            $obj = json_decode($response, true);

                            $buffy[$id_video]['thumb'] = 'http://img.youtube.com/vi/' . $id_video . '/default.jpg';
                            $buffy[$id_video]['title'] = htmlentities($obj['entry']['media$group']['media$title']['$t'], ENT_QUOTES);
                            $buffy[$id_video]['time'] = gmdate("H:i:s", intval($obj['entry']['media$group']['yt$duration']['seconds']) - 1);
                            break;

                        case 'vimeo_ids':
                            $html_returned = unserialize(file_get_contents('http://vimeo.com/api/v2/video/' . $id_video . '.php'));

                            $buffy[$id_video]['thumb'] = $html_returned[0]['thumbnail_small'];
                            $buffy[$id_video]['title'] = htmlentities($html_returned[0]['title'], ENT_QUOTES);
                            $buffy[$id_video]['time'] = gmdate("H:i:s", intval($html_returned[0]['duration']));
                            break;
                    }

                }

            }

        //}


        if(!empty($buffy)) {
            return $buffy;
        } else {
            return;
        }
    }


    //get the title for the playlist video
    static function get_title($data_title){

        $exp_title = explode('\"',$data_title);

        $new_title = '';
        foreach($exp_title as $part_title) {
            if(!empty($part_title)) {
                $new_title .= $part_title;
            }
        }

        /*$title_youtube = trim(str_replace(array('\\"', "\\'", "&nbsp;", ' '), array('"', "'", '', ''), $data_title));
        $title_youtube = trim(preg_replace('/^"/', '', preg_replace('/"$/', '', $title_youtube)));//remove begging "  and end "*/

        if(!empty($new_title)) {
            return trim(str_replace(array('&nbsp;', '\\'),array(''), htmlentities($new_title, ENT_QUOTES)));//trim just in case
        } else {
            return;
        }

    }


    static function get_autoplay($text) {
        if(!empty($text)) {
            $explode_text = explode('\"', $text);

            if(intval($explode_text[1]) > 0) {
                return 1;
            }
        }

        return 0;
    }


    static function write_output_data($data, $write_type = 'w', $file_name = 'testFile.txt'){
        //this is for output; the page is redirected and no output is given by this function
        $myFile = "d:/" . $file_name;
        $fh = fopen($myFile, $write_type) or die("can't open file");
        $stringData = print_r($data, 1);

        fwrite($fh, $stringData);
        fclose($fh);
    }

}

td_video_playlist_support::init();