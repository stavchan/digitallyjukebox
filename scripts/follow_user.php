<?php

session_start();

require_once 'db_conx.php';

$return = [];

if(isset($_SESSION['user'])){
    $follower = $_SESSION['user']['id'];
    $following = mysqli_real_escape_string($conx, $_GET['user']);

    if($_GET['action'] == 'follow'){
        $query = "INSERT INTO followers(follower, following) VALUES('$follower', '$following')";
    }elseif($_GET['action'] == 'unfollow'){
        $query = "DELETE FROM followers WHERE follower='$follower' AND following='$following'";
    }

    if(mysqli_query($conx, $query)){
        $return['done'] = true;
    }
}

echo json_encode($return);