<?php
namespace Class;

class Session{
    private $signedIn = false;
    private $userId;
    public $message;

    public function __construct(){
        session_start();
        echo "<script>console.log('session')</script>";

        $this->checkLogin();
        $this->checkMessage();
    }

    public function isSignedIn(){
        return $this->signedIn;
    }

    public function checkLogin(){
        if(isset($_SESSION['userId'])){
            $this->userId = $_SESSION['userId'];
            $this->signedIn = true;
            echo "<script>console.log('hi')</script>";

        }
        else{
            unset($this->userId);
            $this->signedIn = false;
        }
    }

    public function login($user){
        if($user){
            $this->userId = $user->getId();
            echo "<script>console.log('{$user->getId()}a')</script>";

            echo $user->getId() . "a";
            $_SESSION['userId'] = $user->getId();
            $this->signedIn = true;
            echo "<script>console.log('logged')</script>";
        }
    }

    public function logout(){
        unset($_SESSION['userId']);
        unset($this->userId);
        $this->signedIn = false;
    }

    public function message($msg = ""){
        if(!empty($msg)){
            $this->message = $_SESSION['message'] = $msg;
        }
        else{
            return $this->message;
        }
    }

    public function checkMessage(){
        if(isset($_SESSION['message'])){
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }
        else{
            $this->message="";
        }
    }
}
?>