<?php
include ("inc/init.php");
include ("inc/header.php");
$pdo = Database::getConnect($host, $db, $user, $password);
$data = catelogy::getAll($pdo);
?>
<a class="btn btn-info" href="addCatelogyAdmin.php" role="button">Add new catelogy</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <th scope="row"><?=$row->idCatelogy?></th>
                <td><?=$row->nameCatelogy?></td>
                <td><a class="btn btn-success" href="/ShoesShop/admin/editCatelogyAdmin.php?idCatelogy=<?=$row->idCatelogy?>" role="button">Edit</a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>


<?php

include ("inc/footer.php");
?>