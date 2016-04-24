<?php

session_start();
require_once 'db_conx.php';

$return = [];

if(isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];

    $query = "SELECT * FROM playlists WHERE user_id='$user_id'";
    $result = mysqli_query($conx, $query);

    $return['html'] = '<form>';
    $return['html'] .=   '<div class="form-group">';
    $return['html'] .=       '<input type="text" name="playlist-title" class="form-control" placeholder="New playlist pame">';
    $return['html'] .=   '</div>';
    if(mysqli_num_rows($result)){
        $return['html'] .=   '<div class="form-group">';
        $return['html'] .=       '<select name="playlist" class="form-control">';

        while($row = mysqli_fetch_assoc($result)){
            $return['html'] .=   '<option value="'.$row['id'].'">'.$row['title'].'</option>';
        }

        $return['html'] .=       '</select>';
        $return['html'] .=   '</div>';
    }
    $return['html'] .=  '<button type="submit" class="btn btn-primary">Save</button>';
    $return['html'] .= '</form>';
}else{
    $return['redirect'] = 'login.php';
}

echo json_encode($return);