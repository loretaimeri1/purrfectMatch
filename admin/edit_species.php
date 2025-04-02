<?php
ob_start();
use Class\Pet;
use Class\Specie;

include "inc/header.php";
?>    
<div class="home">
    <div class="container-fluid">
        <h1 class="mt-4">Species</h1>
        <div class="row justify-content-center">
            <?php    
                $specie = new Specie(); 

                if(isset($_GET['id'])){
                    $id =  $_GET['id'];
                    $specie = $specie->find_id($id);
                }

                if(isset($_POST['edit_specie'])){
                    $specie->setName($_POST['name']);
                    $specie->update();
                    header("Location:species.php");
                }
            ?>
            <div class="col-lg-9">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-2">Update Specie</h3>
                </div>
                
                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="name">Name :</label>
                            <input class="form-control " value= "<?php echo $specie->getName();?>" name="name" id="name" type="text" placeholder="Enter name" />
                        </div>
                        <input class="btn btn-dark"  id="update" value="Update specie"  
                         type="submit" name="edit_specie"/>
                    </form>
                </div>
            </div>
        </div>
</div>
<?php include "inc/footer.php"?>
