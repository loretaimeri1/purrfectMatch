<?php include "inc/header.php";
?>

<section class="mt-5 mb-5">
<div class="container py-5">
  <div class="row d-flex justify-content-center align-items-center">
  <?php
    if (!empty($session->message)) {
    echo "<h5 class='bg-light p-3'>{$session->message}</h5>";
    }
  ?>
    <div class="col-xl-10 mb-5 ">
      <div class="card rounded-3 text-black">
        <div class="row g-0">
            <div class="col-lg-6">
            <div class="card-body  mx-md-4">

                <div class="text-center py-5">
                  <h4 class="mb-2 p-2" style="background: var(--lightpink)">Profile</h4>
                </div>

                <?php 
                use Class\User;
                

                if ($session->isSignedIn()) {
                    $user = new User();
                    $user = $user->find_id($_SESSION['userId']);

                    if(isset($_POST['edit'])){
                      $user->setFirstname($_POST['firstname']);
                      $user->setLastname($_POST['lastname']);
                      $user->setPhone($_POST['phone']);
                      $user->setAddress($_POST['address']);
                      $user->setEmail($_POST['email']);
                      $user->setPassword($_POST['password']);
                      if($_FILES['image']['size']>0){
                          $user->setPhotoImage($_FILES['image']);
                      }
                      $user->update();           

                  }
                }
                ?>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-outline mb-4 d-flex justify-content-center">
                        <img class="col-lg-6 d-flex align-self-center" style="border-radius: 100%" src='../uploads/<?php echo $user->getImage();?>'>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="file" id="image" name="image" class="form-control" placeholder="Image" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="name" name="firstname" class="form-control" value="<?php echo $user->getFirstName();?>" placeholder="Name" />
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
                    <div class="form-outline mb-4">
                        <input type="password" id="password" name="password" class="form-control" value="<?php echo $user->getPassword();?>" placeholder="Password" />
                    </div>
                    <div class="d-flex align-items-center justify-content-center pb-3">
                        <button type="submit" name='edit' class="btn px-4 py-2" style="background: var(--lightpink)">Edit</button>
                    </div>
                </form>

            </div>
          </div>
          <img class="col-lg-6 d-flex align-items-center" src='../images/image10.jpg'>

        </div>
      </div>
    </div>
  </div>
</div>
</section>


<?php include "inc/footer.php";?>