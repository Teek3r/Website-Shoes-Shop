<?php
include ("inc/init.php");
include ("inc/header.php");
$pdo = Database::getConnect($host, $db, $user, $password);
$nameCatelogyError = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nameCatelogy = $_POST["nameCatelogy"];
    if (empty($nameCatelogy)) {
        $nameProductError = "Chưa nhập tên sản phẩm";
    }
    $data = catelogy::addCate($pdo, $nameCatelogy);
    echo '<script>window.location.href = "catelogyAdmin.php";</script>';
    exit();
}

?>
<div class="container py-5">
    <div class="row py-5">
        <form action="addCatelogyAdmin.php" class="col-md-9 m-auto" method="post" role="form">

            <div class="mb-3">
                <label for="inputsubject">Name Catelogy</label>
                <input type="text" class="form-control mt-1" id="nameCatelogy" name="nameCatelogy"
                    placeholder="Name Catelogy">
                <span class="text-danger"><?= $nameCatelogyError ?></span>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" class="btn btn-success btn-lg px-3">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php

include ("inc/footer.php");
?>