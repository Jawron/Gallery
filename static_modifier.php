<?php echo file_get_contents('html/head.html');?>

<?php

class Cars{

    static $wheel_count = 4;
    static $door_count = 4;


    static function car_detail(){
        echo Cars::$wheel_count;
        echo Cars::$door_count;
    }
}


$bmw = new Cars();
echo Cars::$door_count;

echo Cars::car_detail();

/*
 * Proprietatile statice se pot accesa fara sa instantiezi o clasa.
 * Proprietatile statice se vor accsesa cu numele clasei apoi urmate  de :: si numele proprietati care va avea $ in fatza.
 * Celalalte se pot accesa fara $ in fatza dar o clasa trebuie instantiata.
 * Methodele statice functioneaza la fel, dar in lock de keywordul $this se va folosi numele clasei urmat de :: (ca in exemplul de mai sus)
 */


?>


<?php echo file_get_contents('html/footer.html');?>