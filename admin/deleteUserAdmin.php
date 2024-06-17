<?php
include ("inc/init.php");
include ("inc/header.php");
$id = $_GET['nameUser'];
$pdo = Database::getConnect($host, $db, $user, $password);
$data = User::getById($pdo,$id);

$nameUser = $data->nameUser;
$passWord = $data->passWord ;
$idRole = $data->idRole;
$name = $data->name;
$email = $data->email;
$phoneNumber = $data->phoneNumber;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data =  User::deleteUser($pdo,$id);
    // header("location:productAdmin.php");
    // exit();
    echo '<script>window.location.href = "/ShoesShop/admin/productAdmin.php";</script>';
}
?>
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto" method="post" role="form">

            <div class="mb-3">
                <label for="inputsubject">nameUse/label>
                <input disabled type="text" class="form-control mt-1" id="nameUser" name="nameUser"
                    placeholder="nameUser" value="<?=$nameUser?>">
            </div>
            <div class="mb-3">
                <label for="inputsubject">passWord</label>
                <input disabled type="text" class="form-control mt-1" id="passWord" name="passWord" placeholder="passWord" value=<?= $passWord?>>
            </div>
            <div class="mb-3">
                <label for="inputsubject">idRole</label>
                <textarea disabled class="form-control" id="idRole" name="idRole" cols="30" rows="10">
                <?= $idRole ?>
                </textarea>
            </div>
            <div class="mb-3">
                <label for="inputsubject">name </label>
                <input disabled type="text" class="form-control mt-1" id="name" name="name" placeholder="name"
                    value=<?= $name ?>>
            </div>

            <div class="mb-3">
                <label for="inputsubject">email</label>
                <input  type="text" class="form-control mt-1" id="email" name="email" placeholder="email"
                    value=<?= $email ?>>
            </div>
            <div class="mb-3">
                <label for="inputsubject">phoneNumber</label>
                <input disabled type="text" class="form-control mt-1" id="phoneNumber" name="phoneNumber" placeholder="phoneNumber"
                    value=<?= $phoneNumber ?>>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" class="btn btn-danger btn-lg px-3">Delete</button>
                </div>
                <div class="col text-end mt-2">
                    <a class="btn btn-success" href="/ShoesShop/admin/userAdmin.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php

include ("inc/footer.php");
?>