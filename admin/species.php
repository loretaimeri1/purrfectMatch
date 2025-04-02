<?php include "inc/header.php";
use Class\Pet;
use Class\Specie;
?>

<div class="home">
<div class="container-fluid">
        <h1 class="mt-4">Species</h1>
        <div class="row">
            <div class="col-12">
            <div class="table-responsive">
            <?php
            if (!empty($session->message)) {
                echo "<h5 class='bg-light p-3'>{$session->message}</h5>";
            }
            ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-light" style="background:var(--darkpink);">
                    <tr>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr> 
                </thead>
                
                <tbody>
                <?php 
                        $species = new Specie();
                        foreach ($species->find_all() as $specie) {
                        echo "<tr>";
                        echo "<td>" .$specie->getName() ."</td>";
                        echo "<td class='p-3'><a href='edit_species.php?id=". $specie->getId() ."'><button class='btn btn-dark'><i class='fa-solid fa-edit'></i></button></a></td>";
                        echo "<td class='p-3'><a href='delete_species.php?id=". $specie->getId() ."'><button class='btn btn-dark'><i class='fa-solid fa-trash'></i></button></a></td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
                <tfoot class="text-light" style="background:var(--darkpink);">
                    <tr>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
            </table>
            <a href='add_species.php'><button class='btn btn-dark'>Add Specie  <i class='fa-solid fa-plus'></i></button></a>
           </div>
           </div>	    
        </div>
    </div>    

  

</div>


<?php include "inc/footer.php";?>