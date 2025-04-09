<?php include "inc/header.php";
?>

  <div class="home">
    <?php
    use Class\Favorites;
    if (!empty($session->message)) {
      echo "<h5 class='bg-light p-3'>{$session->message}</h5>";
    }
  
    if(isset($_POST['addToWishlist'])){
      if(isset($_POST['petId'])){
        if(isset($_SESSION['userId'])){
          $petId = $_POST['petId'];
          $userId = $_SESSION['userId'];

          $favorites = new Favorites();
          $favorites->setUserId($userId);

          $favorites->setPetId($petId);
          if (empty($favorites->find_id_unique($userId, $petId))) {
            $favorites->create();
            header("Location:favorites.php");
          } else {
            $session->message("This pet is already in your favorites.");
            header("Location:pets.php");

          }
        } 
        else{
          header("Location:login.php?error=loginrequired");
        }
      }
    }
    
   
    ?>
    <div class="container mb-5">
        <div id="info">
          <h1 class="display-4 text-center">Find your new best friend! <i class="fa-solid fa-hand-holding-heart"></i></h1>
        </div>
    </div>
                    
    <section id="view-pets">
    <div class="container">
      <div class="row">
        <div class="col-3 border border-dark align-self-top p-3 me-3 ">
          <h1 class="fw-bold ">Filters</h1>
          <p class="fw-bold">
            Species
            <a class="btn btn-dark ms-5" data-bs-toggle="collapse" href="#seeSpecies" role="button" 
            aria-expanded="false" aria-controls="collapseExample"><i class="fa-solid fa-chevron-down"></i></a>
          </p>
          <div class="collapse mb-5" id="seeSpecies"> 
            <div class="card card-body">
              <form method="POST">
              <?php
              use Class\Specie;
              $specie = new Specie();
              $species = $specie->find_all();
              foreach ($species as $specie) {
                echo '<div class="form-check">';
                    echo '<input class="form-check-input" type="radio" name="speciesFilter" id="'.$specie->getName().'Radio" value="'.$specie->getId().'">';
                    echo '<label class="form-check-label mb-4" for="'.$specie->getName().'Radio">'.$specie->getName().'</label>';
                echo '</div>';  
              }
              ?>
                <button type="submit" name="filterBySpecie" class="btn btn-dark" >Apply Filter</button>
              </form>
              
            </div>
          </div>

          <p class="fw-bold">
            Gender
            <a class="btn btn-dark ms-5" data-bs-toggle="collapse" href="#seeGender" role="button" 
            aria-expanded="false" aria-controls="collapseExample"><i class="fa-solid fa-chevron-down"></i></a>
          </p>
          <div class="collapse mb-5" id="seeGender"> 
            <div class="card card-body">
              <form method="POST">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="genderFilter" id="femaleRadio" value="F">
                  <label class="form-check-label mb-4" for="femaleRadio">Female</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="genderFilter" id="maleRadio" value="M">
                  <label class="form-check-label mb-4" for="maleRadio">Male</label>
                </div>
                <button type="submit" name="filterByGender" class="btn btn-dark" >Apply Filter</button>
              </form>
            </div>
          </div>          
          
        </div>


        <div class="col border border-dark align-self-center p-3 ">
        
          <div class="d-flex flex-wrap justify-content-between">
          <?php
          use Class\Pet;

          $pet = new Pet();
          $pets = $pet->find_all();
          if(isset($_POST['filterBySpecie']) || isset($_GET['speciesFilter']) ){
            if(isset($_POST['speciesFilter'])){
                $speciesFilter = $_POST['speciesFilter'];
            } 
            else if(isset($_GET['speciesFilter'])){
              $speciesFilter = $_GET['speciesFilter'];
            } 
            $pets=$pet->find_specie($speciesFilter);
          }
          if(isset($_POST['filterByGender'])){
            if(isset($_POST['genderFilter'])){
                $genderFilter = $_POST['genderFilter'];
                $pets=$pet->find_gender($genderFilter);
            }
          }
          if(isset($_POST['filterByGender']) && isset($_POST['filterBySpecie'])){
            if(isset($_POST['genderFilter']) && isset($_POST['genderFilter'])){
                $genderFilter = $_POST['genderFilter'];
                $speciesFilter = $_POST['speciesFilter'];
                $pets=$pet->find_gender_species($genderFilter, $speciesFilter);
            }
          }
          foreach ($pets as $pet) {
            echo "<form action='' method='POST'>";
            echo "<a href='view_pet.php?id=".$pet->getId()."' class='card my-5' style='width:18rem'>";
            echo "<img class='card-img' src='images/".$pet->getImage()."' alt='' style='width:100%; height:280px'>";
            echo "<input type='hidden' name='petId' value='".$pet->getId()."'>";
            echo "<button type='submit' id='addToWishlist' name='addToWishlist'><i class='fa-solid fa-heart'></i></button>";
            echo "<div class='card-body'>";
            echo "<h4 class='card-title fw-bold'>".$pet->getName()."</h4>";
            echo "<p class='card-text fw-bold'>".$pet->getDescription()."</p>";
            echo "<p class='card-text'><i class='fa-solid fa-location-dot'></i> ".$pet->getLocation().", ".$pet->getAddress()."</p>";
            echo "</div>";
            echo "</a>";
            echo "</form>";
          }
          ?>
         
          </div>
        

        </div>

      </div>
     
    </div>
  </section>
  

  

</div>


<?php include "inc/footer.php";?>