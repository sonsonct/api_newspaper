<?php
    header('Accsess-Control-Allow-Origin:*');
    header('Content-Type: aplication/json');
    header('Accsess-Control-Allow-Methods: POST');
    header('Accsess-Control-Allow-Headers: Accsess-Control-Allow-Headers, Accsess-Control-Allow-Methods, Authorization,X-Requested-With');
    include_once('../../config/db.php');
    include_once('../../model/users.php');
    $db = new db();
    $connect = $db->connect();
    $users = new Users($connect);
    $data = json_decode(file_get_contents("php://input"));
    $users->username = $data->username;
    $users->password = $data->password;
    $users->fullname = $data->fullname;
    if($users->Register()){
        echo json_encode(array('mess', 'tk'));
    }else{
        echo json_encode(array('mess', 'tb'));
    }
?>