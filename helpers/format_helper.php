<?php
    //format date
    function formatDate($date){
        $date = date("F j, Y, g:i a", strtotime($date));
        return $date;
    }
    

    //url format helper
    function urlFormat($str){
        
        // strips out whitespaces
        $str = preg_replace('/\s*/', '', $str); 
        
        //convert Str to lowercase
        
        $str = strtolower($str);
        
        //url encode
        $str = urlencode($str);
        
        return $str;
    }
    
    //is active
    function is_active($category){
        
        if(isset($_GET['category'])){
            if($_GET['category'] == $category){
                return 'active';
            }
            else{
                return '';
            }
            
        }else{
            if($category == null){
                return 'active';
            }
        }
        
    }
?>