<?php
class product
{
    public $idProduct;
    public $nameProduct;
    public $price;
    public $description;
    public $brandName;
    public $image;
    public $idCatelogy;

    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM product";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "product");
            $data = $stmt->fetchAll();
            return $data;
        }

    }
    public static function getById($pdo, $id)
    {
        $sql = "SELECT * FROM product WHERE idProduct = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "product");
            return $stmt->fetch();
        }
    }
    public static function addProduct($pdo,$nameProduct,$price,$description,
    $brandName,$image,$idCatelogy)
    {
        $sql = "INSERT INTO product(nameProduct,price,description,brandName,image,idCatelogy)
        values (:nameProduct,:price,:description,:brandName,:image,:idCatelogy) "; 
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nameProduct", $nameProduct, PDO::PARAM_STR);
        $stmt->bindParam(":price", $price, PDO::PARAM_INT);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":brandName", $brandName,PDO::PARAM_STR);
        $stmt->bindParam(":image", $image, PDO::PARAM_STR);
        $stmt->bindParam(":idCatelogy", $idCatelogy, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public static function editProduct($pdo, $idProduct ,$nameProduct,$price,$description,
    $brandName,$image,$idCatelogy)
    {
        $sql = "UPDATE product SET nameProduct = :nameProduct, price = :price, 
        description = :description, brandName = :brandName, image = :image,  idProduct = :idProduct WHERE idProduct = :idProduct";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nameProduct", $nameProduct, PDO::PARAM_STR);
        $stmt->bindParam(":price", $price, PDO::PARAM_INT);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":brandName", $brandName, PDO::PARAM_STR);
        $stmt->bindParam(":image", $image, PDO::PARAM_STR);
        $stmt->bindParam(":idCatelogy", $idCatelogy, PDO::PARAM_INT);
        $stmt->bindParam("idProduct", $idProduct, PDO::PARAM_INT);
     
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public static function deleteProduct($pdo, $idProduct)
    {
        $sql = "DELETE FROM product WHERE idProduct = :idProduct";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":idProduct", $idProduct, PDO::PARAM_INT);
     
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}