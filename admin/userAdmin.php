<?php
include ("inc/init.php");
include ("inc/header.php");
$pdo = Database::getConnect($host, $db, $user, $password);
$data = User::getAll($pdo);
?>
<a class="btn btn-info" href="addUserAdmin.php" role="button">Add new user</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">User name</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Edit</th>
            <th scope="col">Remove</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <th scope="row"><?=$row->nameUser?></th>
                <td><?=$row->name?></td>
                <td><?=$row->email?></td>
                <td><?=$row->phoneNumber?></td>
                <td><a class="btn btn-success" href="/ShoesShop/admin/editUserAdmin.php?nameUser=<?=$row->nameUser?>" role="button">Edit</a></td>
                <td><a class="btn btn-danger" href="/ShoesShop/admin/deleteUserAdmin.php?nameUser=<?=$row->nameUser?>"role="button">Remove</a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>


<?php

include ("inc/footer.php");
?>