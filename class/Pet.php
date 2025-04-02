Pet.php
<?php
namespace Class;
use \PDO, \PDOException;
use Class\UploadPhoto;
require_once 'Database.php';

class Pet extends Database{
    use UploadPhoto;
    protected static $db_table="pets";
    protected static $db_tables_fields=array('name','title','description','adoption_fee','image','age','gender','specieid','location','address');
    protected $id;
    protected $specieid;
    protected $title;
    protected $description;
    protected $adoption_fee;
    protected $image;
    protected $photoImage;
    protected $age;
    protected $gender;
    protected $address;
    protected $location;
    protected $name;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }
    
    public function getSpecieId()
    {
        return $this->specieid;
    }

    public function setSpecieId($specieid)
    {
        $this->specieid = $specieid;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getAdoptionFee()
    {
        return $this->adoption_fee;
    }

    public function setAdoptionFee($adoption_fee)
    {
        $this->adoption_fee = $adoption_fee;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
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