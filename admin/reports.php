<?php include "inc/header.php";
use Class\Found_Lost_Animals;
?>

<div class="home">
<div class="container-fluid">
        <h1 class="mt-4">Found and Lost Reports</h1>
        <div class="row">
            <div class="col-12 mb-5">
            <h2 class="mt-4">Found Animals</h2>
            <div class="table-responsive">
            <?php
            if (!empty($session->message)) {
                echo "<h5 class='bg-light p-3'>{$session->message}</h5>";
            }
            ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead class="text-light" style="background:var(--darkpink);">
                    <tr>
                        <th>User ID</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Photo</th>
                        <th>Reported At</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr> 
                </thead>
                
                <tbody>
                <?php 
                    $foundReports = new Found_Lost_Animals();
                    foreach ($foundReports->find_all() as $report) {
                        if($report->getStatus() == 'F'){ 
                        echo "<tr>";
                        echo "<td>" . $report->getUserId() . "</td>";
                        echo "<td>" . $report->getDescription() . "</td>";
                        echo "<td>" . $report->getLocation() . "</td>";
                        echo "<td><img style='height:50px; width:50px; object-fit:cover;' src='../images/{$report->getPhoto()}' alt=''/></td>";
                        echo "<td>" . $report->getReportedAt() . "</td>";
                        echo "<td class='p-3'><a href='edit_found_lost_report.php?id=". $report->getId() ."'><button class='btn btn-dark'><i class='fa-solid fa-edit'> </i></button></a></td>";
                        echo "<td class='p-3'><a href='delete_found_lost_report.php?id=". $report->getId() ."'><button class='btn btn-dark'><i class='fa-solid fa-trash'></i></button></a></td>";
                        echo "</tr>";
                        }
                    }
                ?>
                </tbody>
                <tfoot class="text-light" style="background:var(--darkpink);">
                    <tr>
                        <th>User ID</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Photo</th>
                        <th>Reported At</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
            </table>
           </div>
           </div>

            <div class="col-12">
            <h2 class="mt-4">Lost Animals</h2>
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead class="text-light" style="background:var(--darkpink);">
                    <tr>
                        <th>User ID</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Photo</th>
                        <th>Reported At</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr> 
                </thead>
                
                <tbody>
                <?php 
                    $lostReports = new Found_Lost_Animals();
                    foreach ($lostReports->find_all() as $report) {
                        if($report->getStatus() == 'L'){ 
                        echo "<tr>";
                        echo "<td>" . $report->getUserId() . "</td>";
                        echo "<td>" . $report->getDescription() . "</td>";
                        echo "<td>" . $report->getLocation() . "</td>";
                        echo "<td><img style='height:50px; width:50px; object-fit:cover;' src='../images/{$report->getPhoto()}' alt=''/></td>";
                        echo "<td>" . $report->getReportedAt() . "</td>";
                        echo "<td class='p-3'><a href='edit_found_lost_report.php?id=". $report->getId() ."'><button class='btn btn-dark'><i class='fa-solid fa-edit'> </i></button></a></td>";
                        echo "<td class='p-3'><a href='delete_found_lost_report.php?id=". $report->getId() ."'><button class='btn btn-dark'><i class='fa-solid fa-trash'></i></button></a></td>";
                        echo "</tr>";
                        }
                    }
                ?>
                </tbody>
                <tfoot class="text-light" style="background:var(--darkpink);">
                    <tr>
                        <th>User ID</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Photo</th>
                        <th>Reported At</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
            </table>
           </div>
           </div>

        </div>
    </div>    

</div>

<?php include "inc/footer.php";?>
