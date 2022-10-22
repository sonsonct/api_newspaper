<?php
    header('Accsess-Control-Allow-Origin:*');
    // header('Content-Type: aplication/json');
    include_once('../../config/db.php');
    include_once('../../model/users.php');
    $db = new db();
    $connect = $db->connect();
    $users = new Users($connect);
    
    $users->username = isset($_GET['username']) ? $_GET['username'] : die();
    
    $users->password = isset($_GET['password']) ? $_GET['password'] : die();
    $users->Login();
    $username = $users->username;
    $password = $users->password;
    $token = md5($username.$password);
    if($users->username=="" && $users->password==""){
        echo json_encode(array('mess'=>'err'));
    }else{
        // if($users->id!=null){
        //     $user_elm = array(
        //         'id' => $users->id,
        //         'username'=>$users->username,
        //         'password'=>$users->password,
        //         'token'=> $token,
        //     );
        //     print_r(json_encode($user_elm));
        // }else{
        //     echo json_encode(array('mess'=>'sai tk maat khau'));
        // }
        $read = $users->Login();
        $num = $read->rowCount();
        if($num>0){
            $user_elm = array(
                'username'=>$users->username,
                'password'=>$users->password,
                'token'=> $token
            );
            print_r(json_encode($user_elm));
        }else{
            echo json_encode(array('mess'=>'sai tk maat khau'));
        }
    }
