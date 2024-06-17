<?php
include ("inc/init.php");
include ("inc/header.php");
$pdo = Database::getConnect($host, $db, $user, $password);
$data = product::getAll($pdo);
?>
<a class="btn btn-info" href="addProductAdmin.php" role="button">Add new product</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Edit</th>
            <th scope="col">Remove</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <th scope="row"><?=$row->idProduct?></th>
                <td><?=$row->nameProduct?></td>
                <td><?= number_format($row->price,0,",",".") ?></td>
                <td><a class="btn btn-success" href="/ShoesShop/admin/editProductAdmin.php?idProduct=<?=$row->idProduct?>" role="button">Edit</a></td>
                <td><a class="btn btn-danger" href="/ShoesShop/admin/deleteProductAdmin.php?idProduct=<?=$row->idProduct?>"role="button">Remove</a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>


<?php

include ("inc/footer.php");
?>