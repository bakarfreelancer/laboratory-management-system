<?php 
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/topbar.php');

$error = "";

if(isset($_POST['add_user'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $role = $_POST['role'];
    if($password!= $cpassword){
        $error = "Password and confirm password not match";
    }elseif($role !== "admin" || $role !== "operator"){
        $hashed_password= password_hash($password, PASSWORD_DEFAULT);
        // add data to database.
        $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', '$role')";
        $result = mysqli_query($conn, $query);
        if($result){
            header("location: /users");
            exit();
        }else{
            $error = "Email already exist.";
        }
    }else{
        echo $role;
        $error ="Please select a valid user role.";
    }
}

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-start mb-4">
        <a href="/users" class="btn btn-sm btn-primary shadow-sm mr-2">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
        <h1 class="h3 mb-0 text-gray-800">Add New User</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="card w-100 p-4">
            <form method="POST">
                
                <div class="row">
                    <?php if($error): ?>
                        <div class="col-12">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="cpassword" class="form-label">confirm Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" required>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <select class="form-select form-control" name="role" aria-label="Default select example">
                            <option selected>Select User role</option>
                            <option value="admin">Admin</option>
                            <option value="operator">Operator</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <button type="submit" name="add_user" class="btn btn-primary w-100">Add User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
include('../includes/footer.php');