<?php
include ("inc/init.php");
include ("inc/header.php");
$pdo = Database::getConnect($host, $db, $user, $password);
$listCate = catelogy::getAll($pdo);
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
    if (empty($idCatelogy)) {
        $idCatelogyError = "Chưa nhập loại sản phẩm ";
    }
    var_dump($_FILES['image']);
    $file_image = $_FILES['image'];
    if (!empty($file_image['name'])) {
        switch ($file_image['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                $imageError = "No file image";
                break;
            default:
                $imageError = "Invalid file";
        }
        if ($file_image['size'] > 1000000) {
            $imageError = "Image too large";
        }

        $myex = ['image/jpeg', 'image/png', 'image/webp'];
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileType = finfo_file($fileInfo, $file_image['tmp_name']);

        // echo $fileType;
        if (!in_array($fileType, $myex)) {
            $imageError = "Invalid extension";
        }

        //save image
        if (empty($imageError)) {
            $pathinfo = pathinfo($file_image['name']);
            $ex = $pathinfo['extension'];

            $folder = '../img/';
            $file = 'image.' . $ex;
            $dir_save = $folder . $file;
            $i = 1;
            while (file_exists($dir_save)) {
                $file = 'image-' . $i . '.' . $ex;
                $dir_save = $folder . $file;
                $i++;
            }

            if (move_uploaded_file($file_image['tmp_name'], $dir_save)) {
                $image = $file;
            }
        }
    } else {
        $imageError = "Empty image";
    }
    if (
        !empty($nameProduct) && !empty($price) && !empty($description) && !empty($brandName)
        && !empty($image) && !empty($idCatelogy)
    ) {
        $data = product::addProduct($pdo, $nameProduct, $price, $description, $brandName, $image, $idCatelogy);
        $message = "Thêm sản phẩm thành công";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo '<script>window.location.href = "/ShoesShop/admin/productAdmin.php";</script>';
    } else {
        $message = "Thêm sản phẩm thất bại";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
?>
<div class="container py-5">
    <div class="row py-5">
        <form action="addProductAdmin.php" class="col-md-9 m-auto" method="post" role="form" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="inputsubject">Name Product</label>
                <input type="text" class="form-control mt-1" id="nameProduct" name="nameProduct"
                    placeholder="Name Product">
                <span class="text-danger"><?= $nameProductError ?></span>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Price</label>
                <input type="text" class="form-control mt-1" id="price" name="price" placeholder="Price">
                <span class="text-danger"><?= $priceError ?></span>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Description</label>
                <textarea class="form-control" id="description" name="description" cols="30" rows="10">

                </textarea>
                <span class="text-danger"><?= $descriptionError ?></span>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Brand Name</label>
                <input type="text" class="form-control mt-1" id="brandName" name="brandName" placeholder="Brand Name">
                <span class="text-danger"><?= $brandNameError ?></span>
            </div>

            <div class="mb-3">
                <label for="inputsubject">Image</label>
                <input type="file" class="form-control mt-1" id="image" name="image">
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
                    <button type="submit" class="btn btn-success btn-lg px-3">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php

include ("inc/footer.php");
?>