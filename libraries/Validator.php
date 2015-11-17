<?php

    class Validator{
     
        /* valididating Required Feilds */    
        public function isRequired($field_array){
            
            foreach($field_array as $field){
                
                if($_POST[''.$field.''] == ''){
                    
                    return false;
                }
            }
            return true;
        }
        
        /* valididating Email */    
        public function isValidEmail($email){
            
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                
                return true;
            }
            else{
                
                return false;            
            }
        }
        
        /* password matching*/    
        public function passwordMatch($pwd1, $pwd2){
            
            if(pwd1 == pwd2){
                
                return true;
            }
            else{
                
                return false;
            }
        }
    }
?>