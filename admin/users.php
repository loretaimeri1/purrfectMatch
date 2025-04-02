<?php include "inc/header.php";
use Class\User;
?>

<div class="home">
<div class="container-fluid">
        <h1 class="mt-4">Users</h1>
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
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr> 
                </thead>
                
                <tbody>
                <?php 
                    $users=new User();
                    foreach ($users->find_all() as $user) {
                        echo "<tr p-2>";
                        echo "<td>" .$user->getFirstName(). " " .$user->getLastName() ."</td>";
                        echo "<td>" .$user->getPhone() ."</td>";
                        echo "<td>" .$user->getAddress() ."</td>";
                        echo "<td><img style='height:50px; width:50px; object-fit:cover;' src='../uploads/{$user->getImage()}' alt=''/></td>";
                        echo "<td>" .$user->getEmail() ."</td>";
                        echo "<td>" .$user->getRole() ."</td>";
                        echo "<td class='p-3'><a href='edit_users.php?id=". $user->getId() ."'><button class='btn btn-dark'><i class='fa-solid fa-edit'></i></button></a></td>";
                        echo "<td class='p-3'><a href='delete_users.php?id=". $user->getId() ."'><button class='btn btn-dark'><i class='fa-solid fa-trash'></i></button></a></td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
                <tfoot class="text-light" style="background:var(--darkpink);">
                    <tr>
                        <th>First</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
            </table>
            <a href='add_users.php'><button class='btn btn-dark'>Add User  <i class='fa-solid fa-plus'></i></button></a>
           </div>
           </div>	    
        </div>
    </div>    

  

</div>


<?php include "inc/footer.php";?>