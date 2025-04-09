<?php
namespace Class;
use Exception, PDO,PDOException,ReflectionClass;

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "pet_adoption2");

Class Database{
    protected static $db_table;
    protected static $db_tables_fields;
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

 
    public function __construct(){
        $this->connectDB();
    }

    private function connectDB(){
        try{
            $dsn = "mysql:host=".$this->host.";dbname=".$this->dbname;
            $pdo = new PDO($dsn,$this->user,$this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
        catch(Throwable $e){
            echo "Connection to database failed " . $e->getMessage();
        }
    }

    public function prepare($sql){
        return $this->connectDB()->prepare($sql);
    }

    public function getClassName(){
        $class_name =  new ReflectionClass($this);
        return $class_name = ucfirst($class_name->getShortName());
    }

    protected function properties(){
        $properties=array();
        foreach (static::$db_tables_fields as $db_field) {
            if (property_exists($this, $db_field) && $this->$db_field !== null) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    public function find_all(){
        $sql="SELECT * FROM " . static::$db_table;
        $stmt=$this->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, __NAMESPACE__ . "\\{$this->getClassName()}");
        return $stmt->fetchAll();   
    }

    public function find_id($id){
        $sql="SELECT * FROM ". static::$db_table ." WHERE id=:id";
        $stmt=$this->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, __NAMESPACE__ . "\\{$this->getClassName()}");
        return $stmt->fetch();
    }
    
    public function create(){
        try {
            $properties=$this->properties();
            $sql="INSERT INTO " . static::$db_table . "(" . implode(",",array_keys($properties)) .")";
            $sql.="VALUES ('" . implode("','", array_values($properties)) . "')";
            $stmt=$this->prepare($sql);
            $stmt->execute();
            $_SESSION['message'] = "{$this->getClassName()} added successfully";

        }
        catch (PDOException $e) {
            die("Error during the registration proccess" . $e->getMessage());
        }
    }

    public function update(){
        try {
            $properties = $this->properties();
            $properties_pair = array();
            foreach ($properties as $key => $value) {
                $properties_pair[]="{$key}='{$value}'";
            }
            $sql = "UPDATE ". static::$db_table . " SET ";
            $sql .= implode(", ", $properties_pair);
            $sql .= " WHERE id=:id";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(':id',$this->id);
            $stmt->execute();
            $_SESSION['message'] = "{$this->getClassName()} modified successfully";
        }
        catch (PDOException $e) {
            die("Error during the modification proccess" . $e->getMessage());
        }  
    }

    public function delete(){
        try {
            $sql="DELETE FROM " . static::$db_table ." WHERE id=:id";
            $stmt=$this->prepare($sql);
            $stmt->bindParam(':id',$this->id, PDO::PARAM_INT);
            $stmt->execute();
            $_SESSION['message'] = "{$this->getClassName()} deleted successfully";
        }
        catch (PDOException $e) {
            if ($e->errorInfo[1] == 1451) {
                $_SESSION['message'] = "Cannot delete {$this->getClassName()} because it is referenced by other data.";
            } else {
                $_SESSION['message'] = "Error during the deletion process: " . $e->getMessage();
            }
        }   
    }



}
?>