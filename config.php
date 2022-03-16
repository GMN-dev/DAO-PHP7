<?php

spl_autoload_register(function($className){
    $fileName =  "Classes".DIRECTORY_SEPARATOR."$className.php";

    if (file_exists($fileName)){
        require_once($fileName);
    }
    else{
        echo "<< ERROR >> <br> File does not exist.";
    }
});


?>