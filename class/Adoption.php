Adoption.php
<?php
namespace Class;
use \PDO, \PDOException;
require_once 'Database.php';

class Adoption extends Database{
    protected static $db_table="adoption";
    protected static $db_tables_fields=array('petid','userid','adopt_date','description');
    protected $description;
    protected $id;
    protected $petid;
    protected $userid;
    protected $adopt_date;
   
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

    public function getAdoptDate()
    {
        return $this->adopt_date;
    }

    public function setAdoptDate($adopt_date)
    {
        $this->adopt_date = $adopt_date;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
?>