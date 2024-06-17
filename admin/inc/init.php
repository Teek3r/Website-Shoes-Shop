<?php

include("Class/product.php");
include("Class/catelogy.php");
include("Class/user.php");
include("Class/detailcart.php");
include("Class/cart.php");
include("Class/role.php");
include("Class/Database.php");

$host = "localhost";
$user = "admin_shoes";
$password = "thien12345";
$db = "shoesshop";

$pdo = Database::getConnect($host,$db, $user, $password);
// $data = product::getAll($pdo);


