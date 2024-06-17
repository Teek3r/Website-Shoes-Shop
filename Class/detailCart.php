<?php

class detailCart{
    public $idProduct;
    public $idCart;
    public $quantity;
    public $money;

    public static function getAllByIdCart($pdo, $id)
    {
        $sql = "SELECT * FROM detailCart WHERE idCart = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "detailCart");
            return $stmt->fetch();
        }
    }
    public static function addProductToCart($pdo, $idProduct, $idCart, $quantity)
    {
        $sql = "INSERT INTO detailcart(idProduct,idCart,quantity) values (:idProduct,:idCart,:quantity) ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":idProduct", $idProduct, PDO::PARAM_STR);
        $stmt->bindParam(":idCart", $idCart, PDO::PARAM_INT);
        $stmt->bindParam(":quantity", $quantity, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public static function updateProductInCart($pdo, $idProduct, $idCart, $quantity)
    {
        $sql = "UPDATE detailcart SET idProduct = :idProduct, idCart = :idCart, 
         quantity = :quantity WHERE idProduct = :idProduct AND idCart = :idCart";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":idProduct", $idProduct, PDO::PARAM_INT);
        $stmt->bindParam(":idCart", $idCart, PDO::PARAM_INT);
        $stmt->bindParam(":quantity", $quantity, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public static function deleteProductInCart($pdo, $idProduct, $idCart)
    {
        $sql = "DELETE FROM detailCart WHERE idProduct = :idProduct AND idCart = :idCart";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":idProduct", $idProduct, PDO::PARAM_INT);
        $stmt->bindParam(":idCart",$idCart, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}