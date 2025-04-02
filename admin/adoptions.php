<?php include "inc/header.php";
use Class\Adoption;
use Class\Pet;
use Class\User;
?>

<div class="home">
<div class="container-fluid">
        <h1 class="mt-4">Adoptions</h1>
        <div class="row">
            <div class="col-12">
            <div class="table-responsive">
            <?php
            if (!empty($session->message)) {
                echo "<h5 class='bg-light p-3'>{$session->message}</h5>";
            }

            if(isset($_POST['delete_adoption'])){
                $id = $_POST['id']; 
                $adoption = new Adoption();
                $adoption = $adoption->find_id($id);
                $adoption->delete();
                header("Location:adoptions.php");
            }
            ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-light" style="background:var(--darkpink);">
                    <tr>
                        <th>Pet Name</th>
                        <th>User Name</th>
                        <th>Adoption Date</th>
                        <th>Adoption Fee</th>
                        <th>Phone</th>
                        <th>User Address</th>
                        <th>Email</th>
                        <th>Delete</th>
                    </tr> 
                </thead>
                
                <tbody>
                <?php 
                    $adoptions=new Adoption();
                    foreach ($adoptions->find_all() as $adoption) {
                        $user = new User();
                        $user = $user->find_id($adoption->getUserId());
                        $pet = new Pet();
                        $pet = $pet->find_id($adoption->getPetId());
                        echo "<tr>";
                        echo "<td>" .$pet->getName() ."</td>";
                        echo "<td>" .$user->getFirstName(). " ". $user->getLastName() ."</td>";
                        echo "<td>" .$adoption->getAdoptDate() ."</td>";
                        echo "<td>$" .$pet->getAdoptionFee() ."</td>";
                        echo "<td>" .$user->getPhone() ."</td>";
                        echo "<td>" .$user->getAddress() ."</td>";
                        echo "<td>" .$user->getEmail() ."</td>";
                        echo "<form method='POST'>";
                        echo "<input type='hidden' name='id' value='{$adoption->getId()}'>";
                        echo "<td class='p-3'><button type='submit' name='delete_adoption' ><i class='fa-solid fa-trash'></i></button></td>";
                        echo "</form>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
                <tfoot class="text-light" style="background:var(--darkpink);">
                    <tr>
                        <th>Pet Name</th>
                        <th>User Name</th>
                        <th>Adoption Date</th>
                        <th>Adoption Fee</th>
                        <th>Phone</th>
                        <th>User Address</th>
                        <th>Email</th>
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