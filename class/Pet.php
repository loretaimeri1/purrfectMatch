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

    public function find_specie($specieid){
        $sql="SELECT * FROM ". static::$db_table ." WHERE specieid=:specieid";
        $stmt=$this->prepare($sql);
        $stmt->bindParam(':specieid',$specieid);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, __NAMESPACE__ . "\\Pet");
        return $stmt->fetchAll();
    }

    public function find_gender($gender){
        $sql="SELECT * FROM ". static::$db_table ." WHERE gender=:gender";
        $stmt=$this->prepare($sql);
        $stmt->bindParam(':gender',$gender);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, __NAMESPACE__ . "\\Pet");
        return $stmt->fetchAll();
    }

    public function find_gender_species($gender,$specieid){
        $sql="SELECT * FROM ". static::$db_table ." WHERE gender=:gender AND specieid=:specieid";
        $stmt=$this->prepare($sql);
        $stmt->bindParam(':gender',$gender);
        $stmt->bindParam(':specieid',$specieid);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, __NAMESPACE__ . "\\Pet");
        return $stmt->fetchAll();
    }

    public function create(){
        try{
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
        catch(Exception $e){
            echo "Pet could not be added" . $e->getMessage();
        }
    }

    public function update(){
        try {
           if(isset($this->photoImage)){
            $this->uploadfile = $this->src . $this->image;
            if(!!$this->uploadfile){
                unlink($this->uploadfile);
            }
            $this->startupLoad($this->photoImage);
            $this->image = $this->filename;
            $isFileUploaded = $this->uploadFile();
            if($isFileUploaded){
                if(parent::update()){
                    return true;
                }
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
            echo "Pet could not be modified" . $e->getMessage();
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
            echo "Pet could not be deleted" . $e->getMessage();
        }
    }
}
?>