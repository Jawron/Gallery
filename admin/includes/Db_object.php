<?php

class Db_object {

    public $errors = [];
    public $upload_errors_array = [
        UPLOAD_ERR_OK => 'There is no error',
        UPLOAD_ERR_INI_SIZE => 'Bigger than the upload_max_filesize directive',
        UPLOAD_ERR_FORM_SIZE => 'The upload exceeds the MAX_FILE_SIZE',
        UPLOAD_ERR_PARTIAL => 'The upload file was only partially uploaded',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary directory.',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write on disk',
        UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload'
    ];


    public static function findAll(){
        return static::findByQuery("SELECT * FROM " .static::$db_table . " ");
    }

    public static function findById($id){
        $result = static::findByQuery("SELECT * FROM " .static::$db_table . " WHERE id = $id ");

        if(!empty($result)){
            $first_item = array_shift($result);
            return $first_item;
        } else {
            return false;
        }

    }


    public static function findByQuery($sql){
        global $database;

        $result = $database->query($sql);
        $the_object_array = [];
        while($row = mysqli_fetch_array($result)){
            $the_object_array[] = static::instatiation($row);
        }

        return $the_object_array;
    }

    private function hasTheAtribute($property){

        $object_properties = get_object_vars($this);

        return array_key_exists($property,$object_properties);
    }

    public static function instatiation($record){

        $calling_class= get_called_class();

        $object = new $calling_class;//instead of calling the db_object class will call the
        // Users class because the Users class is calling this function by extending it

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



    protected function properties() {
        //return get_object_vars($this);
        $properties = [];

        foreach (static::$db_table_fields as $db_field){
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


    public function save(){
        return isset($this->id) ? $this->update(): $this->create() ;
    }

    public function create() {
        global $database;

        $properties = $this->cleanProperties();

        $sql = "INSERT INTO " .static::$db_table." (". implode(',', array_keys($properties))  .") ";
        $sql .= " VALUES ('". implode("\',\'", array_values($properties))  ."')";

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

        $sql = "UPDATE " .static::$db_table." SET ";
        $sql .= implode(', ', $properties_pairs);
        $sql .= " WHERE id = {$database->escapeString($this->id)} ";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false ;
    }

    public function delete(){
        global $database;
        $sql = "DELETE FROM " . static::$db_table ." WHERE id = {$database->escapeString($this->id)} LIMIT 1";


        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false ;
    }


    public function setFile($file){
        // this function works with save user - user_image is a property
        // from the User class
        if(empty($file) || !$file || !is_array($file)){
            $this->errors = "There is no upload here";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->user_image = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];

        }

    }
}