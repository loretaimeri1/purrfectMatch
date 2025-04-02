<?php include "inc/header.php";
use Class\User;
use Class\Donation;

?>

<div class="home">
<div class="container-fluid">
        <h1 class="mt-4">Donations</h1>
        <div class="row">
            <div class="col-12">
            <div class="table-responsive">
            <?php
            if (!empty($session->message)) {
                echo "<h5 class='bg-light p-3'>{$session->message}</h5>";
            }

            if(isset($_POST['delete_donation'])){
                $id = $_POST['id']; 
                $donation = new Donation();
                $donation = $donation->find_id($id);
                $donation->delete();
                header("Location:donations.php");
            }
            ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-light" style="background:var(--darkpink);">
                    <tr>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Delete</th>
                    </tr> 
                </thead>
                
                <tbody>
                <?php 
                    $donations=new Donation();
                    foreach ($donations->find_all() as $donation) {
                        $user = new User();
                        $user = $user->find_id($donation->getUserId());
                        echo "<tr p-2>";
                        echo "<td>" .$user->getFirstName()." ".$user->getLastName() ."</td>";
                        echo "<td>$" .$donation->getAmount() ."</td>";
                        echo "<td>" .$user->getPhone() ."</td>";
                        echo "<td>" .$user->getAddress() ."</td>";
                        echo "<td>" .$user->getEmail() ."</td>";
                        echo "<form method='POST'>";
                        echo "<input type='hidden' name='id' value='{$donation->getId()}'>";
                        echo "<td class='p-3'><button type='submit' name='delete_donation' ><i class='fa-solid fa-trash'></i></button></td>";
                        echo "</form>";                        
                        echo "</tr>";
                    }
                ?>
                </tbody>
                <tfoot class="text-light" style="background:var(--darkpink);">
                    <tr>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Phone</th>
                        <th>Address</th>
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