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

                if(isset($_GET['id'])){
                    $id =  $_GET['id'];
                    $user = $user->find_id($id);
                }

                if(isset($_POST['edit_user'])){
                    $user->setFirstName($_POST['firstname']);
                    $user->setLastName($_POST['lastname']);
                    $user->setPhone($_POST['phone']);
                    $user->setEmail($_POST['email']);
                    $user->setRole($_POST['role']);
                    $user->setAddress($_POST['address']);
                    if($_FILES['image']['size']>0){
                        $user->setPhotoImage($_FILES['image']);
                    }
                    $user->update();
                    header("Location:users.php");
                }
            ?>
            <div class="col-lg-9">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-2">Update User</h3>
                </div>
                
                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="firstname">First name :</label>
                            <input class="form-control" value= "<?php echo $user->getFirstName();?>" name="firstname" id="firstname" type="text" placeholder="Enter first name" />
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="lastname">Lastname :</label>
                            <input class="form-control" value= "<?php echo $user->getLastName();?>" name="lastname" id="lastname" type="text" placeholder="Enter lastname" />
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="phone">Phone :</label>
                            <input class="form-control" value= "<?php echo $user->getPhone();?>" name="phone" id="phone" type="text" placeholder="Enter phone" />
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="email">Email :</label>
                            <input class="form-control" value= "<?php echo $user->getEmail();?>" name="email" id="email" type="text" placeholder="Enter email" />
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="image">Image :</label>
                            <input class="form-control py-1 mb-3" name="image" id="image" type="file"  />
                            <img style='height:50px; width:50px; object-fit:cover;' src='../uploads/<?php echo $user->getImage();?>' alt=''/>
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="role">Role :</label>
                            <select class="form-control mb-3" name="role" id="role">
                                <option value=""  disabled>Select role</option>
                                <?php
                                 $role = array("admin"=>1,"user"=>0);
                                 foreach($role as $key=>$value){
                                    $selected='';
                                    if($user->getRole()==$value){$selected='selected';}
                                     echo "<option value='$value' {$selected}>$key</option>";
                                 }
                                ?>
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="address">Address :</label>
                            <input class="form-control" value= "<?php echo $user->getAddress();?>" name="address" id="address" type="text" placeholder="address" />
                        </div>
                        <input class="btn btn-dark"  id="update" value="Update user"  
                         type="submit" name="edit_user"/>
                    </form>
                </div>
            </div>
        </div>
</div>
<?php include "inc/footer.php"?>
