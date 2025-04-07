<?php
namespace Class;
use \PDO, \PDOException;
require_once 'Database.php';
use Class\UploadPhoto;

class User extends Database{
    use UploadPhoto;
    protected static $db_table="users";
    protected static $db_tables_fields=array('firstname','lastname','phone','email','password','photo','address','role','image');
    protected $id;
    protected $firstname;
    protected $lastname;
    protected $phone;
    protected $email;
    protected $address;
    protected $role;   
    protected $password;
    protected $image; 
    protected $photoImage;

   
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFirstName()
    {
        return $this->firstname;
    }

    public function setFirstName($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    public function setLastName($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getPhotoImage()
    {
        return $this->photoImage;
    }

    public function setPhotoImage($photoImage)
    {
        $this->photoImage = $photoImage;
    }
    
    public function create(){ 
        try{
            if(isset($this->photoImage)){
                $this->startupLoad($this->photoImage);
                $this->image = $this->filename;
                $isFileUploaded = $this->uploadFile(); 
                if($isFileUploaded){
                    parent::create();
                }
                else{
                    foreach($this->errors as $error){
                        echo $error . "<br>";
                    }
                }
            }
            else{
                parent::create();
            }
        }
        catch(Exception $e){
            echo "Could not create user " . $e->getMessage();
        }
    }

    public function update(){
        try {
           if(isset($this->photoImage)){
            $this->uploadfile = $this->src . $this->image;
            if(!!$this->image){
                unlink($this->uploadfile);
            }
            $this->startupLoad($this->photoImage);
            $this->image = $this->filename;
            $isFileUploaded = $this->uploadFile();
            if($isFileUploaded){
                parent::update();          
            }
            else{
                foreach($this->errors as $error){
                    echo $error . "<br>";
                }
            }
           }
           else{
                if(parent::update()){
                    return true;
                }
            }
        }
        catch(Exception $e){
            echo "Could not update user " . $e->getMessage();
        } 
    }

    public function delete(){
        try{
            if(parent::delete()){
                $this->uploadfile = $this->src . $this->image;
                if(file_exists($this->uploadfile)){
                    unlink($this->uploadfile); 
                }
                return true;
            }
            else{
                return false; 
            }
        }
        catch(Exception $e){
            echo "Could not delete user " . $e->getMessage();
        }
    }

    public function verifyUser($email, $password)
    {
        $sql = "SELECT * FROM users";
        $sql .= " WHERE email=:email AND password=:password";
        $result = $this->prepare($sql);
        $result->bindParam(':email', $email);
        $result->bindParam(':password', $password);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS, __NAMESPACE__ . "\\{$this->getClassName()}");
        return $result->fetch();
    }
}
?>