<?php include "inc/header.php";
use Class\Session;
use Class\User;

if ($session->isSignedIn()) {
    header("Location: index.php");
}

?>

<section class="h-100 gradient-form">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center py-5">
                  <h4 class="mt-1 mb-5 p-2" style="background: var(--green)">Login</h4>
                </div>
                <?php
                if (isset($_POST['login'])) {
                    $user = new User();
                    $user = $user->verifyUser($_POST['email'], $_POST['password']);

                    if ($user) {
                        $session->login($user);
                        if($user->getRole()==1){
                          header("Location: admin/users.php");
                        }
                        else{
                        header("Location: index.php");}
                    } 
                    else {
                        echo ("Your email or password is incorrent");
                    }
                }
                ?>
                <form method="POST">
                    <div class="form-outline mb-4">
                        <input type="text" id="email" name="email" class="form-control" placeholder="Email address" />
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" />
                    </div>
                    <div class="d-flex align-items-center justify-content-center pb-3">
                        <button type="submit" name='login' class="btn px-5 py-3" style="background: var(--green)">Login</button>
                    </div>

                    <div class="d-flex align-items-center justify-content-center pt-4">
                    <p class="mb-0 me-2">Don't have an account?</p>
                    <button type="button" class="btn btn-dark gradient"><a href="signup.php" class='btn'>Create new</a></button>
                  </div>
                </form>

              </div>
            </div>
            <img class="col-lg-6 d-flex align-items-center" src='images/image8.jpg'>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>

<?php include "inc/footer.php";?>