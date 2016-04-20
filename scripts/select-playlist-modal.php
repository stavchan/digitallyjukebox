<?php

session_start();
require_once 'db_conx.php';

if(isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];

    $query = "SELECT * FROM playlists WHERE user_id='$user_id'";
    $result = mysqli_query($conx, $query);

    if(mysqli_num_rows($result)){
        return 'fd';
    }else{
        return 's';
    }
}else{
    return 'd';
}