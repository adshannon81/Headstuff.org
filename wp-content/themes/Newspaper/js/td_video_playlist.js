 /*
    td_video_playlist.js
    v1.1
 */

"use strict";

//vimeo vars
var td_playlist_video_autoplay_vimeo = 0;// autoplay youtube

var td_playlisty_player_vimeo;////a global copy of the vimeo player : needed when playing or pausing the vimeo pleyer from the playlist control


//youtube vars
var td_playlist_id_youtube_video_running = '';// youtube current video id

var td_playlist_video_autoplay_youtube = 0;// flag autoplay youtube

//doesn't work on  ready
jQuery().ready(function() {


    //check autoplay youtube
    if(jQuery('.td_wrapper_player_youtube').data("autoplay") == "1") {
        td_playlist_video_autoplay_youtube = 1;
    }



    //click on a youtube movie
    jQuery('.td_click_video_youtube').click(function(){

        //this flag is check to see if to start the movie
        td_playlist_video_autoplay_youtube = 1;

        //create  and play the clicked video
        var td_youtube_first_video = jQuery(this).attr("id").substring(3);
        if(td_youtube_first_video != '') {
            td_playlist_create_player(td_youtube_first_video);
        }
    });



    //click on youtube play control
    jQuery('.td_youtube_control').click(function(){

        //click to play
        if(jQuery(this).hasClass('td-sp-video-play')){
            //this is to enable video playing
            td_playlist_video_autoplay_youtube = 1;

            //play the video
            td_playlist_youtube_play_video();

        } else {

            //put pause to the player
            td_playlist_youtube_pause_video();
        }
    });



    //check for youtube wrapper and add api code to create the player
    if(jQuery('.td_wrapper_player_youtube').length) {
        var td_tag_yt_player = document.createElement('script');

        td_tag_yt_player.src = "https://www.youtube.com/iframe_api";
        var td_yt_firstScriptTag = document.getElementsByTagName('script')[0];
        td_yt_firstScriptTag.parentNode.insertBefore(td_tag_yt_player, td_yt_firstScriptTag);
    }



    //check autoplay vimeo
    if(jQuery('.td_wrapper_player_vimeo').data("autoplay") == "1") {
        td_playlist_video_autoplay_vimeo = 1;
    }

    //click on a vimeo
    jQuery('.td_click_video_vimeo').click(function(){

        //this flag is check to see if to start the movie
        td_playlist_video_autoplay_vimeo = 1;

        //create  and play the clicked video
        td_vimeo_playlist_obj.create_player(jQuery(this).attr("id").substring(3));
    });





    //check for vimeo wrapper and add api code to create the player
    if(jQuery('.td_wrapper_player_vimeo').length) {

        //create the iframe with the video
        td_vimeo_playlist_obj.create_player(jQuery('.td_wrapper_player_vimeo').data("first-video"));
    }




    //click on youtube play control
    jQuery('.td_vimeo_control').click(function(){

        //click to play
        if(jQuery(this).hasClass('td-sp-video-play')){
            //this is to enable video playing
            td_playlist_video_autoplay_vimeo = 1;

            //play the video
            td_playlisty_player_vimeo.api("play");

        } else {

            //put pause to the player
            td_playlisty_player_vimeo.api("pause");
        }
    });

    //td_resize_videos();
});




//YOUTUBE
// 3. This function creates an <iframe> (and YouTube player) after the API code downloads.
var td_yt_player;
function onYouTubeIframeAPIReady() {

   var first_video = jQuery('.td_wrapper_player_youtube').data('first-video');

   if(first_video != '') {
       td_playlist_create_player(first_video);
   }
}


