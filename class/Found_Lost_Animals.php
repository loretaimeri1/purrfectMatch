<?php
namespace Class;
use \PDO, \PDOException;
use Class\UploadPhoto;
require_once 'Database.php';

class Found_Lost_Animals extends Database {
    use UploadPhoto;
    
    protected static $db_table = "found_lost_animals";
    protected static $db_tables_fields = array('userid', 'description', 'location', 'photo', 'reported_at', 'status');
    protected $id;
    protected $userid;
    protected $description;
    protected $location;
    protected $status; 
    protected $photo;
    protected $photoImage;
    protected $reported_at;

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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function getPhotoImage()
    {
        return $this->photoImage;
    }

    public function setPhotoImage($photoImage)
    {
        $this->photoImage = $photoImage;
    }

    public function getReportedAt()
    {
        return $this->reported_at;
    }

    public function setReportedAt($reported_at=null)
    {
        $this->reported_at = $reported_at ?? date('Y-m-d H:i:s');
    }

    public function getStatusLabel() {
        if ($this->status == 'L') {
            return 'Lost';
        } elseif ($this->status == 'F') {
            return 'Found';
        }
        return 'Unknown'; 
    }

    public function create() {
        try {
            if (isset($this->photoImage)) {
                $this->startupLoad($this->photoImage);
                $this->photo = $this->filename;
                $isFileUploaded = $this->uploadFile();
                
                if ($isFileUploaded) {
                    parent::create();
                } else {
                    foreach ($this->errors as $error) {
                        echo $error . "<br>";
                    }
                }
            } else {
                parent::create();
            }
        } catch (Exception $e) {
            echo "Could not create found/lost animal record: " . $e->getMessage();
        }
    }

    public function update() {
        try {
            if (isset($this->photoImage)) {
                $this->uploadfile = $this->src . $this->photo;
                if (!!$this->photo) {
                    unlink($this->uploadfile);
                }

                $this->startupLoad($this->photoImage);
                $this->photo = $this->filename;
                $isFileUploaded = $this->uploadFile();

                if ($isFileUploaded) {
                    parent::update();
                } else {
                    foreach ($this->errors as $error) {
                        echo $error . "<br>";
                    }
                }
            } else {
                parent::update();
            }
        } catch (Exception $e) {
            echo "Could not update found/lost animal record: " . $e->getMessage();
        }
    }
}
