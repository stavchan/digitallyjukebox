<?php

require_once '../check_user.php';
require_once '../db_conx.php';

$response = [];

if(empty($_GET['track-id'])){
    $response['error'] = 'There is no track id to store in favorite list of user';
}else{
    $user_id = $_SESSION['user']['id'];

    $track_id = $_GET['track-id'];
    $query = "INSERT INTO favorite_tracks(user_id, souncloud_track_id) VALUES('$user_id', '$track_id')";

    if(mysqli_query($conx, $query)){
        $response['success'] = "Track with id $track_id is saved in favorite list successfully";
    }else{
        $response['error'] = 'Track is not saved in favorite list';
    }
}

echo json_encode($response);