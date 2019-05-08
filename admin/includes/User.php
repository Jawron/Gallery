<?php


class User {
    protected static $db_table = "users";
    protected static $db_table_fields = ['username','password','first_name','last_name'];
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

    protected function properties() {
        //return get_object_vars($this);
        $properties = [];

        foreach (self::$db_table_fields as $db_field){
            if(property_exists($this,$db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;

    }

    protected function cleanProperties(){
        global $database;

        $clean_properties = [];

        foreach ($this->properties() as $key => $value){
            $clean_properties[$key] = $database->escapeString($value);
        }
        return $clean_properties;
    }


    public function verifyUser($username, $password){
        global $database;

        $username = $database->escapeString($username);
        $password = $database->escapeString($password);

        $sql = "SELECT * FROM users WHERE ";
        $sql .= "username = '$username' ";
        $sql .= "AND password = '$password' ";
        $sql .= "LIMIT 1";

        $result = self::findThisQuery("$sql");

        if(!empty($result)){
            $first_item = array_shift($result);
            return $first_item;
        } else {
            return false;
        }

    }

    public function save(){
        return isset($this->id) ? $this->update(): $this->create() ;
    }

    public function create() {
        global $database;

        $properties = $this->cleanProperties();

        $sql = "INSERT INTO " .self::$db_table." (". implode(',', array_keys($properties))  .") ";
        $sql .= "VALUES ('". implode("','", array_values($properties))  ."')";

        if($database->query($sql)){
            $this->id = $database->theInsertId();
            return true;
        } else {
            return false;
        }

    }

    public function update(){
        global $database;



        $properties = $this->cleanProperties();

        $properties_pairs = [];

        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key} = '{$value}' ";
        }

        $sql = "UPDATE " .self::$db_table." SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id = {$database->escapeString($this->id)} ";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false ;
    }

    public function delete(){
        global $database;
        $sql = "DELETE FROM " .self::$db_table." WHERE id = {$database->escapeString($this->id)} LIMIT 1";


        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false ;
    }

} // End of class
