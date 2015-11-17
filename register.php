<?php require ('core/init.php'); ?>

<?php 

    $topic = new Topic;
    $user  = new User();
    $validate = new Validator();
    

  // if  (isset($_POST['reg'])){ echo 'hello'; }
    
    if (isset($_POST['reg'])){
                
        $data = array();        
        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['username'] = $_POST['username'];
        $data['password'] = md5($_POST['password']);
        $data['cnf_password']=  md5($_POST['cnf_password']);
        $data['about'] = $_POST['about'];
        $data['last_activity'] = date("Y-m-d H:i:s");    
        
        // Required feild array
        
        $feild_array = array('name', 'email', 'username', 'password', 'cnf_password' );
        
        if($validate->isRequired($feild_array)){
            
            if($validate->isValidEmail($data['email'])){
                
                if($validate->passwordMatch($data['password'], $data['cnf_password']) ){
                    
                    if($user->uploadAvatar()){
                        
                        $data['avatar'] = $_FILES['avatar']['name'];                        
                    }
                    else{
                        
                        $data['avatar'] = 'noimage.png';                     
                    }                         

                    if($user->register($data)){
                        
                        redirect('index.php', 'You are registered and can now log in', 'success');
                    }
                    else{
                        
                        redirect('index.php', 'Something went wrong with registration', 'error');
                    }
                }
                else{
                    
                    redirect('register.php', "Your passwords didn't match", 'error');
                }
            }
            else{
                redirect('register.php', 'Please fill a valid email address', 'error');
            }
        }
        else{
            redirect('register.php', 'Please fill all the required feilds', 'error');
        }                
    }
    else{
        echo '';
    }
    //get template & assign vars
    $template = new Template('templates/register.php');


    //display templates
    echo $template;
?>
