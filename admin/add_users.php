<?php
ob_start();
use Class\User;
use Class\Specie;
use Class\Validator;

include "inc/header.php";
?>
<div class="home">
    <div class="container-fluid">
        <h1 class="mt-4">Users</h1>
        <div class="row justify-content-center">
            <?php
                $user = new User(); 
                $errors = [];

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (!Validator::isRequired($_POST['firstname'])) {
                        $errors['firstname'] = 'First name is required.';
                    }
                    if (!Validator::isRequired($_POST['lastname'])) {
                        $errors['lastname'] = 'Last name is required.';
                    }
                    if (!Validator::isEmail($_POST['email'])) {
                        $errors['email'] = 'Email is invalid.';
                    }
                    if (!Validator::isNumber($_POST['phone'])) {
                        $errors['phone'] = 'Phone must be numeric.';
                    }
                    if (!Validator::validateImage($_FILES['image'])) {
                        $errors['image'] = 'Please upload an image.';
                    }
                    if (!Validator::validateSelect($_POST['role'] ?? "")) {
                        $errors['role'] = 'Please select a role.';
                    }

                    if (empty($errors)) {
                        $user->setFirstName($_POST['firstname']);
                        $user->setLastName($_POST['lastname']);
                        $user->setPhone($_POST['phone']);
                        $user->setEmail($_POST['email']);
                        $user->setRole($_POST['role']);
                        $user->setAddress($_POST['address']);
                        $user->setPhotoImage($_FILES['image']);
                        $user->create();
                        header("Location: users.php");
                    }
                }
            ?>
            <div class="col-lg-9">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-2">Add User</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="" enctype="multipart/form-data" id="userForm">
                            <div class="form-group mb-3">
                                <label class="small mb-1" for="firstname">First name:</label>
                                <input class="form-control" name="firstname" id="firstname" type="text" value="<?= htmlspecialchars($_POST['firstname'] ?? '') ?>" />
                                <p class='text-danger error' id="error-firstname"><?= $errors['firstname'] ?? '' ?></p>
                            </div>
                            <div class="form-group mb-3">
                                <label class="small mb-1" for="lastname">Lastname:</label>
                                <input class="form-control" name="lastname" id="lastname" type="text" value="<?= htmlspecialchars($_POST['lastname'] ?? '') ?>" />
                                <p class='text-danger error' id="error-lastname"><?= $errors['lastname'] ?? '' ?></p>
                            </div>
                            <div class="form-group mb-3">
                                <label class="small mb-1" for="phone">Phone:</label>
                                <input class="form-control" name="phone" id="phone" type="text" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" />
                                <p class='text-danger error' id="error-phone"><?= $errors['phone'] ?? '' ?></p>
                            </div>
                            <div class="form-group mb-3">
                                <label class="small mb-1" for="email">Email:</label>
                                <input class="form-control" name="email" id="email" type="text" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
                                <p class='text-danger error' id="error-email"><?= $errors['email'] ?? '' ?></p>
                            </div>
                            <div class="form-group mb-3">
                                <label class="small mb-1" for="image">Image:</label>
                                <input class="form-control py-1 mb-3" name="image" id="image" type="file" />
                                <p class='text-danger error' id="error-image"><?= $errors['image'] ?? '' ?></p>
                                <img style='height:50px; width:50px; object-fit:cover;' alt='' />
                            </div>
                            <div class="form-group mb-3">
                                <label class="small mb-1" for="role">Role:</label>
                                <select class="form-control mb-3" name="role" id="role">
                                    <option value="" disabled <?= empty($_POST['role']) ? 'selected' : '' ?>>Select role</option>
                                    <?php
                                    $role = array("admin" => 1, "user" => 0);
                                    foreach ($role as $key => $value) {
                                        $selected = (isset($_POST['role']) && $_POST['role'] == $value) ? "selected" : "";
                                        echo "<option value='$value' $selected>$key</option>";
                                    }
                                    ?>
                                </select>
                                <p class='text-danger error' id="error-role"><?= $errors['role'] ?? '' ?></p>
                            </div>
                            <div class="form-group mb-3">
                                <label class="small mb-1" for="address">Address:</label>
                                <input class="form-control" name="address" id="address" type="text" value="<?= htmlspecialchars($_POST['address'] ?? '') ?>" />
                            </div>
                            <input class="btn btn-dark" id="add" value="Add user" type="submit" name="add_user" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ✅ JavaScript to clear error when typing -->
<script>
document.querySelectorAll('#userForm input, #userForm select').forEach(field => {
    field.addEventListener('input', () => {
        const errorElement = document.getElementById('error-' + field.id);
        if (errorElement) {
            errorElement.textContent = '';
        }
    });
});
</script>

<?php include "inc/footer.php"; ?>
