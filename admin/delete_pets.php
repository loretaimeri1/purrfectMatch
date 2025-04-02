<?php
ob_start();

include "inc/header.php";
use Class\Pet;
use Class\Specie;

?>    
<div class="home">
    <div class="container-fluid">
        <h1 class="mt-4">Pets</h1>
        <div class="row justify-content-center">
            <?php    
                $pet = new Pet();

                if(isset($_GET['id'])){
                    $id =  $_GET['id'];
                    $pet = $pet->find_id($id);
                }

                if(isset($_POST['delete_pet'])){
                    $pet->delete();
                    header("Location:pets.php");
                }
            ?>
            <div class="col-lg-9">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-2">Delete Pet</h3>
                </div>
                
                <div class="card-body">
                    <form method="post" action="">
                    <div class="form-group mb-3">
                            <label class="small mb-1" for="specieid">Specie :</label>
                            <select  disabled class="form-control" name="specieid" id="specieid">
                                <option value=""  disabled>Select Specie</option>
                                <?php
                                 $specie = new Specie();
                                 $species = $specie->find_all();
                                 foreach($species as $specie){
                                    $selected='';
                                    if($pet->getSpecieId()==$specie->getId()){$selected='selected';}
                                     echo "<option value='{$specie->getId()}' {$selected}>{$specie->getName()}</option>";
                                 }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="name">Name :</label>
                            <input disabled class="form-control " value= "<?php echo $pet->getName();?>" name="name" id="name" type="text" placeholder="Enter name" />
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="title">Title :</label>
                            <input disabled class="form-control" value= "<?php echo $pet->getTitle();?>" name="title" id="title" type="text" placeholder="Enter title" />
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="description">Description :</label>
                            <textarea disabled class="form-control py-4" name="description" id="description" placeholder="Enter description"><?php echo $pet->getDescription();?></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="adoption_fee">Adoption Fee :</label>
                            <input disabled class="form-control" value= "<?php echo $pet->getAdoptionFee();?>" name="adoption_fee" id="adoption_fee" type="number" placeholder="Enter adoption fee" />
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="image">Image :</label>
                            <input disabled class="form-control py-1 mb-3" name="image" id="image" type="file"  />
                            <img style='height:50px; width:50px; object-fit:cover;' src='../uploads/<?php echo $pet->getImage();?>' alt=''/>
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="gender">Gender :</label>
                            <select disabled class="form-control mb-3" name="gender" id="gender">
                                <option value=""  disabled>Select Gender</option>
                                <?php
                                 $gender = array('F','M');
                                 foreach($gender as $g){
                                    $selected='';
                                    if($pet->getGender()==$g){$selected='selected';}
                                     echo "<option value='$g' {$selected}>$g</option>";
                                 }
                                ?>
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="address">Address :</label>
                            <input disabled class="form-control" value= "<?php echo $pet->getAddress();?>" name="address" id="address" type="text" placeholder="address" />
                        </div>
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="location">Location :</label>
                            <input disabled class="form-control" value= "<?php echo $pet->getLocation();?>" name="location" id="location" type="text" placeholder="Enter Location" />
                        </div>
                        <input class="btn btn-dark"  id="delete" value="Delete Pet"  
                         type="submit" name="delete_pet"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include "inc/footer.php"?>
