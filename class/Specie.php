<?php
namespace Class;
use \PDO, \PDOException;
use Class\UploadPhoto;
require_once 'Database.php';

class Specie extends Database{
    protected static $db_table="species";
    protected static $db_tables_fields=array('name');
    protected $id;
    protected $name;
    
   
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
?>