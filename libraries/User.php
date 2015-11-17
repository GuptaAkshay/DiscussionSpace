<?php
    class User{
        
        private $db;
        
        public function __construct(){
            $this->db = new Database();
        }
        
        public function uploadAvatar(){
            
            $allowedExts = array("gif", "jpeg", "jpg", "png");
            $temp = explode(".", $_FILES['avatar']['name']);
            $extension = end($temp);
            
            if((($_FILES['avatar']['type'] == "image/gif") || ($_FILES['avatar']['type'] == "image/jpeg") || ($_FILES['avatar']['type'] =="image/jpg") 
                || ($_FILES['avatar']['type'] == "image/png")) && in_array ($extension, $allowedExts)) {
                
                    if ($_FILES['avatar']['size'] < 200000){                                                                                                                                    
                            if($_FILES['avatar']['error'] > 0 ){

                                redirect('register.php', $_FILES['avatar']['error'], 'error');                                                      
                            }
                            else{
                                if(file_exists("images/avatars/" . $_FILES['avatar']['name'])) {
                                redirect('register.php', 'Image with same name already exists!', 'error');
                            }
                            else{
                                move_uploaded_file($_FILES['avatar']['tmp_name'], "templates/images/avatars/".$_FILES['avatar']['name']);                        
                                return true;
                            }                    
                        }                                                
                    }
                    else{
                        redirect('register.php', 'File size exceeds required limit!', 'error');        
                    }
            }
            else{ 

                redirect('register.php', 'Invalid File Extension!', 'error');
            }
                    
        }
        public function register($data){
            
            $this->db->query("INSERT INTO users (name, email, username,avatar, password, about, last_activity)
                        VALUES(:name, :email, :username,:avatar, :password, :about, :last_activity)");
                
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':avatar', $data['avatar']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':about', $data['about']);
            $this->db->bind(':last_activity', $data['last_activity']);
            
            if($this->db->execute()){
                return true;
            }
            else{
                return false;
            }
            
        }
        
        public function login($user, $pass){
            
            $this->db->query("SELECT * FROM users WHERE username = :user AND password = :pass");
            
            $this->db->bind(':user', $user);
            $this->db->bind(':pass', $pass);
            
            $row = $this->db->single();
            
            if($this->db->rowCount() > 0){
                $this->setUserData($row);
                return true;
            }
            else{
                return false;
            }
        }
        
     private function setUserData($row){
         $_SESSION['is_logged_in'] = true;
         $_SESSION['user_id'] = $row->id;
         $_SESSION['username'] = $row->username;
         $_SESSION['name'] = $row->name;
     }
    
    public function logout(){
        unset($_SESSION['is_logged_in']);
         unset($_SESSION['user_id']);
         unset($_SESSION['username']);
         unset($_SESSION['name']);
        return true;
    }
        public function getTotalUsers(){
            
            $this->db->query("SELECT * FROM users");
            $row = $this->db->resultset();
            
            $count = $this->db->rowCount();
            
            return $count;
        }
        
        public function getUser($id){
            $this->db->query("SELECT * FROM users WHERE id=:id");
            $this->db->bind(':id', $id);
            
            $row = $this->db->single();
            
            return $row;
        }
    
        
        
    }
        
?>        