<?php echo file_get_contents('html/head.html');?>

<?php

class Cars{

    private $door_count = 4;

    function getValues(){
        echo $this->door_count;
    }

    function setValues(){
        $this->door_count = 10;
    }
}


$bmw = new Cars();

//echo $bmw->door_count;
echo $bmw->setValues();
echo $bmw->getValues();













?>


<?php echo file_get_contents('html/footer.html');?>