<?php
include ("inc/init.php");
include ("inc/header.php");
$id = $_GET['nameUser'];
$pdo = Database::getConnect($host, $db, $user, $password);
$data = User::getById($pdo, $id);

$nameUser = $data->nameUser;
$passWord = $data->passWord;
$idRole = $data->idRole;
$name = $data->name;
$email = $data->email;
$phoneNumber = $data->phoneNumber;

$nameUserError = "";
$passWordError = "";
$idRoleError = "";
$nameError = "";
$emailError = "";
$phoneNumberError = "";
$listRole = role::getAll($pdo);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nameUser = $id;
    $passWord = $_POST["passWord"];
    $idRole = $_POST["idRole"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    if (empty($password)) {
        $passWordError = "Chưa nhập nameuser";
    }
    if (!empty($nameUser) && !empty($password) && !empty($idRole) && !empty($name) && !empty($email) && !empty($phoneNumber)) {
        $data = User::editUser(
            $pdo,
            $nameUser,
            $passWord,
            $idRole,
            $name,
            $email,
            $phoneNumber
        );
        echo '<script>window.location.href = "/ShoesShop/admin/userAdmin.php";</script>';
        exit();
    }else{
        $message = "Sửa thất bại";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

}

?>
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto" method="post" role="form">

            <div class="mb-3">
                <label for="inputsubject">nameUser</label>
                <input disabled type="text" class="form-control mt-1" id="nameUser" name="nameUser"
                    placeholder="nameUser" value="<?= $nameUser ?>">
                <span class="text-danger"><?= $nameUserError ?></span>
            </div>
            <div class="mb-3">
                <label for="inputsubject">passWord</label>
                <input type="text" class="form-control mt-1" id="passWord" name="passWord" placeholder="passWord"
                    value="<?= $passWord ?>">
                <span class="text-danger"><?= $passWordError ?></span>
            </div>
            <div class="mb-3">
                <label for="inputsubject">idRole</label>
                <select class="form-select" id="idRole" name="idRole">
                    <?php foreach ($listRole as $row): ?>
                        <option value="<?= $row->idRole ?>"><?= $row->nameRole ?></option>
                    <?php endforeach ?>
                </select>
                <span class="text-danger"><?= $idRoleError ?></span>
            </div>
            <div class="mb-3">
                <label for="inputsubject">name</label>
                <input type="text" class="form-control mt-1" id="name" name="name" placeholder="name"
                    value="<?= $name ?>">
                <span class="text-danger"><?= $nameError ?></span>
            </div>
            <div class="mb-3">
                <label for="inputsubject">email</label>
                <input type="text" class="form-control mt-1" id="email" name="email" placeholder="email"
                    value="<?= $email ?>">
                <span class="text-danger"><?= $emailError ?></span>
            </div>
            <div class="mb-3">
                <label for="inputsubject">phoneNumber</label>
                <input type="text" class="form-control mt-1" id="phoneNumber" name="phoneNumber"
                    placeholder="phoneNumber" value="<?= $phoneNumber ?>">
                <span class="text-danger"><?= $phoneNumberError ?></span>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" class="btn btn-success btn-lg px-3">Edit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php

include ("inc/footer.php");
?>