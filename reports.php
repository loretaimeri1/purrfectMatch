<?php 
include "inc/header.php";
use Class\User;
use Class\Found_Lost_Animals;

$user = new User();
$report = new Found_Lost_Animals();

if(isset($_SESSION['userId'])){
    $userId = $_SESSION['userId'];
    $user = $user->find_id($userId);

    if(isset($_POST['submit_report'])) {
        $report->setUserId($userId);
        $report->setDescription($_POST['description']);
        $report->setLocation($_POST['location']);
        $report->setStatus($_POST['status']);
        $report->setReportedAt();

        // Handle photo upload
        if($_FILES['photo']['size']>0){
            $report->setPhotoImage($_FILES['photo']);
        }

        // Save to database
        $report->create();
        header("Location: profile.php");
    }
}
?>

<section class="text-center">
  <div class="card mx-4 mx-md-5 shadow-5-strong">
    <div class="card-body py-5 px-md-5">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Report a Lost or Found Animal</h2>
          <form method="POST" enctype="multipart/form-data">
            <div class="form-outline mb-4">
              <input type="text" id="name" name="firstname" value="<?php echo $user->getFirstName();?>" class="form-control" placeholder="Your Name" readonly />
            </div>
            <div class="form-outline mb-4">
              <input type="email" id="email" name="email" value="<?php echo $user->getEmail();?>" class="form-control" placeholder="Your Email" readonly />
            </div>
            <div class="form-outline mb-4">
              <textarea id="description" name="description" class="form-control" placeholder="Describe the animal..." required></textarea>
            </div>
            <div class="form-outline mb-4">
              <input type="text" id="location" name="location" class="form-control" placeholder="Location" required />
            </div>
            <div class="form-outline mb-4">
              <select name="status" class="form-control" required>
                <option value="L">Lost</option>
                <option value="F">Found</option>
              </select>
            </div>
            <div class="form-outline mb-4">
              <input type="file" id="photo" name="photo" class="form-control" />
            </div>
            <button type="submit" name="submit_report" class="btn btn-primary btn-block mb-4">Submit Report</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include "inc/footer.php"; ?>
