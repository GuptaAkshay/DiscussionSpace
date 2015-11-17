<?php include('core/init.php'); ?>

<?php 
    if(isset($_POST['do_logout'])){
       
        $user = new User;
        
        if($user->logout()){
             
            redirect('index.php', 'You are logged out now', 'success');
        }
    }
    else{
        redirect('index.php');
    }

?>