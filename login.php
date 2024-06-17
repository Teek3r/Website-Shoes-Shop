<?php
session_start();
include ("inc/header.php");
include ("inc/init.php");
$pdo = Database::getConnect($host, $db, $user, $password);
$error = "";
$nameUser = "";
$passWord = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") 
{

    $nameUser = $_POST["nameUser"];
    $passWord = $_POST["passWord"];
    $data = User::getById($pdo,$_POST["nameUser"]);
    $role = $data->idRole;
    if (!empty($_POST["nameUser"]) && !empty($_POST["passWord"])) {
        if ($_POST["nameUser"] == $data->nameUser && $_POST["passWord"] == $data->passWord) 
        {
            $_SESSION['user'] = $nameUser;
            $_SESSION['role'] = $role;
            if ($_SESSION['role'] == 3) {
                echo '<script>window.location.href = "index.php";</script>';
            }else{
                echo '<script>window.location.href = "/ShoesShop/admin/index.php";</script>';
            }
            exit();
        }else{
            $error = "Tài khoản hoặc mật khẩu không đúng";
        }
    }
}
?>

<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Login</h1>
    </div>
</div>
<div class="container py-5">
    <div class="row py-5">
        <form  class="col-md-9 m-auto" method="post" role="form">
            
            <div class="mb-3">
                <label for="inputsubject">Username</label>
                <input type="text" class="form-control mt-1" id="nameUser" name="nameUser" placeholder="Username">
            </div>
            <div class="mb-3">
                <label for="inputsubject">Password</label>
                <input type="password" class="form-control mt-1" id="passWord" name="passWord" placeholder="Password">
                <span class="text-danger"><?= $error ?></span>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" class="btn btn-success btn-lg px-3">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include ("inc/footer.php");
?>