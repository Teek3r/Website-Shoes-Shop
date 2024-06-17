<?php
session_start();
include ("inc/init.php");
include ("inc/header.php");
$nameUser = $_SESSION['user'];
$id = $_GET['idCart'];
$data = cart::getAllByIdCart($pdo,$id);
$i = 1;
?>
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
    </tbody>
</table>
<?php
include ("inc/footer.php");
?>