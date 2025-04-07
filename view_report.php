<?php include "inc/header.php"; ?>
<section class="text-center">
  <div id='top'></div>

    <div class="card mx-4 mx-md-5 shadow-5-strong">
        <div class="card-body py-5 px-md-5">

            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5">Lost & Found animals</h2>
                    <div class="row d-flex justify-content-center">
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
            </div>
        </div>
    </div>
</section>

<?php include "inc/footer.php"; ?>
