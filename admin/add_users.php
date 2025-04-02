<?php
ob_start();
use Class\User;
use Class\Specie;

include "inc/header.php";
?>    
<div class="home">
    <div class="container-fluid">
        <h1 class="mt-4">Users</h1>
        <div class="row justify-content-center">
            <?php    
                $user = new User(); 

                if(isset($_POST['add_user']) && isset($_FILES['image'])){
                    $user->setFirstName($_POST['firstname']);
                    $user->setLastName($_POST['lastname']);
                    $user->setPhone($_POST['phone']);
                    $user->setEmail($_POST['email']);
                    $user->setRole($_POST['role']);
                    $user->setAddress($_POST['address']);
                    $user->setPhotoImage($_FILES['image']);
                    $user->create();
                    header("Location:users.php");
                }
            ?>
            <div class="col-lg-9">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-2">Add User</h3>
                </div>
                
                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="firstname">First name :</label>
                            <input class="form-control"  name="firstname" id="firstname" type="text" placeholder="Enter first name" />
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="lastname">Lastname :</label>
                            <input class="form-control" name="lastname" id="lastname" type="text" placeholder="Enter lastname" />
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="phone">Phone :</label>
                            <input class="form-control"  name="phone" id="phone" type="text" placeholder="Enter phone" />
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="email">Email :</label>
                            <input class="form-control" name="email" id="email" type="text" placeholder="Enter email" />
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="image">Image :</label>
                            <input class="form-control py-1 mb-3" name="image" id="image" type="file"  />
                            <img style='height:50px; width:50px; object-fit:cover;'  alt=''/>
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="role">Role :</label>
                            <select class="form-control mb-3" name="role" id="role">
                                <option value=""  disabled>Select role</option>
                                <?php
                                 $role = array("admin"=>1,"user"=>0);
                                 foreach($role as $key=>$value){
                                     echo "<option value='$value'>$key</option>";
                                 }
                                ?>
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="address">Address :</label>
                            <input class="form-control"  name="address" id="address" type="text" placeholder="address" />
                        </div>
                        <input class="btn btn-dark"  id="add" value="Add user"  
                         type="submit" name="add_user"/>
                    </form>
                </div>
            </div>
        </div>
</div>
<?php include "inc/footer.php"?>
