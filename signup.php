<?php 
include "inc/header.php"; 
use Class\User;
use Class\Validator;

$errors = [];

if ($session->isSignedIn()) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['signup'])) {
    if (!Validator::isRequired($_POST['firstname'])) {
        $errors['firstname'] = 'First name is required.';
    }
    if (!Validator::isRequired($_POST['lastname'])) {
        $errors['lastname'] = 'Last name is required.';
    }
    if (!Validator::isEmail($_POST['email'])) {
        $errors['email'] = 'Invalid email address.';
    }
    if (!Validator::isRequired($_POST['address'])) {
        $errors['address'] = 'Address is required.';
    }
    if (!Validator::isNumber($_POST['phone'])) {
        $errors['phone'] = 'Phone must be numeric.';
    }
    if (!Validator::isRequired($_POST['password'])) {
        $errors['password'] = 'Password is required.';
    }
    if ($_POST['password'] !== $_POST['confirmPassword']) {
        $errors['confirmPassword'] = 'Passwords do not match.';
    }

    if (empty($errors)) {
        $user = new User();
        $user->setFirstname($_POST['firstname']);
        $user->setLastname($_POST['lastname']);
        $user->setPhone($_POST['phone']);
        $user->setAddress($_POST['address']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->create();

        $user = $user->verifyUser($user->getEmail(), $user->getPassword());
        if ($user) {
            $session->login($user);
            header("Location: " . ($user->getRole() == 1 ? "admin/index.php" : "index.php"));
            exit();
        } else {
            $session->message("Could not sign up");
        }
    }
}
?>

<section class="mt-5 mb-5">
  <div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6 d-flex align-items-center">
              <img src="images/image9.jpg" class="img-fluid" alt="Sign up image">
            </div>
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">
                <div class="text-center py-5">
                  <h4 class="mb-2 p-2" style="background: var(--lightpink)">Sign Up</h4>
                </div>

                <form method="POST" novalidate>
                  <div class="form-outline mb-3">
                    <input type="text" name="firstname" class="form-control" placeholder="Name" value="<?= $_POST['firstname'] ?? '' ?>">
                    <?php if (isset($errors['firstname'])): ?>
                      <small class="text-danger"><?= $errors['firstname'] ?></small>
                    <?php endif; ?>
                  </div>

                  <div class="form-outline mb-3">
                    <input type="text" name="lastname" class="form-control" placeholder="Lastname" value="<?= $_POST['lastname'] ?? '' ?>">
                    <?php if (isset($errors['lastname'])): ?>
                      <small class="text-danger"><?= $errors['lastname'] ?></small>
                    <?php endif; ?>
                  </div>

                  <div class="form-outline mb-3">
                    <input type="text" name="email" class="form-control" placeholder="Email address" value="<?= $_POST['email'] ?? '' ?>">
                    <?php if (isset($errors['email'])): ?>
                      <small class="text-danger"><?= $errors['email'] ?></small>
                    <?php endif; ?>
                  </div>

                  <div class="form-outline mb-3">
                    <input type="text" name="address" class="form-control" placeholder="Address" value="<?= $_POST['address'] ?? '' ?>">
                    <?php if (isset($errors['address'])): ?>
                      <small class="text-danger"><?= $errors['address'] ?></small>
                    <?php endif; ?>
                  </div>

                  <div class="form-outline mb-3">
                    <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="<?= $_POST['phone'] ?? '' ?>">
                    <?php if (isset($errors['phone'])): ?>
                      <small class="text-danger"><?= $errors['phone'] ?></small>
                    <?php endif; ?>
                  </div>

                  <div class="form-outline mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <?php if (isset($errors['password'])): ?>
                      <small class="text-danger"><?= $errors['password'] ?></small>
                    <?php endif; ?>
                  </div>

                  <div class="form-outline mb-3">
                    <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm password">
                    <?php if (isset($errors['confirmPassword'])): ?>
                      <small class="text-danger"><?= $errors['confirmPassword'] ?></small>
                    <?php endif; ?>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-3">
                    <button type="submit" name="signup" class="btn px-4 py-2" style="background: var(--lightpink)">Sign up</button>
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

<script>
document.querySelectorAll("input").forEach(field => {
    field.addEventListener("input", () => {
        const error = field.nextElementSibling;
        if (error && error.classList.contains("text-danger")) {
            error.remove();
        }
    });
});
</script>

<?php include "inc/footer.php"; ?>