//create the youtube player
function td_playlist_create_player(video_id){

    //get values from td_youtube_list_ids object
    //td_playlist_id_youtube_video_running = 'td_' + video_id;
    td_playlist_id_youtube_video_running = video_id;
    var current_video_name = td_youtube_list_ids['td_' + td_playlist_id_youtube_video_running]['title'];
    var current_video_time = td_youtube_list_ids['td_' + td_playlist_id_youtube_video_running]['time'];

    //remove focus from all videos from playlist
    td_video_playlist_remove_focused('.td_click_video_youtube');

    //add focus class on current playing video
    jQuery('#td_' + video_id).addClass('td_video_currently_playing');

    //ading the current video playing title and time to the control area
    jQuery('#td_current_video_play_title_youtube').html(current_video_name);
    jQuery('#td_current_video_play_time_youtube').html(current_video_time);

    td_yt_player = '';
    jQuery(".td_wrapper_player_youtube").html("<div id='player_youtube'></div>");
    td_yt_player = new YT.Player('player_youtube', {
        //height: '100%',
        //width: '100%',
        videoId: video_id,
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
}


// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
    if(td_playlist_video_autoplay_youtube != 0) {

        //add pause to playlist control
        td_playlist_add_pause_control('.td_youtube_control');

        event.target.playVideo();
        //td_yt_player.playVideo();
    }
}


// 5. The API calls this function when the player's state changes.
//    The function indicates that when playing a video (state=1),
//    the player should play for six seconds and then stop.
var done = false;
function onPlayerStateChange(event) {
    /*
    if (event.data == YT.PlayerState.PLAYING && !done) {
        //setTimeout(stopVideo, 1000);
        done = true;
    }*/
    if (event.data == YT.PlayerState.PLAYING) {

        //add pause to playlist control
        td_playlist_add_pause_control('.td_youtube_control');

    } else if (event.data == YT.PlayerState.ENDED) {
        //video_events_js.on_stop('youtube');

        //add play to playlist control
        td_playlist_add_play_control('.td_youtube_control');

        //get the next video
        var next_video_id = td_playlist_choose_next_video([td_youtube_list_ids, td_playlist_id_youtube_video_running]);
        if(next_video_id != '') {
            td_playlist_create_player(next_video_id);
        }

    } else if (YT.PlayerState.PAUSED) {
        //add play to playlist control
        td_playlist_add_play_control('.td_youtube_control');
    }
}


function td_playlist_youtube_stopVideo() {
    td_yt_player.stopVideo();
}

function td_playlist_youtube_play_video() {
    td_yt_player.playVideo();
}

function td_playlist_youtube_pause_video() {
    td_yt_player.pauseVideo();
}


function td_video_playlist_remove_focused(obj_class) {
    //remove focus class
    jQuery( obj_class).each(function(){
        jQuery(this).removeClass('td_video_currently_playing');
    });
}


/*
 parram_array = array [
 video_list,
 current_video_id_playing
 ]
 */
function td_playlist_choose_next_video(parram_array){
    //alert('get next');

    var video_list = parram_array[0];
    var current_video_id_playing = 'td_' + parram_array[1];

    //get next video id
    var next_video_id = '';
    var found_current = '';
    for(var video in video_list){ // @todo loop-ul asta facut mai ok + break cand e gasit
        if(found_current == 'found') {
            next_video_id = video;
            found_current = '';
        }
        if(video == current_video_id_playing) {
            found_current = 'found';
        }
    }

    //play the next video
    if(next_video_id != '') {

        //remove 'td_' from the beginning of the string if necessary
        if(next_video_id.substring(0, 3) == 'td_') {
            next_video_id = next_video_id.substring(3);
        }

        return next_video_id;
    }

    return '';
}



//add pause button playlist control
function td_playlist_add_pause_control(wrapper_class){
    jQuery(wrapper_class).removeClass('td-sp-video-play').addClass('td-sp-video-pause');
}

//add play button playlist control
function td_playlist_add_play_control(wrapper_class){
    jQuery(wrapper_class).removeClass('td-sp-video-pause').addClass('td-sp-video-play');
}


//VIMEO
var td_vimeo_playlist_obj = {

    current_video_playing : '',

    create_player: function (video_id){
        if(video_id != '') {

            var vimeo_iframe_autoplay = '';

            this.current_video_playing = video_id;

            //remove focus class
            td_video_playlist_remove_focused('.td_click_video_vimeo');

            //add focus clas on play movie
            jQuery('#td_' + video_id).addClass('td_video_currently_playing');

            //put movie data to control box
            this.put_movie_data_to_control_box(video_id);

            //check autoplay
            if(td_playlist_video_autoplay_vimeo != 0) {
                vimeo_iframe_autoplay = '&autoplay=1';
            }


            jQuery('.td_wrapper_player_vimeo').html('');
            jQuery('.td_wrapper_player_vimeo').html('<iframe id="player_vimeo_1" src="//player.vimeo.com/video/' + video_id + '?api=1&player_id=player_vimeo_1' + vimeo_iframe_autoplay + '"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');//width="100%" height="100%"

            this.create_vimeo_object_player(jQuery);
        }

    },

    put_movie_data_to_control_box: function (video_id){
        jQuery('#td_current_video_play_title_vimeo').html(td_vimeo_list_ids['td_' + video_id]['title']);
        jQuery('#td_current_video_play_time_vimeo').html(td_vimeo_list_ids['td_' + video_id]['time']);
    },

    create_vimeo_object_player : function ($) {
        var iframe = '';
        var player = '';

        iframe = $('#player_vimeo_1')[0];
        player = $f(iframe)

        //a global copy of the vimeo player : needed when playing or pausing the vimeo pleyer from the playlist control
        td_playlisty_player_vimeo = player;

        // When the player is ready, add listeners for pause, finish, and playProgress
        player.addEvent('ready', function() {
            //status.text('ready');

            player.addEvent('play', td_vimeo_playlist_obj.onPlay);
            player.addEvent('pause', td_vimeo_playlist_obj.onPause);
            player.addEvent('finish', td_vimeo_playlist_obj.onFinish);
            player.addEvent('playProgress', td_vimeo_playlist_obj.onPlayProgress);
        });
    },

    onPlay : function onPlay(id) {
        td_playlist_add_pause_control('.td_vimeo_control');
    },

    onPause : function onPause(id) {
        td_playlist_add_play_control('.td_vimeo_control');
    },

    onFinish : function onFinish(id) {
        //status.text('finished');

        //add play to playlist control
        td_playlist_add_play_control('.td_vimeo_control');

        //get the next video
        var next_video_id = td_playlist_choose_next_video([td_vimeo_list_ids, td_vimeo_playlist_obj.current_video_playing]);
        if(next_video_id != '') {
            td_vimeo_playlist_obj.create_player(next_video_id);
        }
    },

    onPlayProgress : function onPlayProgress(data, id) {
        //status.text(data.seconds + 's played');
    }
};