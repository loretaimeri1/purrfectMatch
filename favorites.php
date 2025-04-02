<?php include "inc/header.php";
?>

  <div class="home">
  
    <div class="container mb-5">
        <div id="info">
          <h1 class="display-4 text-center">Wishlist <i class="fa-solid fa-hand-holding-heart"></i></h1>
        </div>
    </div>
                    
    <section id="view-pets">
    <div class="container">
    
        <div class="col border border-dark align-self-center p-3 ">
        
          <div class="d-flex flex-wrap justify-content-between">
          <?php
          use Class\Favorites;
          use Class\Pet;

          $favorites = new Favorites();
          $favorite = $favorites->find_id($_SESSION['userId']);
          $pet = new Pet();
          foreach ($favorite as $f) {
            $pet = $pet->find_id($f->getPetId());
            echo "<form action='' method='POST'>";
            echo "<a href='view_pet.php?id=".$pet->getId()."' class='card my-5' style='width:18rem'>";
            echo "<img class='card-img' src='images/".$pet->getImage()."' alt='' style='width:100%; height:280px'>";
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
  </section>
  

  

</div>


<?php include "inc/footer.php";?>