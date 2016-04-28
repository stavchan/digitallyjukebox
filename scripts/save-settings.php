<?php

session_start();
require_once 'db_conx.php';

$return = [];
if(empty($_POST['username']) || empty($_POST['email'])){
    if(empty($_POST['username']))
        $return['errors']['username'] = 'Username is empty';

    if(empty($_POST['email']))
        $return['errors']['email'] = 'Email is empty';
}else{
    $id = $_SESSION['user']['id'];
    $username = mysqli_real_escape_string($conx, $_POST['username']);
    $email = mysqli_real_escape_string($conx, $_POST['email']);
    $password = $_POST['password'];
    $birthdate = mysqli_real_escape_string($conx, $_POST['birthdate']);
    $facebook = mysqli_real_escape_string($conx, $_POST['facebook']);
    $twitter = mysqli_real_escape_string($conx, $_POST['twitter']);
    $googleplus = mysqli_real_escape_string($conx, $_POST['googleplus']);
    $about_me = mysqli_real_escape_string($conx, $_POST['about_me']);
    $info = mysqli_real_escape_string($conx, $_POST['info']);
    $country = mysqli_real_escape_string($conx, $_POST['country']);
    $city = mysqli_real_escape_string($conx, $_POST['city']);

    if(empty($password)){
        $query ="UPDATE users SET username='$username', email='$email', birthdate='$birthdate', facebook='$facebook', twitter='$twitter', googleplus='$googleplus',
                  about_me='$about_me', info='$info', country='$country', city='$city' WHERE id='$id'";
    }else{
        $password = md5(mysqli_real_escape_string($conx, $password));
        $query ="UPDATE users SET username='$username', password='$password', email='$email', birthdate='$birthdate', facebook='$facebook', twitter='$twitter', googleplus='$googleplus',
                  about_me='$about_me', info='$info', country='$country', city='$city' WHERE id='$id'";
    }

    $result = mysqli_query($conx, $query);

    if($result){
        $_SESSION['user']['username'] = $username;
        $_SESSION['user']['email'] = $email;

        $_SESSION['notice'] = 'User infos is updated';

        $return['location'] = 'user-settings.php';
    }else if(mysqli_error($conx)){
        $return['errors']['base'][] = mysqli_error($conx);
    }
}

echo json_encode($return);