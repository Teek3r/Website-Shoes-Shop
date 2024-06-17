<?php
session_start();
include ("inc/init.php");
include ("inc/header.php");
$nameUser = $_SESSION['user'];
if (isset($_SESSION['user'])) {
    $data = user::getById($pdo, $nameUser);
}else{
    echo '<script>window.location.href = "login.php";</script>';
}

?>
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">THÔNG TIN CÁ NHÂN</h1>
    </div>
</div>
<table class="table">
    <tbody>
        <tr>
            <th scope="row">Name user</th>
            <td><?= $data->nameUser ?></td>
        </tr>
        <tr>
            <th scope="row">Password</th>
            <td><?= $data->passWord ?></td>
        </tr>
        <tr>
            <th scope="row">Name</th>
            <td><?= $data->name ?></td>
        </tr>
        <tr>
            <th scope="row">Email</th>
            <td><?= $data->email ?></td>
        </tr>
        <tr>
            <th scope="row">Phone number</th>
            <td><?= $data->phoneNumber ?></td>
        </tr>
    </tbody>
</table>
<?php
include ("inc/footer.php");
?>