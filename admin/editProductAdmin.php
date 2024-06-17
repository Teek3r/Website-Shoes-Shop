<?php
include ("inc/init.php");
include ("inc/header.php");
$id = $_GET['idProduct'];
$pdo = Database::getConnect($host, $db, $user, $password);
$data = product::getById($pdo, $id);
$listCate = catelogy::getAll($pdo);
$nameProduct = $data->nameProduct;
$price = $data->price;
$description = $data->description;
$brandName = $data->brandName;
$image = $data->image;
$idCatelogy = $data->idCatelogy;


$nameProductError = "";
$priceError = "";
$descriptionError = "";
$brandNameError = "";
$imageError = "";
$idCatelogyError = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nameProduct = $_POST["nameProduct"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $brandName = $_POST["brandName"];
    $image = $_POST["image"];
    $idCatelogy = $_POST["idCatelogy"];
    if (empty($nameProduct)) {
        $nameProductError = "Chưa nhập tên sản phẩm";
    }
    if (empty($price)) {
        $priceError = "Chưa nhập giá sản phẩm";
    } else if ($price < 1000) {
        $priceError = "Giá sản phẩm phải lớn hơn 1000";
    }
    if (empty($description)) {
        $descriptionError = "Chưa nhập mô tả sản phẩm";
    }
    if (empty($brandName)) {
        $brandNameError = "Chưa nhập hãng sản phẩm";
    }
    if (empty($image)) {
        $imageError = "Chưa có hình sản phẩm";
    }
    if (empty($idCatelogy)) {
        $idCatelogyError = "Chưa nhập loại sản phẩm ";
    }
    if (
        !empty($nameProduct) && !empty($price) && !empty($description) && !empty($brandName)
        && !empty($image) && !empty($idCatelogy)
    ) {
        $data = product::editProduct($pdo,$id, $nameProduct, $price, $description, $brandName, $image, $idCatelogy);
        echo '<script>window.location.href = "/ShoesShop/admin/productAdmin.php";</script>';
        
    } else {
        echo 'that bai';
    }
}
?>
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto" method="post" role="form">

            <div class="mb-3">
                <label for="inputsubject">Name Product</label>
                <input type="text" class="form-control mt-1" id="nameProduct" name="nameProduct"
                    placeholder="Name Product" value="<?=$nameProduct?>">
                <span class="text-danger"><?= $nameProductError ?></span>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Price</label>
                <input type="text" class="form-control mt-1" id="price" name="price" placeholder="Price"
                    value=<?= $price ?>>
                <span class="text-danger"><?= $priceError ?></span>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Description</label>
                <textarea class="form-control" id="description" name="description" cols="30" rows="10">
                <?= $description ?>
                </textarea>
                <span class="text-danger"><?= $descriptionError ?></span>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Brand Name</label>
                <input type="text" class="form-control mt-1" id="brandName" name="brandName" placeholder="Brand Name"
                    value=<?= $brandName ?>>
                <span class="text-danger"><?= $brandNameError ?></span>
            </div>

            <div class="mb-3">
                <label for="inputsubject">Image</label>
                <input type="text" class="form-control mt-1" id="image" name="image" placeholder="Image"
                    value=<?= $image ?>>
                <span class="text-danger"><?= $imageError ?></span>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Catelogy</label>
                <select class="form-select" id="idCatelogy" name="idCatelogy">
                    <?php foreach ($listCate as $row): ?>
                        <option value="<?= $row->idCatelogy ?>"><?= $row->nameCatelogy ?></option>
                    <?php endforeach ?>
                </select>
                <span class="text-danger"><?= $idCatelogyError ?></span>
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