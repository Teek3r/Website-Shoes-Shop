<?php
session_start();
include ("inc/init.php");
include ("inc/header.php");
$pdo = Database::getConnect($host, $db, $user, $password);
$data = cart::getAll($pdo);
?>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Mã đơn hàng</th>
            <th scope="col">Tên tài khoản </th>
            <th scope="col">Ngày đặt</th>
            <th scope="col">Tổng tiền</th>
            <th scope="col">Trạng thái thanh toán</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <th scope="row"><a href="/ShoesShop/admin/detailCart.php?idCart=<?= $row->idCart ?>"><?= $row->idCart ?></a></th>
                <td><?= $row->nameUser ?></td>
                <td><?= $row->dateOrder ?></td>
                <td><?= number_format($row->totalAmount, 0, ",", ".") ?></td>
                <td><?= $row->status ?></td>
            </tr> <?php endforeach ?>
    </tbody>
</table>
<?php
include ("inc/footer.php");
?>