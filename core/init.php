<?php 
    
    //Start Session
    session_start();

    //Include Configuration
    require_once('config/config.php');

    //helper functions
    require_once('helpers/system_helper.php');
    require_once('helpers/format_helper.php');
    require_once('helpers/db_helper.php');

    //auto Load classes
    function __autoload($class_name){
        require_once('libraries/'.$class_name.'.php');
    }
?>