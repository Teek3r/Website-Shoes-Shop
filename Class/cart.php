<?php

class Cart
{
    public $idCart;
    public $nameUser;
    public $dateOrder;
    public $totalAmount;
    public $status;

    public static function createCart($pdo, $nameUser, $dateOrder, $totalAmount, $status)
    {
        $sql = "INSERT INTO cart(nameUser,dateOrder,totalAmount,status)
         values (:nameUser,:dateOrder,:totalAmount,:status) ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nameUser", $nameUser, PDO::PARAM_STR);
        $stmt->bindParam(":dateOrder", $dateOrder, PDO::PARAM_STR);
        $stmt->bindParam(":totalAmount", $totalAmount, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $pdo->lastInsertId();
        }
    }
    public static function checkCart($pdo, $nameUser)
    {
        $sql = "SELECT * FROM `cart` WHERE nameUser = :nameUser AND status = 0";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nameUser", $nameUser, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetch();
        }
    }

    public static function getAllByNameUser($pdo, $nameUser)
    {
        $sql = "SELECT *
    FROM 
        detailcart, 
        cart,
        product
    WHERE 
        detailcart.idCart = cart.idCart 
        AND detailcart.idProduct = product.idProduct
        AND cart.nameUser = :nameUser
        AND cart.status = 0;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nameUser", $nameUser, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "detailCart");
            return $stmt->fetchAll();
        }
        return [];
    }
    public static function getTotalAmount($pdo, $nameUser)
    {
        $sql = "SELECT totalAmount 
           FROM cart 
           WHERE nameUser = :nameUser
             AND status = 0;";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nameUser', $nameUser, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $totalAmount = $stmt->fetch(PDO::FETCH_COLUMN);
            return $totalAmount !== false ? $totalAmount : 0;
        }

        return 0;
    }
    public static function countDetail($pdo, $nameUser)
    {
        $sql = "SELECT COUNT(*) 
           FROM cart 
           WHERE nameUser = :nameUser
             AND status = 0;";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nameUser', $nameUser, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_COLUMN);
        }
        return 0;
    }
    public static function thanhToan($pdo, $nameUser)
    {
        $sql = "UPDATE cart 
            SET status = 1
            WHERE nameUser = :nameUser AND status = 0";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nameUser", $nameUser, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true; // Cập nhật thành công
        } else {
            return false; // Cập nhật thất bại
        }
    }
}