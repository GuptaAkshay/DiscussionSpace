<?php require ('core/init.php'); ?>

<?php 

    //create topic obj
    $topic = new Topic;
    $user = new User;
    
    //get template & assign vars
    $template = new Template('templates/frontpage.php');

    //Assign vars
    $template->topics = $topic->getAllTopics();
    $template->totalCategories = $topic->getTotalCategories();
    $template->totalTopics = $topic->getTotalTopics();
    $template->totalUsers = $user->getTotalUsers();

    //display templates
    echo $template;
?>