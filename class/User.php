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
    
}
?>