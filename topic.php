<?php require ('core/init.php'); ?>

<?php 

    $topic = new Topic;

    $topic_id = $_GET['id'];
    
    if(isset($_POST['do_reply'])){
        
        $validate = new Validator;
        $data = array();
        $data['topic_id'] = $_GET['id'];
        $data['user_id'] = getUser()['user_id'];
        $data['body'] = $_POST['body'];
        
        $field_array = array('body');
        
        if($validate->isRequired($field_array)){
            
            if($topic->reply($data)){
                redirect('topic.php?id='.$topic_id, 'Your reply has been posted', 'success');
            }
            else{
                redirect('topic.php?id='.$topic_id, 'Something went wrong with your reply', 'error');
            }
        }
        else{
            redirect('topic.php?id='.$topic_id, 'Your reply from is empty', 'error');
        }
    }
    //get template & assign vars
    $template = new Template('templates/topic.php');

    //Assign vars
    $template->topic = $topic->getTopic($topic_id);
    $template->replies = $topic->getReplies($topic_id);
    $template->title = $topic->getTopic($topic_id)->title;

    //display templates
    echo $template;
?>