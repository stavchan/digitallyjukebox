<?php

session_start();
require_once 'db_conx.php';

$return = [];
if(isset($_SESSION['user'])){
    if(!empty($_POST['playlist']) && !empty($_POST['playlist']) && !empty($_POST['comment'])){
        $user = $_SESSION['user'];

        $user_id = $user['id'];
        $playlist = mysqli_real_escape_string($conx, $_POST['playlist']);
        $comment = mysqli_real_escape_string($conx, $_POST['comment']);

        $query = "INSERT INTO comments(user_id, comment, playlist_id) VALUES('$user_id', '$comment', '$playlist')";
//elegxos
        if(mysqli_query($conx, $query)){
            $return['html'] = '<li class="list-group-item clearfix">';
            $return['html'] .=   '<a href="#" class="pull-left thumb-sm m-r">';
            $return['html'] .=       '<img src="assets/images/m0.jpg" alt="...">';
            $return['html'] .=    '</a>';
            $return['html'] .=    '<a class="clear" href="#">';
            $return['html'] .=       '<span class="block text-ellipsis">'.$comment.'</span>';
            $return['html'] .=       '<small class="text-muted">by '.$user['username'].'</small>';
            $return['html'] .=    '</a>';
            $return['html'] .=   '</li>';
        }else{
            $return['errors'][] = mysqli_error($conx);
        }
    }
}

echo json_encode($return);
