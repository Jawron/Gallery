<?php echo file_get_contents('html/head.html');?>

<?php

class Cars{

    public $wheel_count = 4;


    function __construct(){
        echo $this->wheel_count;

    }
}


$bmw = new Cars();

echo $bmw->wheel_count;
//echo $bmw->door_count;
//echo $bmw->seat_count;











//



?>


<?php echo file_get_contents('html/footer.html');?>