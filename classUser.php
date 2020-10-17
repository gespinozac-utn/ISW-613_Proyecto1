<?php 
    class User{
        //Attributes
        private $id,
        $username,
        $password,
        $role;

        //Contructor
        function __construct($username=null,$password=null,$id=null,$role='Cliente') {
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->role = $role;
        }
        
        //Set methods
        public function set_id($id){
            $this->id = $id;
        }
        public function set_userName($username){
            $this->username = $username;
        }
        public function set_password($password){
            $this->password = $password;
        }
        public function set_role($role){
            $this->role = $role;
        }

        //Get methods
        public function get_id(){
            return $this->id;
        }
        public function get_userName(){
            return $this->username;
        }
        public function get_password(){
            return $this->password;
        }
        public function get_role(){
            return $this->role;
        }
    }
?>