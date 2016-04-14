<?php

$return = [];
if(empty($_POST['username']) && empty($_POST['email'])){
    echo 'malakies';
}else{
    $return['errors'] = 's';
}

echo json_encode($return);