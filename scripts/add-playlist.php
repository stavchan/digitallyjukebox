<?php

session_start();
if(isset($_SESSION['user'])){
    require_once 'db_conx.php';

    $user_id = $_SESSION['user']['id'];

    $playlist_title = mysqli_real_escape_string($conx, $_POST['playlist-title']);
    $playlist = mysqli_real_escape_string($conx, $_POST['playlist']);
    $track = mysqli_real_escape_string($conx, $_POST['track-id']);

    $return = [];
    if(!empty($playlist) || !empty($playlist_title)){
        if(!empty($playlist)){
            $query = "INSERT INTO tracks(playlist_id, soundcloud_track_id) VALUES('$playlist', '$track')";
            $result = mysqli_query($conx, $query);

            if($result){
                $result['done'] = true;
            }else{
                $return['errors']['base'][] = mysqli_error($conx);
            }
        }elseif(!empty($playlist_title)){
            $query = "INSERT INTO playlists(title, user_id) VALUES('$playlist_title', '$user_id')";
            $result = mysqli_query($conx, $query);

            if($result){
                $playlist_id = mysqli_insert_id($conx);
                $query = "INSERT INTO tracks(playlist_id, soundcloud_track_id) VALUES('$playlist_id', '$track')";

                $result = mysqli_query($conx, $query);

                if($result){
                    $return['done'] = true;
                }else{
                    $return['errors']['base'][] = mysqli_error($conx);
                }
            }else{
                $return['errors']['base'][] = mysqli_error($conx);
            }
        }
    }else{
        $return['errors']['base'][] = 'Please select playlist';
    }
}


echo json_encode($return);