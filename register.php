<?php
session_start();
include ("inc/header.php");
include ("inc/init.php");
$pdo = Database::getConnect($host, $db, $user, $password);
$nameUserError = "";
$passWordError = "";
$idRoleError = "";
$nameError = "";
$nameError = "";
$emailError = "";
$phoneNumberError = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nameUser = $_POST["nameUser"];
    $passWord = $_POST["passWord"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $data = User::register($pdo,$nameUser,$password,$name,$email,$phoneNumber);
    echo '<script>window.location.href = "login.php";</script>';
}
?>
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Register</h1>
    </div>
</div>
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto" method="post" role="form">
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="inputname">Name</label>
                    <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Name">
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="inputemail">Email</label>
                    <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Email">
                </div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Username</label>
                <input type="text" class="form-control mt-1" id="nameUser" name="nameUser" placeholder="Username">
            </div>
            <div class="mb-3">
                <label for="inputsubject">Password</label>
                <input type="text" class="form-control mt-1" id="passWord" name="passWord" placeholder="Password">
            </div>
            <div class="mb-3">
                <label for="inputsubject">Confirm Password</label>
                <input type="text" class="form-control mt-1" id="comfirmPassword" name="comfirmPassword" placeholder="Confirm Password">
            </div>
            <div class="mb-3">
                <label for="inputsubject">Phone Number</label>
                <input type="text" class="form-control mt-1" id="phoneNumber" name="phoneNumber" placeholder="Phone Number">
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" class="btn btn-success btn-lg px-3">Register</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include ("inc/footer.php");
?>