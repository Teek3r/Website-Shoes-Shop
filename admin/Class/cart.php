<?php
class cart{
    public $idCart;
    public $nameUser;
    public $dateOrder;
    public $totalAmount;
    public $status ;
    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM cart";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "cart");
            return $stmt->fetchAll();
        }
        return [];
    }
    public static function getTotalAmount($pdo, $nameUser)
    {
        $sql = "SELECT totalAmount 
           FROM cart 
           WHERE nameUser = :nameUser";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nameUser', $nameUser, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $totalAmount = $stmt->fetch(PDO::FETCH_COLUMN);
            return $totalAmount !== false ? $totalAmount : 0;
        }

        return 0;
    }
    public static function getAllByIdCart($pdo, $idCart)
    {
        $sql = "SELECT *
    FROM 
        detailcart, 
        cart,
        product
    WHERE 
        detailcart.idCart = cart.idCart 
        AND detailcart.idProduct = product.idProduct
        AND cart.idCart = :idCart";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":idCart", $idCart, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "detailCart");
            return $stmt->fetchAll();
        }
        return [];
    }
}
