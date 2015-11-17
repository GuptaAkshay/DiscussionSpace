<?php require ('core/init.php'); ?>

<?php 
    
    $topic = new Topic();
    $user = new User;

    $category = isset($_GET['category']) ? $_GET['category'] : null;
    $user_id = isset($_GET['user']) ? $_GET['user'] : null;
    

    //get template & assign vars
    $template = new Template('templates/topics.php');

    if(isset($category)){
        $template->topics = $topic->getByCategory($category);
        $template->title = 'Posts In "'.$topic->getCategory($category)->name.'"';
        
    }

    if(isset($user_id)){        
        $template->topics = $topic->getByUsers($user_id);
        $template->title = 'Posts By "'.$user->getUser($user_id)->username.'"';
        
    }

    if(!isset($category) && !isset($user_id)){
        $template->topics = $topic->getAllTopics();
    }

    $template->totalCategories = $topic->getTotalCategories();
    $template->totalTopics = $topic->getTotalTopics();
    $template->totalUsers = $user->getTotalUsers();

    //display templates
    echo $template;
?>