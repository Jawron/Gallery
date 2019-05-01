<?php echo file_get_contents('html/head.html');?>

<?php

class Cars{

    public $wheel_count = 4;
    private $door_count = 4;
    protected $seat_count = 4;

    function car_detail(){
        echo $this->wheel_count;
        echo $this->door_count;
        echo $this->seat_count;
    }
}


$bmw = new Cars();

echo $bmw->wheel_count;
//echo $bmw->door_count;
//echo $bmw->seat_count;











//



?>


<?php echo file_get_contents('html/footer.html');?>