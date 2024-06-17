<?php
session_start();
include ("inc/init.php");
include ("inc/header.php");


if (isset($_SESSION['user'])) {
    $nameUser = $_SESSION['user'];
    $data = cart::getAllByNameUser($pdo, $nameUser);
    $totalA = cart::getTotalAmount($pdo, $nameUser);
    $i = 1;
} else {
    echo '<script>window.location.href = "login.php";</script>';
}


?>
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">GIỎ HÀNG</h1>
    </div>
</div>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
            <th scope="col">Money</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <th scope="row"><?= $i ?></th>
                <td><?= $row->nameProduct ?></td>
                <td><?= $row->quantity ?></td>
                <td><?= number_format($row->money, 0, ",", ".") ?></td>
            </tr>
            <!-- <?= $i += 1; ?> -->
        <?php endforeach ?>
        <tr>
            <td colspan="3">Tổng tiền</td>
            <td class="text-danger"><?= number_format($totalA, 0, ",", ".") ?></td>
        </tr>
    </tbody>
</table>
<a class="btn btn-success" href="thanhtoan.php" role="button">Thanh toán</a>
<?php
include ("inc/footer.php");
?>