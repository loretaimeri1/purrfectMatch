<?php
namespace Class;
use \PDO, \PDOException;
require_once 'Database.php';

class Favorites extends Database{
    protected static $db_table="favorites";
    protected static $db_tables_fields=array('petid','userid');
    protected $id;
    protected $petid;
    protected $userid;
   
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPetId()
    {
        return $this->petid;
    }

    public function setPetId($petid)
    {
        $this->petid = $petid;
    }

    public function getUserId()
    {
        return $this->userid;
    }

    public function setUserId($userid)
    {
        $this->userid = $userid;
    }

    public function find_id($id){
        $sql="SELECT * FROM ". static::$db_table ." WHERE userid=:id";
        $stmt=$this->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, __NAMESPACE__ . "\\Favorites");
        return $stmt->fetchAll();
    }
}
?>