<?php
    class Users{
        private $conn;
        public $id;
        public $username;
        public $password;
        public $fullname;
        public function __construct($db){
            $this->conn=$db;
        }
        //read data
        public function read(){
            $query = "select * from users";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        //read by id 
        public function read_id(){
            $query = "select * from users where id=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->username = $row['username'];
            $this->password = $row['password'];
        }
        //login
        public function Login(){
            $query = "select * from users where username=:username and password=:password";
            $stmt = $this->conn->prepare($query);
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->password = htmlspecialchars(strip_tags($this->password));

            $stmt->bindParam(':username',$this->username);
            $stmt->bindParam(':password',$this->password);
            if($stmt->execute()){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                // $this->id = $row['id'];
                return $stmt;
            }else{
                // print('loi'.$stmt->error);
                // return "sai tk mat khaau";
            }
            
        }
        //is regiter
        public function isRegister($username, $id){
            $token = md5($username.$id);
            $sql = "insert into token(id, token) values('$id', '$token')";
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute()){
                return true;
            }else{
                print('loi'.$stmt->error);
                return false;
            }
        }
        //rigister
        public function Register(){
            $query = "insert into users(fullname, username, password) values(:fullname, :username, :password)";
            $stmt = $this->conn->prepare($query);
            $this->fullname = htmlspecialchars(strip_tags($this->fullname));
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $stmt->bindParam(':fullname',$this->fullname);
            $stmt->bindParam(':username',$this->username);
            $stmt->bindParam(':password',$this->password);
            if($stmt->execute()){
                return true;
            }else{
                print('loi'.$stmt->error);
                return false;

            }
            
        }
    }

?>