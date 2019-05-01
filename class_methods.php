<?php echo file_get_contents('html/head.html');?>

<?php

class Cars{
    function greeting(){

    }
}



$the_methods = get_class_methods("Cars");


foreach ($the_methods as $method){
    echo "<p>$method</p>";
}






















?>


<?php echo file_get_contents('html/footer.html');?>