<?php
namespace Class;
use \PDO, \PDOException;
use Class\UploadPhoto;
require_once 'Database.php';

class Donation extends Database{
    protected static $db_table="donation";
    protected static $db_tables_fields=array('userid','amount');
    protected $id;
    protected $userid;
    protected $amount;
   
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->userid;
    }

    public function setUserId($userid)
    {
        $this->userid = $userid;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }
    
}
?>