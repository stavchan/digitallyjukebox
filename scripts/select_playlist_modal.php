<?php

session_start();
require_once 'db_conx.php';

$return = [];

if(isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];
    $track = $_GET['trackId'];

    $query = "SELECT * FROM playlists WHERE user_id='$user_id'";
    $result = mysqli_query($conx, $query);

    $return['html'] = '<form id="select-playlist">';
    $return['html'] .=   '<input type="hidden" value="'.$track.'" name="track-id">';
    $return['html'] .=   '<div class="form-group">';
    $return['html'] .=       '<input type="text" name="playlist-title" class="form-control" placeholder="New playlist pame">';
    $return['html'] .=   '</div>';
    $return['html'] .=   '<div class="form-group">';
    $return['html'] .=       '<select name="playlist" class="form-control">';
    $return['html'] .=          '<option value="">Select Playlist</option>';
    if(mysqli_num_rows($result)){
        while($row = mysqli_fetch_assoc($result)){
            $return['html'] .=   '<option value="'.$row['id'].'">'.$row['title'].'</option>';
        }
    }
    $return['html'] .=       '</select>';
    $return['html'] .=   '</div>';
    $return['html'] .=  '<button type="submit" class="btn btn-primary">Save</button>';
    $return['html'] .= '</form>';
}else{
    $return['redirect'] = 'login.php';
}

echo json_encode($return);