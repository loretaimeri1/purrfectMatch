<?php
include "inc/header.php";
use Class\User;
use Class\Donation;
use Class\Validator;

$user = new User();
$donation = new Donation();
$errors = [];

if(isset($_SESSION['userId'])){
    $userId = $_SESSION['userId'];
    $user = $user->find_id($userId);

    if(isset($_POST['donate'])){
        // Validate fields
        if (!Validator::isRequired($_POST['firstname'])) {
            $errors['firstname'] = "First name is required.";
        }
        if (!Validator::isRequired($_POST['lastname'])) {
            $errors['lastname'] = "Last name is required.";
        }
        if (!Validator::isEmail($_POST['email'])) {
            $errors['email'] = "Invalid email format.";
        }
        if (!Validator::isNumber($_POST['amount'])) {
            $errors['amount'] = "Amount must be a valid number.";
        }

        // If no errors, proceed to create donation
        if (empty($errors)) {
            $donation->setUserId($userId);
            $donation->setAmount($_POST['amount']);
            $donation->create();
            header("Location: profile.php");
            exit;
        }
    }
}
else{
    header("Location:login.php?error=loginrequired");
}
?>

<section class="text-center">
  <div id='top'></div>

  <div class="card mx-4 mx-md-5 shadow-5-strong">
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Help us take care of our pets</h2>
          <form method="POST">
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="name" name="firstname" value="<?php echo $user->getFirstName();?>" class="form-control" placeholder="Name" />
                  <?php if (isset($errors['firstname'])): ?>
                    <small class="text-danger"><?= $errors['firstname'] ?></small>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="lastname" name="lastname" value="<?php echo $user->getLastName();?>" class="form-control" placeholder="Lastname"  />
                  <?php if (isset($errors['lastname'])): ?>
                    <small class="text-danger"><?= $errors['lastname'] ?></small>
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <div class="form-outline mb-4">
              <input type="email" id="email" name="email" value="<?php echo $user->getEmail();?>" class="form-control" placeholder="Email" />
              <?php if (isset($errors['email'])): ?>
                <small class="text-danger"><?= $errors['email'] ?></small>
              <?php endif; ?>
            </div>

            <div class="form-outline mb-4">
              <input type="number" step="0.01" id="amount" name="amount" class="form-control" placeholder="Amount" />
              <?php if (isset($errors['amount'])): ?>
                <small class="text-danger"><?= $errors['amount'] ?></small>
              <?php endif; ?>
            </div>

            <button type="submit" name="donate" class="btn btn-primary btn-block mb-4">Donate</button>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include "inc/footer.php"; ?>
