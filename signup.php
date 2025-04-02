<?php include "inc/header.php";
?>
<section class="h-100 mt-5 mb-5">
<div class="container py-5 h-100">
  <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-xl-10">
      <div class="card rounded-3 text-black">
        <div class="row g-0">
            <img class="col-lg-6 d-flex align-items-center" src='images/image9.jpg'>
            <div class="col-lg-6">
            <div class="card-body p-md-5 mx-md-4">

                <div class="text-center py-5">
                  <h4 class="mb-2 p-2" style="background: var(--lightpink)">Sign Up</h4>
                </div>

                <?php 
                use Class\User;
                

                if ($session->isSignedIn()) {
                    header("Location: index.php");
                }

                if (isset($_POST['signup'])) {
                  if($_POST['password']===$_POST['confirmPassword']){

                  
                    $user = new User();
                    $user->setFirstname($_POST['firstname']);
                    $user->setLastname($_POST['lastname']);
                    $user->setPhone($_POST['phone']);
                    $user->setEmail($_POST['email']);
                    $user->setPassword($_POST['password']);
                    // $user->setPhotoImage($_POST['']);
                    $user->create();
                    $user = $user->verifyUser($user->getEmail(), $user->getPassword());
                    if ($user) {
                        $session->login($user);
                        // print_r($user);
                        if($user->getRole()==1){
                          header("Location: admin/index.php");
                        }
                        else{
                        header("Location: index.php");}
                    }
                    else {
                        $session->message("Could not sign up");
                    }
                }
              }
                ?>
                <form method="POST">
                <div class="form-outline mb-4">
                        <input type="text" id="name" name="firstname" class="form-control" placeholder="Name" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Lastname" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="email" name="email" class="form-control" placeholder="Email address" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="address" name="address" class="form-control" placeholder="Address" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm password" />
                    </div>
                    <div class="d-flex align-items-center justify-content-center pb-3">
                        <button type="submit" name='signup' class="btn px-4 py-2" style="background: var(--lightpink)">Sign up</button>
                    </div>
                </form>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
</section>
<?php include "inc/footer.php";?>