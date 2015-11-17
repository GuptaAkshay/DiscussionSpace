<?php

    //counts number of replies
    function replyCount($topic_id){
        
        $db = new Database();
        $db->query("SELECT * FROM replies WHERE topic_id = :topic_id");
        $db->bind(':topic_id', $topic_id);
        
        $row = $db->resultset();
        $count = $db->rowCount();
        echo $count; 
        return $count;
    }

    //get categories
    function getcategories(){
        $db = new Database();
        $db->query("SELECT * FROM categories");
        
        $result= $db->resultset();
        
        return $result;
    }
    
     function userPostCount($user_id){
        $db = new Database(); 
        $db->query("SELECT * FROM topics WHERE user_id = :id");
        $db->bind(':id', $user_id);
        $result = $db->resultset();
        $topic_count = $db->rowCount();
        
        $db->query("SELECT * FROM replies WHERE user_id = :id");
        $db->bind(':id', $user_id);
        $result = $db->resultset();
        $reply_count = $db->rowCount();
        
        return $topic_count + $reply_count;
    }

    // count the total topics and 
    function topicCount($category_id){
        
        if($category_id == null){
            
            $topicCount = new Topic();
            return $topicCount->getTotalTopics();
        }
        else{
            
            $db = new Database();
            $db->query("SELECT * FROM topics WHERE category_id = :category_id");
            $db->bind(':category_id', $category_id);

            $row = $db->resultset();
            $count = $db->rowCount();        
            return $count;
        }
    }
?>