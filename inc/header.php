header.php
<?php 
require "autoloader.php";
use Class\Session;
$session=new Session();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="js/fonta.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="css/style.css" rel="stylesheet" />
        <title>PetAdoption</title>

        
</head>

<body data-spy="scroll" data-target=".navbar">


  <!-- navbar -->
  <nav class="navbar navbar-expand-sm  navbar-dark fixed-top">
    <div class="container">
      <a href="index.php" class="navbar-brand">PurrfectMatch <i class="fa-solid fa-paw"></i></a>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarnav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="navbarnav" class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a href="pets.php" class="nav-link">Pets</a>
          </li>
          <li class="nav-item">
            <a href="how_to_adopt.php" class="nav-link">How to Adopt</a>
          </li>
          <li class="nav-item">
            <a href="donate.php" class="nav-link">Donate</a>
          </li>
          <li class="nav-item">
            <a href="report_lost_animal.php" class="nav-link">Report lost animal</a>
          </li>
          <li class="nav-item">
            <a href="report_found_animal.php" class="nav-link">Report found animal</a>
          </li>
          <li class="nav-item">
            <a href="reports.php" class="nav-link">Reports</a>
          </li>
          <li class="nav-item ms-5 pt-1">
            
            <?php 
             if (!$session->isSignedIn()) {
              echo "<a  href='login.php' class='nav-link'><i class='fa-solid fa-user'></i></a>";}
              else{
                echo "<a data-bs-toggle='collapse' href='#seeProfile' class='nav-link'><i class='fa-solid fa-user'></i></a>";}
            ?>  
            <div class="collapse position-absolute p-4" style="background:var(--pink);" id="seeProfile"> 
              <a href='profile.php' class='nav-link'>Profile<i class="fa-solid fa-pen-to-square"></i></a>
              <a href='logout.php' class='nav-link'>Log out<i class="fa-solid fa-right-from-bracket"></i></i></a>
            </div>   
          </li>
         
        </ul>
        </div>
    </div>
  </nav>

  
 
  