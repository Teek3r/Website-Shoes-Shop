<?php
session_start();
include ("inc/header.php");
include ("inc/init.php");
$id = $_GET['idProduct'];
$host = "localhost";
$user = "admin_shoes";
$password = "thien12345";
$db = "shoesshop";

$pdo = Database::getConnect($host, $db, $user, $password);
$data = product::getById($pdo, $id);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_SESSION['user'])) {
        $quan = $_POST['quantity'];
        $idPro = $data->idProduct;
        $aw = Cart::checkCart($pdo, $_SESSION['user']);
        $nameUser = $_SESSION['user'];
        if (!$aw) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $dateOrder = date('Y-m-d H:i:s');
            $idCart = Cart::createCart($pdo, $nameUser, $dateOrder, 0, 0);
            $a = detailCart::addProductToCart($pdo, $idPro, $idCart, $quan);

        } else {
            $a = detailCart::addProductToCart($pdo, $idPro, $aw['idCart'], $quan);
        }
    }else{
        echo '<script>window.location.href = "login.php";</script>';
    }
}
?>
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" src="img/<?= $data->image ?>" alt="Card image cap"
                        id="product-detail">
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2"><?= $data->nameProduct ?></h1>
                        <p class="h3 py-2 text-danger"> <?= number_format($data->price, 0, ".", ",") ?>đ</p>
                        <p class="py-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <span class="list-inline-item text-dark">Rating 4.8 | 36 Comments</span>
                        </p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Brand:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong> <?= $data->brandName ?></strong></p>
                            </li>
                        </ul>

                        <h6>Description:</h6>
                        <p><?= $data->description ?></p>
                        <form action="/ShoesShop/detailProduct.php?idProduct=<?= $data->idProduct ?>" method="POST">
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item text-right">
                                            Quantity
                                            <input type="number" id="quantity" name="quantity">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="submit"
                                        value="addtocard">Add To Cart</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include ("inc/footer.php");
?>