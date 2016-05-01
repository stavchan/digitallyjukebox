<?php
include_once 'db_conx.php';

session_start();

if(empty($_POST['email']) && empty($_POST['password'])){
    $_SESSION['login_alert'] = 'You have not completed the required fields';
    header('location: ../login.php');
}else{
    $email = mysqli_real_escape_string($conx, $_POST['email']);
    $password = md5(mysqli_real_escape_string($_POST['password']));

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
    $result = mysqli_query($conx, $query);

    if(mysqli_num_rows($result)>0){
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user']['username'] = $user['username'];
        $_SESSION['user']['email'] = $user['username'];
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['role'] = $user['role'];

        $_SESSION['notice'] = 'You have been successfully logged in';

        if($user['role']=='admin'){
            header('location: ../admin/index.php');
        }else{
            header('location: ../index.php');
        }
    }else{
        $_SESSION['login_alert'] = 'User credentials was wrong';
        header('location: ../login.php');
    }
}