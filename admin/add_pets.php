<?php
ob_start();
use Class\Pet;
use Class\Specie;
use Class\Validator;

include "inc/header.php";
?>    
<div class="home">
<div class="container-fluid">
<h1 class="mt-4">Pets</h1>
<div class="row justify-content-center">
<?php    
$pet = new Pet(); 
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Validator::validateSpecie($_POST['specieid'] ?? "")) {
        $errors['specieid'] = 'Please select a specie.';
    }
    if (!Validator::isRequired($_POST['name'])) {
        $errors['name'] = 'Name is required.';
    }
    if (!Validator::isRequired($_POST['title'])) {
        $errors['title'] = 'Title is required.';
    }
    if (!Validator::isRequired($_POST['description'])) {
        $errors['description'] = 'Description is required.';
    }
    if (!Validator::isNumber($_POST['adoption_fee'])) {
        $errors['adoption_fee'] = 'Adoption fee must be a number.';
    }
    if (!Validator::validateImage($_FILES['image'])) {
        $errors['image'] = 'Please upload an image.';
    }
    if (!Validator::validateGender($_POST['gender'] ?? "")) {
        $errors['gender'] = 'Please select a gender.';
    }
    if (!Validator::isRequired($_POST['address'])) {
        $errors['address'] = 'Address is required.';
    }
    if (!Validator::isRequired($_POST['location'])) {
        $errors['location'] = 'Location is required.';
    }

    if (empty($errors)) {
        $pet->setSpecieId($_POST['specieid']);
        $pet->setName($_POST['name']);
        $pet->setTitle($_POST['title']);
        $pet->setDescription($_POST['description']);
        $pet->setAdoptionFee($_POST['adoption_fee']);
        $pet->setGender($_POST['gender']);
        $pet->setAddress($_POST['address']);
        $pet->setLocation($_POST['location']);
        $pet->setPhotoImage($_FILES['image']);
        $pet->create();
        header("Location:pets.php");
    }
}
?>
<div class="col-lg-9">
<div class="card shadow-lg border-0 rounded-lg mt-5">
<div class="card-header">
    <h3 class="text-center font-weight-light my-2">Add Pets</h3>
</div>

<div class="card-body">
<form method="post" action="" enctype="multipart/form-data" id="pet-form">
    <div class="form-group mb-3">
        <label class="small mb-1" for="specieid">Specie :</label>
        <select class="form-control" name="specieid" id="specieid">
            <option value="" disabled selected>Select Specie</option>
            <?php
            $specie = new Specie();
            $species = $specie->find_all();
            foreach ($species as $sp) {
                echo "<option value='{$sp->getId()}'>{$sp->getName()}</option>";
            }
            ?>
        </select>
        <?php if(isset($errors['specieid'])) echo "<p class='text-danger'>{$errors['specieid']}</p>"; ?>
    </div>
    <div class="form-group mb-3">
        <label for="name">Name :</label>
        <input class="form-control" name="name" id="name" type="text" />
        <?php if(isset($errors['name'])) echo "<p class='text-danger'>{$errors['name']}</p>"; ?>
    </div>
    <div class="form-group mb-3">
        <label for="title">Title :</label>
        <input class="form-control" name="title" id="title" type="text" />
        <?php if(isset($errors['title'])) echo "<p class='text-danger'>{$errors['title']}</p>"; ?>
    </div>
    <div class="form-group mb-3">
        <label for="description">Description :</label>
        <textarea class="form-control py-4" name="description" id="description"></textarea>
        <?php if(isset($errors['description'])) echo "<p class='text-danger'>{$errors['description']}</p>"; ?>
    </div>
    <div class="form-group mb-3">
        <label for="adoption_fee">Adoption Fee :</label>
        <input class="form-control" name="adoption_fee" id="adoption_fee" type="number" />
        <?php if(isset($errors['adoption_fee'])) echo "<p class='text-danger'>{$errors['adoption_fee']}</p>"; ?>
    </div>
    <div class="form-group mb-3">
        <label for="image">Image :</label>
        <input class="form-control py-1 mb-3" name="image" id="image" type="file" />
        <?php if(isset($errors['image'])) echo "<p class='text-danger'>{$errors['image']}</p>"; ?>
        <img style='height:50px; width:50px; object-fit:cover;' alt=''/>
    </div>
    <div class="form-group mb-3">
        <label for="gender">Gender :</label>
        <select class="form-control mb-3" name="gender" id="gender">
            <option value="" disabled selected>Select Gender</option>
            <?php
            foreach (['F', 'M'] as $g) {
                echo "<option value='$g'>$g</option>";
            }
            ?>
        </select>
        <?php if(isset($errors['gender'])) echo "<p class='text-danger'>{$errors['gender']}</p>"; ?>
    </div>
    <div class="form-group mb-3">
        <label for="address">Address :</label>
        <input class="form-control" name="address" id="address" type="text" />
        <?php if(isset($errors['address'])) echo "<p class='text-danger'>{$errors['address']}</p>"; ?>
    </div>
    <div class="form-group mb-3">
        <label for="location">Location :</label>
        <input class="form-control" name="location" id="location" type="text" />
        <?php if(isset($errors['location'])) echo "<p class='text-danger'>{$errors['location']}</p>"; ?>
    </div>
    <input class="btn btn-dark" id="add" value="Add pet" type="submit" name="add_pet"/>
</form>
</div>
</div>
</div>
</div>
</div>

<script>
// Clear error on input
document.querySelectorAll("#pet-form input, #pet-form select, #pet-form textarea").forEach(field => {
    field.addEventListener("input", () => {
        const error = field.nextElementSibling;
        if (error && error.classList.contains("text-danger")) {
            error.remove();
        }
    });
});
</script>

<?php include "inc/footer.php"; ?>
