<?php


class User extends Db_object {
    protected static $db_table = "users";
    protected static $db_table_fields = ['username','user_image','password','first_name','last_name'];
    public $id;
    public $username;
    public $user_image;
    public $password;
    public $first_name;
    public $last_name;
    public $tmp_path;
    public $errors = [];
    public $upload_directory = "images";
    public $image_placeholder = "https://via.placeholder.com/100&text=image";


    public function imagePlaceholder(){
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
    }
    public function delete_user(){
        if($this->delete()){
            $target_path = SITE_ROOT.DS.'admin'.DS.$this->imagePlaceholder();
            return unlink($target_path) ? true : false;

        } else {
            return false;
        }
    }

    public function verifyUser($username, $password){
        global $database;

        $username = $database->escapeString($username);
        $password = $database->escapeString($password);

        $sql = "SELECT * FROM " .self::$db_table  . " WHERE ";
        $sql .= "username = '$username' ";
        $sql .= "AND password = '$password' ";
        $sql .= "LIMIT 1";

        $result = self::findByQuery("$sql");

        if(!empty($result)){
            $first_item = array_shift($result);
            return $first_item;
        } else {
            return false;
        }

    }


    public function saveImage(){

            if(!empty($this->errors)){
                echo "retun false";
                return false;
            }

            if(empty($this->user_image) || empty($this->tmp_path)){
                $this->errors[] = "The file was not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;

            if(file_exists($target_path)){
                $this->errors[] = " The file {$this->user_image} already exists.";
                return false;
            }

            if(move_uploaded_file($this->tmp_path,$target_path)){

                    unset($this->tmp_path);
                    return true;

            } else {
                $this->errors[] = "The folder directory dosen't  have permissions or dosen't exists";
                return false;
            }



    }



} // End of class
