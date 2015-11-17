<?php 
    class Topic{
        
        // intialize the db variable
        private $db;
        
        //constructor
        public function __construct(){
            
            $this->db = new Database();
        }
        
        //get all topics
        public function getAllTopics(){
            
            $this->db->query("SELECT topics.*, users.username, users.avatar, categories.name FROM topics
            INNER JOIN users
            ON topics.user_id = users.id
            INNER JOIN categories 
            ON topics.category_id = categories.id
            ORDER BY create_date DESC");
            
            //assign result set
            $result = $this->db->resultset();
            
            return $result;
        }
        
        //get by category
        function getByCategory($category_id){
            $this->db->query("SELECT topics.id, topics.*, categories.*, users.username, users.avatar FROM topics 
            INNER JOIN categories
            ON topics.category_id = categories.id
            INNER JOIN users ON
            topics.user_id = users.id
            WHERE topics.category_id = :category_id");
            
            $this->db->bind(':category_id', $category_id);
            
            $result = $this->db->resultset();
            
            return $result;        
        }
        
        //get total of Categories        
        public function getTotalCategories(){
            
            $this->db->query("SELECT * FROM categories");
            $row = $this->db->resultset();
            
            $count = $this->db->rowCount();
            
            return $count;
        }
        
        
        
        public function getTotalTopics(){
            
            $this->db->query("SELECT * FROM topics");
            $row = $this->db->resultset();
            
            $count = $this->db->rowCount();
            
            return $count;
        }
        
        //get categories by id
        
        function getCategory($category_id){
            $this->db->query("SELECT * FROM categories WHERE id = :category_id");
            $this->db->bind(':category_id', $category_id);
            
            $row = $this->db->single();
            
            return $row;
        }
        
        public function getTotalReplies($topic_id){
            
            $this->db->query("SELECT * FROM replies WHERE topic_id = ".$topic_id);
            $row = $this->db->resultset();
            
            $count = $this->db->rowCount();
            
            return $count;
        }
        
        public function getTopic($id){
            $this->db->query("SELECT topics.*, users.username, users.name, users.avatar FROM topics 
                                INNER JOIN users ON 
                                topics.user_id = users.id 
                                WHERE topics.id = :id" 
            );
            
            $this->db->bind(':id', $id);
            $result = $this->db->single();
            return $result;
        }
        
        public function getReplies($id){
            $this->db->query("SELECT replies.*, users.* FROM replies
                            INNER JOIN users ON 
                            replies.user_id = users.id
                            WHERE replies.topic_id = :id 
                            ORDER BY create_date ASC"
            );
            $this->db->bind(':id', $id);
            $result = $this->db->resultset();
            return $result;
        }
        
        public function getByUsers($user_id){
            
            $this->db->query("SELECT topics.*, categories.*, users.avatar, users.name, users.username FROM topics
                            INNER JOIN categories ON
                            topics.category_id = categories.id
                            INNER JOIN users ON
                            topics.user_id = users.id
                            WHERE topics.user_id = :user_id"
            );
            
            $this->db->bind(':user_id', $user_id);
            
            $result = $this->db->resultset();            
            return $result;
            
            
        }
        
        public function create($data){
            $this->db->query("INSERT INTO topics(category_id, user_id, title, body, last_activity)
            VALUES(:category_id, :user_id, :title, :body, :last_activity)");
            
            $this->db->bind(':category_id', $data['category_id']);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);
            $this->db->bind(':last_activity', $data['last_activity']);
            
            if($this->db->execute()){
                return true;
            }
            else{
                
                return false;
            }
        }
        
        public function reply($data){
            $this->db->query("INSERT INTO replies(topic_id, user_id, body)
            VALUES(:topic_id, :user_id, :body)");
            
            $this->db->bind(':topic_id', $data['topic_id']);
            $this->db->bind(':user_id', $data['user_id']);  
            $this->db->bind(':body', $data['body']);
            
            if($this->db->execute()){
                return true;
            }
            else{
                
                return false;
            }
        }
        
        
    }
?>