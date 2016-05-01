<?php

session_start();

require_once 'db_conx.php';

$return = [];
if(isset($_SESSION['user'])){
    if(!empty($_GET['track']) && !empty($_GET['playlist'])){
        $user_id = $_SESSION['user']['id'];

        $track = mysqli_real_escape_string($conx, $_GET['track']);
        $playlist = mysqli_real_escape_string($conx, $_GET['playlist']);

        $query = "DELETE tracks.* FROM tracks JOIN playlists ON tracks.playlist_id=playlists.id
                  WHERE tracks.playlist_id='$playlist' AND tracks.soundcloud_track_id='$track' AND playlists.user_id='$user_id'";

        if(mysqli_query($conx, $query)){
            $return['done'] = true;
        }
    }
}

echo json_encode($return);