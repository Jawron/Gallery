<?php


class Photo extends Db_object {

    protected static $db_table = "photos";
    protected static $db_table_fields = ['id','photo_title','caption','alt_text','photo_desc','filename','type','size'];
    public $id;
    public $photo_title;
    public $caption;
    public $alt_text;
    public $photo_desc;
    public $filename;
    public $type;
    public $size;
    public $tmp_path;
    public $upload_directory = "images";
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

    //This is passing the $_FILES['uploaded_file'] as an argument

    public function setFile($file) {

        if(empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded here";
            return false;

        }elseif($file['error'] !=0) {

            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;

        } else {


            $this->filename =  basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];


        }



    }

    public function save(){
        if($this->id) {
            $this->update();
        } else {
            if(!empty($this->errors)){
                echo "rerun false";
                return false;
            }

            if(empty($this->filename) || empty($this->tmp_path)){
                $this->errors[] = "The file was not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;

            if(file_exists($target_path)){
                $this->errors[] = " The file {$this->filename} already exists.";
                return false;
            }

            if(move_uploaded_file($this->tmp_path,$target_path)){
                if($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
            } else {
                $this->errors[] = "The folder directory dosen't  have permissions or dosen't exists";
                return false;
            }


        }
    }

    public function picturePath($filename){
        return $this->upload_directory.DS.$filename;
    }

    public function delete_photo(){
        if($this->delete()){
            $target_path = SITE_ROOT.DS.'admin'.DS.$this->picturePath($this->filename);

            return unlink($target_path) ? true : false;

        } else {
            return false;
        }
    }

    public static function showUserImageData($photo_id){
        $photo = Photo::findById($photo_id);

        $output = "<a class='thumbnail' href=''><img width='100' src='".$photo->picturePath($photo->filename)."'></a>";
        $output .= "<p>{$photo->filename}</p>";

        echo $output;
    }




}

