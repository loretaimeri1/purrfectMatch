<?php 
include "inc/header.php";
use Class\User;
use Class\Found_Lost_Animals;
use Class\Validator;

$user = new User();
$report = new Found_Lost_Animals();

$errors = [];

if(isset($_SESSION['userId'])){
    $userId = $_SESSION['userId'];
    $user = $user->find_id($userId);

    if(isset($_POST['submit_report'])) {

        // Validimi i fushave të tjera
        if (empty($_POST['description'])) {
            $errors['description'] = "Description is required.";
        }
        if (empty($_POST['location'])) {
            $errors['location'] = "Location is required.";
        }
        if (!in_array($_POST['status'], ['L', 'F'])) {
            $errors['status'] = "Please select a valid status.";
        }
        if (!Validator::validateImage($_FILES['photo'])) {
          $errors['photo'] = 'Please upload an image.';
      }

        if (empty($errors)) {
            $report->setUserId($userId);
            $report->setDescription($_POST['description']);
            $report->setLocation($_POST['location']);
            $report->setStatus($_POST['status']);
            $report->setPhotoImage($_FILES['photo']);
            $report->setReportedAt();

            $report->create();
            header("Location: profile.php");
            exit;
        }
    }
}
?>

<section class="text-center">
  <div id='top'></div>

  <div class="card mx-4 mx-md-5 shadow-5-strong">
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Report a lost or found animal</h2>
          <form method="POST" enctype="multipart/form-data" id="reportForm">
            <div class="form-outline mb-4">
              <input type="text" name="firstname" value="<?= $user->getFirstName(); ?>" class="form-control" readonly placeholder="Your Name" />
            </div>
            <div class="form-outline mb-4">
              <input type="email" name="email" value="<?= $user->getEmail(); ?>" class="form-control" readonly placeholder="Your Email" />
            </div>

            <div class="form-outline mb-3">
              <textarea name="description" class="form-control" placeholder="Describe the animal..." required><?= $_POST['description'] ?? '' ?></textarea>
              <?php if (isset($errors['description'])): ?>
                <small class="text-danger error-msg"><?= $errors['description'] ?></small>
              <?php endif; ?>
            </div>

            <div class="form-outline mb-3">
              <input type="text" name="location" class="form-control" placeholder="Location" value="<?= $_POST['location'] ?? '' ?>" required />
              <?php if (isset($errors['location'])): ?>
                <small class="text-danger error-msg"><?= $errors['location'] ?></small>
              <?php endif; ?>
            </div>

            <div class="form-outline mb-3">
              <select name="status" class="form-control" required>
                <option value="">-- Select Status --</option>
                <option value="L" <?= (($_POST['status'] ?? '') === 'L') ? 'selected' : '' ?>>Lost</option>
                <option value="F" <?= (($_POST['status'] ?? '') === 'F') ? 'selected' : '' ?>>Found</option>
              </select>
              <?php if (isset($errors['status'])): ?>
                <small class="text-danger error-msg"><?= $errors['status'] ?></small>
              <?php endif; ?>
            </div>

            <div class="form-outline mb-4">
              <input type="file" name="photo" class="form-control" />
              <?php if(isset($errors['photo'])) echo "<p class='text-danger'>{$errors['photo']}</p>"; ?>
            </div>

            <button type="submit" name="submit_report" class="btn btn-primary btn-block mb-4">Submit Report</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
document.querySelectorAll("#reportForm input,#reportForm select, #reportForm textarea").forEach(field => {
    field.addEventListener("input", () => {
        const error = field.nextElementSibling;
        if (error && error.classList.contains("text-danger")) {
            error.remove();
        }
    });
});
</script>


<?php include "inc/footer.php"; ?>
