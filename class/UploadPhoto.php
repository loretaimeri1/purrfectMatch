<?php
namespace Class;

trait UploadPhoto{
    public $src = "uploads/";
    public $tmp; 
    public $filename; 
    public $type; 
    public $size; 
    public $uploadfile; 
    public $errors=array();

    public function startupLoad($file){
        $this->filename = $file['name'];
        $this->tmp = $file['tmp_name'];
        $this->size = $file['size'];
        $this->type = $file['type'];
        $this->uploadfile = $this->src . basename($this->filename);
    }

    public function uploadFile(){
        if(isset($this->filename)){
            $file_ext = explode(".", $this->filename);
            $file_ext = end($file_ext);
            $extensions = array("jpeg","png","jpg");
            if(! in_array($file_ext,$extensions)){
                $errors[] = "Extension not allowed please choose a jpeg or png file";
            }

            if($this->size > 2097152){
                $errors[] = "File must be exactly 2MB";
            }

            if(empty($errors)===true){
                move_uploaded_file($this->tmp,$this->uploadfile);
                return true;
            }
            else{
                return false;
            }
        }
    }
}

?>