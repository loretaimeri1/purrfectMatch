<?php include "inc/header.php";
use Class\Pet;
use Class\Specie;
?>

<div class="home">
<div class="container-fluid">
        <h1 class="mt-4">Pets</h1>
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
                        <th>Title</th>
                        <th>Description</th>
                        <th>Adoption Fee</th>
                        <th>Image</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Specie</th>
                        <th>Address</th>
                        <th>Location</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr> 
                </thead>
                
                <tbody>
                <?php 
                    $pets=new Pet();
                    foreach ($pets->find_all() as $pet) {
                        $specie = new Specie();
                        $specie = $specie->find_id($pet->getSpecieId());
                        echo "<tr>";
                        echo "<td>" .$pet->getName() ."</td>";
                        echo "<td>" .$pet->getTitle() ."</td>";
                        echo "<td>" .$pet->getDescription() ."</td>";
                        echo "<td>$" .$pet->getAdoptionFee() ."</td>";
                        echo "<td><img style='height:50px; width:50px; object-fit:cover;' src='../uploads/{$pet->getImage()}' alt=''/></td>";
                        echo "<td>" .$pet->getAge() ."</td>";
                        echo "<td>" .$pet->getGender() ."</td>";
                        echo "<td>" .$specie->getName() ."</td>";
                        echo "<td>" .$pet->getAddress() ."</td>";
                        echo "<td>" .$pet->getLocation() ."</td>";
                        echo "<td class='p-3'><a href='edit_pets.php?id=". $pet->getId() ."'><button class='btn btn-dark'><i class='fa-solid fa-edit'> </i></button></a></td>";
                        echo "<td class='p-3'><a href='delete_pets.php?id=". $pet->getId() ."'><button class='btn btn-dark'><i class='fa-solid fa-trash'></i></button></a></td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
                <tfoot class="text-light" style="background:var(--darkpink);">
                    <tr>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Adoption Fee</th>
                        <th>Image</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Specie</th>
                        <th>Address</th>
                        <th>Location</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
            </table>
            <a href='add_pets.php'><button class='btn btn-dark'>Add Pet  <i class='fa-solid fa-plus'></i></button></a>
           </div>
           </div>	    
        </div>
    </div>    

  

</div>


<?php include "inc/footer.php";?>