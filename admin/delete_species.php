<?php
ob_start();

include "inc/header.php";
use Class\Pet;
use Class\Specie;

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

                if(isset($_POST['delete_specie'])){
                    $specie->delete();
                    header("Location:species.php");
                }
            ?>
            <div class="col-lg-9">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-2">Delete specie</h3>
                </div>
                
                <div class="card-body">
                    <form method="post" action="">
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="name">Name :</label>
                            <input class="form-control " value= "<?php echo $specie->getName();?>" name="name" id="name" type="text" placeholder="Enter name" />
                        </div>
                        <input class="btn btn-dark"  id="delete" value="Delete Specie"  
                         type="submit" name="delete_specie"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include "inc/footer.php"?>
