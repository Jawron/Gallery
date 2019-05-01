<?php echo file_get_contents('html/head.html');?>

<?php

class Cars{

    static $wheel_count = 4;
    static $door_count = 4;


    static function car_detail(){
        return self::$wheel_count;
        return self::$door_count;
    }
}

class Truck extends Cars{

    static function display(){
        echo parent::car_detail();
    }

}

echo Truck::display();

/*
 * Alta metoda prin care se pot folosi methodele si proprietatile statice este cu "self" in interiorul clasei propri sau
 * cu "parent" daca clasa este extinsa de o clasa copil
 */
?>


<?php echo file_get_contents('html/footer.html');?>