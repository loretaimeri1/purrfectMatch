<?php
ob_start();
use Class\Found_Lost_Animals;

include "inc/header.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $report = new Found_Lost_Animals();
    $report = $report->find_id($id);
}

if (isset($_POST['edit_report'])) {
    $report->setDescription($_POST['description']);
    $report->setLocation($_POST['location']);
    
    if ($_FILES['photo']['size'] > 0) {
        $report->setPhoto($_FILES['photo']);
    }
    
    $report->update();
    
    header("Location: reports.php");
}

?>

<div class="home">
    <div class="container-fluid">
        <h1 class="mt-4">Edit Report</h1>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-2">
                            Update <?php echo $report->getStatus(); ?> Animal Report
                        </h3>
                    </div>

                    <div class="card-body">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label class="small mb-1" for="description">Description:</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Enter description"><?php echo $report->getDescription(); ?></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="small mb-1" for="location">Location:</label>
                                <input class="form-control" value="<?php echo $report->getLocation(); ?>" name="location" id="location" type="text" placeholder="Enter location" />
                            </div>

                            <div class="form-group mb-3">
                                <label class="small mb-1" for="photo">Photo:</label>
                                <input class="form-control py-1 mb-3" name="photo" id="photo" type="file" />
                                <img style='height:50px; width:50px; object-fit:cover;' src='../images/<?php echo $report->getPhoto(); ?>' alt=''/>
                            </div>

                            <input class="btn btn-dark" id="update" value="Update Report" type="submit" name="edit_report"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "inc/footer.php"; ?>
