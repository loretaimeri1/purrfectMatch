<?php include "inc/header.php"; ?>

<div class="container mt-5">
    <h1 class="text-center">Lost & Found Reports</h1>

    <div class="row">
        <?php
        use Class\Found_Lost_Animals;

        $report = new Found_Lost_Animals();
        $reports = $report->find_all(); 

        foreach ($reports as $r) {
            echo "<div class='col-md-4'>";
            echo "<div class='card mb-4'>";
            echo "<img src='images/".$r->getPhoto()."' class='card-img-top' style='height: 200px; object-fit: cover;' alt='Animal Image'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>".$r->getStatusLabel()." Animal</h5>";
            echo "<p class='card-text'>".$r->getDescription()."</p>";
            echo "<p class='card-text'><i class='fa-solid fa-location-dot'></i> ".$r->getLocation()."</p>";
            echo "<p class='text-muted'>Reported on: ".$r->getReportedAt()."</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<?php include "inc/footer.php"; ?>
