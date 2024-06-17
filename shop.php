<?php
session_start();
include ("inc/init.php");
include ("inc/header.php");


$host = "localhost";
$user = "admin_shoes";
$password = "thien12345";
$db = "shoesshop";


$pdo = Database::getConnect($host, $db, $user, $password);
$cate = $_GET['Cate'] ?? "";
$sort = $_GET['sort'] ?? "";
$page = $_GET['page'] ?? 1;
$brand = $_GET['brand'] ?? "";
$nameSearch = $_POST['search'] ?? "";
$ProductPerPage = 6;
$offset = ($page - 1) * $ProductPerPage;
$sql = "select * from product limit :limit offset :offset";
$result = $pdo->prepare($sql);
$result->bindParam(':limit', $ProductPerPage, PDO::PARAM_INT);
$result->bindParam(':offset', $offset, PDO::PARAM_INT);
if ($result->execute()) {
    $result->setFetchMode(PDO::FETCH_CLASS, "product");
    $data = $result->fetchAll();
}
$listBrand = product::getBrand($pdo);
$listCate = catelogy::getAll($pdo);
if ($sort == "ASC") {
    $data = product::getProductINPrice($pdo);
}
if ($sort == "DESC") {
    $data = product::getProductDEPrice($pdo); 
}
if ($brand != "") {
    $data = product::getByBrand($pdo, $brand);
}
if ($cate != "") {
    $data = product::getByIdCatelogy($pdo, $cate);
}
if ($nameSearch != "") {
    $data = product::searchByName($pdo, $nameSearch);
}
?>
<div class="container py-5">
    <div class="row">

        <div class="col-lg-3">
            <ul class="list-unstyled templatemo-accordion">
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Giá
                        <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul class="collapse show list-unstyled pl-3">
                        <li><a class="text-decoration-none" href="/ShoesShop/shop.php?sort=ASC&Cate=<?= $cate?>&page=<?= $page?>&brand=<?= $brand?>">Tăng dần</a></li>
                        <li><a class="text-decoration-none" href="/ShoesShop/shop.php?sort=DESC&Cate=<?= $cate?>&page=<?= $page?>&brand=<?= $brand?>">Giảm dần</a></li>
                    </ul>
                </li>
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Hãng
                        <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul id="collapseTwo" class="collapse list-unstyled pl-3">
                        <?php foreach ($listBrand as $row): ?>
                            <li><a class="text-decoration-none"
                                    href="/ShoesShop/shop.php?sort=<?= $sort?>&Cate=<?= $cate?>&page=<?= $page?>&brand=<?= $row?>"><?= $row ?></a></li>
                                    
                        <?php endforeach ?>
                    </ul>
                </li>
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Category
                        <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul id="collapseThree" class="collapse list-unstyled pl-3">
                        <?php foreach ($listCate as $row): ?>
                            <li><a class="text-decoration-none"
                                    href="/ShoesShop/shop.php?sort=<?= $sort?>&Cate=<?= $row->idCatelogy?>&page=<?= $page?>&brand=<?= $brand?>"><?= $row->nameCatelogy ?></a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-inline shop-top-menu pb-3 pt-1">
                        <form class="m-auto" method="POST">
                            <div class="input-group">
                                <input type="text" class="form-control" id="search" name="search"
                                    aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit" id="button-addon2">Tìm kiếm</button>
                                </div>
                            </div>
                        </form>    
                    </ul>
                </div>
            </div>


            <div class="row">
                <?php foreach ($data as $row): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="img/<?=$row->image?>">
                                <div
                                    class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn btn-success text-white"
                                                href="detailProduct.php?idProduct=<?= $row->idProduct ?>"><i
                                                    class="far fa-heart"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2"
                                                href="detailProduct.php?idProduct=<?= $row->idProduct ?>"><i
                                                    class="far fa-eye"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2"
                                                href="detailProduct.php?idProduct=<?= $row->idProduct ?>"><i
                                                    class="fas fa-cart-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="detailProduct.php?idProduct=<?= $row->idProduct ?>"
                                    class="h3 text-decoration-none"><?= $row->nameProduct ?></a>
                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <li class="pt-2">
                                        <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                        <span
                                            class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                        <span
                                            class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                        <span
                                            class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                        <span
                                            class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                    </li>
                                </ul>
                                <p class="text-center mb-0 text-danger"><?= number_format($row->price, 0, ",", ".") ?>đ</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link"
                                href="/ShoesShop/shop.php?sort=<?= $sort?>&Cate=<?= $cate?>&page=<?= $page-1?>&brand=<?= $brand?>">Previous</a></li>
                        <?php if ($page - 1 > 0): ?>
                            <li class="page-item"><a class="page-link"
                                    href="/ShoesShop/shop.php?sort=<?= $sort?>&Cate=<?= $cate?>&page=<?= $page-1?>&brand=<?= $brand?>"><?= $page - 1 ?></a></li>
                        <?php endif; ?>
                        <li class="page-item"><a class="page-link"
                                href="/ShoesShop/shop.php?sort=<?= $sort?>&Cate=<?= $cate?>&page=<?= $page?>&brand=<?= $brand?>"><?= $page ?></a></li>
                        <li class="page-item"><a class="page-link"
                                href="/ShoesShop/shop.php?sort=<?= $sort?>&Cate=<?= $cate?>&page=<?= $page+1?>&brand=<?= $brand?>"><?= $page + 1 ?></a></li>
                        <li class="page-item"><a class="page-link"
                                href="/ShoesShop/shop.php?sort=<?= $sort?>&Cate=<?= $cate?>&page=<?= $page+1?>&brand=<?= $brand?>">Next</a></li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>



<?php
include ("inc/footer.php");
?>