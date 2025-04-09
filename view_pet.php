<?php include "inc/header.php";
use Class\Pet;
use Class\Favorites;

$pet = new Pet();

if(isset($_GET['id'])){
    $id =  $_GET['id'];
    $pet = $pet->find_id($id);
}

if(isset($_POST['addToWishlist'])){
    if(isset($_GET['id'])){
      if(isset($_SESSION['userId'])){
        $petId = $_GET['id'];
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

  <div class="home">
  
    <div class="container mb-5 p-3" style="background:var(--grey)">
        <div>
          <h1 class="display-5 mb-5 fw-bold"><?php echo $pet->getName();?></h1>
          <h3><?php echo $pet->getTitle();?></h3>
        </div>
    </div>
                  
    <section id="view-pet">
        <div class="container">
            <div class="row">
                <div class="col align-self-top p-3 me-3 ">
                    <img class='card-img' src='images/<?php echo $pet->getImage()?>' alt='' style='width:100%;'>                
                </div>


                <div class="col border align-self-center  text-center p-3 ">
                     <h2 class="fw-bold">About <?php echo $pet->getName();?></h2>
                    <p class='card-text fw-bold'><?php echo $pet->getDescription()?></p>
                    <p class='card-text'><?php echo $pet->getLocation().", ". $pet->getAddress()?></p>
                    <form method="POST">
                        <div class="row">
                            <div class="col d-flex justify-content-end align-items-center"><a class="btn btn-dark text-white fw-bold text-center p-2" href="adopt.php?id=<?php echo $pet->getId()?>">Adopt Now</a></div>
                            <div class="col d-flex justify-content-start align-items-center""><button type='submit' id='addToWishlist1' name='addToWishlist'><i class='fa-solid fa-heart'></i></button></div>
                        </div>
                    </form>
                </div>
                
            </div>
        
        </div>
  </section>
  

  

  

</div>


<?php include "inc/footer.php";?>