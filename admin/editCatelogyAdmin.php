<?php
include ("inc/init.php");
include ("inc/header.php");
$id = $_GET['idCatelogy'];
$pdo = Database::getConnect($host, $db, $user, $password);
$data = catelogy::getById($pdo, $id);

$nameCatelogy = $data->nameCatelogy;
$nameCatelogyError = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nameCatelogy = $_POST["nameCatelogy"];
    if (empty($nameCatelogy)) {
        $nameCatelogyError = "Chưa nhập tên sản phẩm";
    }
    $data = catelogy::editCatelogy($pdo, $id, $nameCatelogy);
    echo '<script>window.location.href = "/ShoesShop/admin/catelogyAdmin.php";</script>';
}

?>
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto" method="post" role="form">

            <div class="mb-3">
                <label for="inputsubject">Name Catelogy</label>
                <input type="text" class="form-control mt-1" id="nameCatelogy" name="nameCatelogy"
                    placeholder="Name Catelogy" value="<?= $nameCatelogy ?>">
                <span class="text-danger"><?= $nameCatelogyError?></span>
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