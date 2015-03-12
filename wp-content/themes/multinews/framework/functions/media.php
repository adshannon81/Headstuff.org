<?php
// Yotube video duration
function mom_youtube_duration ($id) {
   //delete_option('mom_yotube_video_duration_'.$id);
$x = "H:i:s";
$duration =  get_option('mom_yotube_video_duration_'.$id);
if (false !== $duration) {
if ($duration < 3600) { $x = "i:s";}
    return gmdate($x, $duration);
}

$duration = 0;
$data = wp_remote_get('http://gdata.youtube.com/feeds/api/videos/'.$id.'?v=2&alt=jsonc');
    if (!is_wp_error($data)) {
                $json = json_decode( $data['body'], true );
		$duration = intval($json['data']['duration']);
                if ($duration < 3600) { $x = "i:s";}
                update_option('mom_yotube_video_duration_'.$id, $duration);
    return gmdate($x, $duration);
    } else {
        return 'error';
    }
    
}

// Vimeo video duration
function mom_vimeo_duration ($id) {
   //delete_option('mom_yotube_video_duration_'.$id);
$x = "H:i:s";
$duration =  get_option('mom_vimeo_video_duration_'.$id);
if (false !== $duration) {
if ($duration < 3600) { $x = "i:s";}
    return gmdate($x, $duration);
}

$duration = 0;
$data = wp_remote_get('http://vimeo.com/api/v2/video/'.$id.'.json');
    if (!is_wp_error($data)) {
                $json = json_decode( $data['body'], true );
		$duration = intval($json[0]['duration']);
                if ($duration < 3600) { $x = "i:s";}
                update_option('mom_vimeo_video_duration_'.$id, $duration);
    return gmdate($x, $duration);
    } else {
        return 'error';
    }
    
}
