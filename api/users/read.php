<?php
    header('Accsess-Control-Allow-Origin:*');
    // header('Content-Type: aplication/json');
    include_once('../../config/db.php');
    include_once('../../model/users.php');
    $db = new db();
    $connect = $db->connect();
    $users = new Users($connect);
    $read = $users->read();
    $num = $read->rowCount();
    if($num>0){
        $users_array = [];
        $users_array['users'] = [];
        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $user_elm = array(
                'id' => $id,
                'username'=>$username,
                'password'=>$password
            );
            array_push($users_array['users'],$user_elm);
        }
        echo json_encode($users_array);
       
    }
?>