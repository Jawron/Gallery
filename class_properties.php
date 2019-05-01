<?php echo file_get_contents('html/head.html');?>

<?php

class Cars{

    public $wheel_count = 4;
    public $door_count = 4;

    function car_detail(){
        return "This car has $this->wheel_count wheels";
    }
}


$bmw = new Cars();
$dacia = new Cars();

echo $bmw->wheel_count = 10; //any value can be changes
echo "<br>";
echo $dacia->wheel_count;
echo "<br>";
echo $bmw->car_detail();
















?>


<?php echo file_get_contents('html/footer.html');?>