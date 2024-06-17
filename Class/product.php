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
    public static function addProduct(
        $pdo,
        $nameProduct,
        $price,
        $description,
        $brandName,
        $image,
        $idCatelogy
    ) {
        $sql = "INSERT INTO product(nameProduct,price,description,brandName,image,idCatelogy)
        values (:nameProduct,:price,:description,:brandName,:image,:idCatelogy) ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nameProduct", $nameProduct, PDO::PARAM_STR);
        $stmt->bindParam(":price", $price, PDO::PARAM_INT);
        $stmt->bindParam(":description", $description, PDO::PARAM_STR);
        $stmt->bindParam(":brandName", $brandName, PDO::PARAM_STR);
        $stmt->bindParam(":image", $image, PDO::PARAM_STR);
        $stmt->bindParam(":idCatelogy", $idCatelogy, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public static function getProductINPrice($pdo)
    {
        $sql = "SELECT * FROM product ORDER BY price ASC;";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "product");
            $data = $stmt->fetchAll();
            return $data;
        }
    }
    public static function getProductDEPrice($pdo)
    {
        $sql = "SELECT * FROM product ORDER BY price DESC;";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "product");
            $data = $stmt->fetchAll();
            return $data;
        }
    }
    public static function getBrand($pdo)
    {
        $sql = "SELECT DISTINCT brandName FROM product";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $data = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
            return $data;
        }
        return [];
    }
    public static function getByBrand($pdo, $brand)
    {
        $sql = "SELECT * FROM product WHERE brandName = :brand";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":brand", $brand, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "product");
            $data = $stmt->fetchAll();
            return $data;
        }
    }
    public static function getByIdCatelogy($pdo, $id)
    {
        $sql = "SELECT * FROM product WHERE idCatelogy = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "product");
            $data = $stmt->fetchAll();
            return $data;
        }
    }
    public static function searchByName($pdo, $productName)
{
    $sql = "SELECT * FROM product WHERE nameProduct LIKE CONCAT('%', :name, '%')";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $productName, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $stmt->setFetchMode(PDO::FETCH_CLASS, "product");
        $data = $stmt->fetchAll();
        return $data;
    }

    return null;
}
}