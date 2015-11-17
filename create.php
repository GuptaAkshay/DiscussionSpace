<?php require ('core/init.php'); ?>

<?php 
    $topic = new Topic();
    
    if(isset($_POST['do_create'])){
        
        $validator = new Validator;
        
        $data = array();
        $data['title'] = $_POST['title'];        
        $data['body'] = $_POST['body'];
        $data['category_id'] = $_POST['category'];
        $data['user_id'] = getUser()['user_id'];
        $data['last_activity'] = date('Y-m-d H:i:s');
        
        $field_array = array('title', 'body', 'category');   
        
        
        if($validator->isRequired($field_array)){            
            if($topic->create($data)){
                redirect('index.php', 'Your topic has been posted', 'success');
            }
            else{
                redirect('topic.php?id='.$topic_id, 'Something went wrong with your post', 'error');
            }
        }
        else{
            redirect('create.php', 'Please fill all the fields', 'error');
        }
    }
    //get template & assign vars
    $template = new Template('templates/create.php');

    //Assign vars
    $template->heading = "template heading";

    //display templates
    echo $template;
?>
