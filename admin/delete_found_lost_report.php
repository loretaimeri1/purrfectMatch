<?php
ob_start();
include "inc/header.php";
use Class\Found_Lost_Animals;

?>

<div class="home">
    <div class="container-fluid">
        <h1 class="mt-4">Found and Lost Reports</h1>
        <div class="row justify-content-center">
            <?php    
                $report = new Found_Lost_Animals();

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $report = $report->find_id($id); 
                }

                if (isset($_POST['delete_report'])) {
                    $report->delete();
                    header("Location: reports.php");
                }
            ?>
            
            <div class="col-lg-9">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-2">Delete Report</h3>
                    </div>
                    
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group mb-3">
                                <label class="small mb-1" for="type">Type :</label>
                                <input disabled class="form-control" value="<?php echo $report->getStatus(); ?>" name="type" id="type" type="text" />
                            </div>
                            <div class="form-group mb-3">
                                <label class="small mb-1" for="description">Description :</label>
                                <textarea disabled class="form-control py-4" name="description" id="description" placeholder="Enter description"><?php echo $report->getDescription(); ?></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="small mb-1" for="location">Location :</label>
                                <input disabled class="form-control" value="<?php echo $report->getLocation(); ?>" name="location" id="location" type="text" placeholder="Enter location" />
                            </div>
                            <div class="form-group mb-3">
                                <label class="small mb-1" for="reported_at">Reported At :</label>
                                <input disabled class="form-control" value="<?php echo $report->getReportedAt(); ?>" name="reported_at" id="reported_at" type="text" />
                            </div>
                            <div class="form-group mb-3">
                                <label class="small mb-1" for="photo">Photo :</label>
                                <img style="height:50px; width:50px; object-fit:cover;" src="../images/<?php echo $report->getPhoto(); ?>" alt="" />
                            </div>
                            
                            <input class="btn btn-dark" id="delete" value="Delete Report" type="submit" name="delete_report" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "inc/footer.php"; ?>
