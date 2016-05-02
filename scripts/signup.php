<?php

session_start();
if(isset($_SESSION['user'])){
    header('location: ../index.php');
}

include_once 'db_conx.php';

if(empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])){
    $_SESSION['errors'][] = 'You have not completed all fields';
    header('location: ../signup.php');
}else{
    $username = mysqli_real_escape_string($conx, $_POST['username']);
    $email = mysqli_real_escape_string($conx, $_POST['email']);
    $password = md5(mysqli_real_escape_string($conx, $_POST['password']));
    $role = 'user';

    // Check if username exists
    $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $username_result = mysqli_query($conx, $query);

    // Check if email exists
    $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $email_result = mysqli_query($conx, $query);

    if(mysqli_num_rows($username_result)>0 || mysqli_num_rows($email_result)>0){
        if(mysqli_num_rows($username_result)>0){
            $_SESSION['errors'][] = 'Username already exists';
        }

        if(mysqli_num_rows($email_result)>0){
            $_SESSION['errors'][] = 'Email address already exists';
        }

        header('location: ../signup.php');
    }else{
        $query = "INSERT INTO users(username, email, password, role) VALUES('$username', '$email', '$password', '$role')";
        $result = mysqli_query($conx, $query);

        if($result){
            $_SESSION['user']['username'] = $username;
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['id'] = mysqli_insert_id($conx);
            $_SESSION['user']['role'] = $role;
            $_SESSION['notice'] = 'You have been successfully registered';
            header('location: ../index.php');
        }else{
            $_SESSION['errors'][] = 'User registration failed';
            header('location: ../signup.php');
        }
    }
}