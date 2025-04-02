<?php include "inc/header.php";
use Class\Pet;
use Class\User;
use Class\Adoption;
$pet = new Pet();

if(isset($_GET['id'])){
    $petid =  $_GET['id'];
    $pet = $pet->find_id($petid);
}

$user = new User();
$adoption = new Adoption();
if(isset($_SESSION['userId'])){
    $userId =  $_SESSION['userId'];
    $user = $user->find_id($userId);
    if(isset($_POST['adopt'])){
      $adoption->setUserId($userId);
      $adoption->setPetId($petid);
      $adoption->setAdoptDate(date('Y-m-d'));
      $adoption->create();
      header("Location:pets.php");
  }
}
?>

<section class="gradient-form">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <h4 class="mt-1 mb-5 p-2" style="background: var(--lightpink)">Adopt <?php echo $pet->getName();?></h4>
                </div>

                <form method="POST">
                    <p class="fw-bold text-center">Fill in your information</p>
                    <div class="form-outline mb-4">
                        <input type="name" id="name" name="firstname" class="form-control" value="<?php echo $user->getFirstName();?>" placeholder="Name" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo $user->getLastName();?>" placeholder="Lastname" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="email" name="email" class="form-control" value="<?php echo $user->getEmail();?>" placeholder="Email address" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="address" name="address" class="form-control" value="<?php echo $user->getAddress();?>" placeholder="Address" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $user->getPhone();?>" placeholder="Phone Number" />
                    </div>
                    <div class="d-flex align-items-center justify-content-center pb-3">
                        <button type="submit" name="adopt" class="btn btn-outline-dark">Adopt</button>
                    </div>
                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient">
              <div class="text-black py-4 p-5">
                <h4 class="mb-4 text-center">Give this pet a home!</h4>
                <p class="text-center mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                  exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>

<div class="container">
            <div class="row">
                <div class="col align-self-top p-3 me-3 ">
                    <img class='card-img' src='images/<?php echo $pet->getImage()?>' alt='' style='width:100%;'>                
                </div>


                <div class="col border border-black align-self-center text-center p-3 ">
                     <h2 class="fw-bold"><?php echo $pet->getTitle();?></h2>
                    <p class='card-text'><?php echo $pet->getLocation().", ". $pet->getAddress()?></p>
                </div>
                
            </div>
        
        </div>
<?php include "inc/footer.php";?>