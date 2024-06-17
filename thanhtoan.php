<?php
session_start();
include ("inc/init.php");
include ("inc/header.php");
$nameUser = $_SESSION['user'];
$data = cart::getAllByNameUser($pdo, $nameUser);
$user = user::getById($pdo, $nameUser);
$totalA = cart::getTotalAmount($pdo, $nameUser);

$i = 1;
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $thanhToan = cart::thanhToan($pdo,$nameUser);
    echo '<script>window.location.href = "cart.php";</script>';
}
?>
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">THÔNG TIN ĐƠN HÀNG</h1>
    </div>
</div>
<table class="table">
    <tbody>
        <tr>
            <th scope="row">Name user</th>
            <td><?= $user->nameUser ?></td>
        </tr>
        <tr>
            <th scope="row">Name</th>
            <td><?= $user->name ?></td>
        </tr>
        <tr>
            <th scope="row">Email</th>
            <td><?= $user->email ?></td>
        </tr>
        <tr>
            <th scope="row">Phone number</th>
            <td><?= $user->phoneNumber ?></td>
        </tr>
    </tbody>
</table>
<table class="table">
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
<form class="col-md-9 m-auto" method="post" role="form">
    <div class="col text-end mt-2">
        <button type="submit" class="btn btn-danger btn-lg px-3">Xác nhận giao hàng</button>
    </div>
</form>
<?php
include ("inc/footer.php");
?>