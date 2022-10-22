<?php
    header('Accsess-Control-Allow-Origin:*');
    // header('Content-Type: aplication/json');
    include_once('../../config/db.php');
    include_once('../../model/users.php');
    $db = new db();
    $connect = $db->connect();
    $users = new Users($connect);
    $users->id = isset($_GET['id']) ? $_GET['id'] : die();
    $users->read_id();
    $user_elm = array(
        'id' => $users->id,
        'username'=>$users->username,
        'password'=>$users->password
    );
    print_r(json_encode($user_elm));
?>