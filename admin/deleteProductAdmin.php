<?php
include ("inc/init.php");
include ("inc/header.php");
?>
<?php
$id = $_GET['idProduct'];
$pdo = Database::getConnect($host, $db, $user, $password);
$data = product::getById($pdo, $id);

$nameProduct = $data->nameProduct;
$price = $data->price;
$description = $data->description;
$brandName = $data->brandName;
$image = $data->image;
$idCatelogy = $data->idCatelogy;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data = product::deleteProduct($pdo,$id);
    echo '<script>window.location.href = "/ShoesShop/admin/productAdmin.php";</script>';
    exit();
}
?>
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto" method="post" role="form">

            <div class="mb-3">
                <label for="inputsubject">Name Product</label>
                <input disabled type="text" class="form-control mt-1" id="nameProduct" name="nameProduct"
                    placeholder="Name Product" value="<?=$nameProduct?>">
            </div>
            <div class="mb-3">
                <label for="inputsubject">Price</label>
                <input disabled type="text" class="form-control mt-1" id="price" name="price" placeholder="Price" value=<?= $price ?>>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Description</label>
                <textarea disabled class="form-control" id="description" name="description" cols="30" rows="10">
                <?= $description ?>
                </textarea>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Brand Name</label>
                <input disabled type="text" class="form-control mt-1" id="brandName" name="brandName" placeholder="Brand Name"
                    value=<?= $brandName ?>>
            </div>

            <div class="mb-3">
                <label for="inputsubject">Image</label>
                <input  type="text" class="form-control mt-1" id="image" name="image" placeholder="Image"
                    value=<?= $image ?>>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Catelogy</label>
                <input disabled type="text" class="form-control mt-1" id="idCatelogy" name="idCatelogy" placeholder="Catelogy"
                    value=<?= $idCatelogy ?>>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" class="btn btn-danger btn-lg px-3">Delete</button>
                </div>
                <div class="col text-end mt-2">
                    <a class="btn btn-success" href="/ShoesShop/admin/productAdmin.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php

include ("inc/footer.php");
?>