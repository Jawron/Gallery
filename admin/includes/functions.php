<?php


function __autoload($class){

    $path = "includes/{$class}.php";

    if(file_exists($path)){
        include($path);
    } else {
        die("this file name $class.php was not found");
    }

}





















?>