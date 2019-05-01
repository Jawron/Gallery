<?php echo file_get_contents('html/head.html');?>

<?php

class Cars{

    public $wheels_count;

    function greeting(){
        echo "Hello !!!!";
    }
}

$bmw = new Cars();


class Truck extends Cars {

}

$tacoma = new Truck();

$tacoma->greeting();








?>


<?php echo file_get_contents('html/footer.html');?>