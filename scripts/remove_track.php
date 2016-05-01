<?php

session_start();

require_once 'db_conx.php';

$return = [];

if(!empty($_GET['track']) && !empty($_GET['playlist'])){
    $track = mysqli_real_escape_string($conx, $_GET['track']);
    $playlist = mysqli_real_escape_string($conx, $_GET['playlist']);

    $query = "DELETE FROM tracks WHERE playlist_id='$playlist' AND soundcloud_track_id='$track'";

    if(mysqli_query($conx, $query)){
        $return['done'] = true;
    }
}

echo json_encode($return);