<?php


class User {

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;


    public static function findAllUsers(){
        return self::findThisQuery("SELECT * FROM users");
    }

    public static function findUserById($id){
        $result = self::findThisQuery("SELECT * FROM users WHERE id = $id LIMIT 1");

        if(!empty($result)){
            $first_item = array_shift($result);
            return $first_item;
        } else {
            return false;
        }


        $found_user = mysqli_fetch_array($result);
        return $found_user;
    }

    public static function findThisQuery($sql){
        global $database;

        $result = $database->query($sql);
        $the_object_array = [];
        while($row = mysqli_fetch_array($result)){
            $the_object_array[] = self::instatiation($row);
        }

        return $the_object_array;
    }

    public static function instatiation($record){
        $object = new self;

//        $object->id         = $user_by_id['id'];
//        $object->username   = $user_by_id['username'];
//        $object->password   = $user_by_id['password'];
//        $object->first_name = $user_by_id['first_name'];
//        $object->last_name  = $user_by_id['last_name'];

        foreach ($record as $property => $value){
            if($object->hasTheAtribute($property)){
                $object->$property = $value;
            }
        }

        return $object;
    }

    private function hasTheAtribute($property){

        $object_properties = get_object_vars($this);

        return array_key_exists($property,$object_properties);



    }

}
