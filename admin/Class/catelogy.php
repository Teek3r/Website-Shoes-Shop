<?php
class catelogy
{
    public $idCatelogy;
    public $nameCatelogy;
    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM catelogy";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "catelogy");
            $data = $stmt->fetchAll();
            return $data;
        }

    }
    public static function getById($pdo, $id)
    {
        $sql = "SELECT * FROM catelogy WHERE idCatelogy = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "catelogy");
            return $stmt->fetch();
        }
    }
    public static function addCate($pdo, $nameCatelogy)
    {
        $sql = "INSERT INTO catelogy (nameCatelogy) VALUES (:nameCatelogy)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nameCatelogy", $nameCatelogy, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public static function editCatelogy($pdo, $idCatelogy, $nameCatelogy)
    {
        $sql = "UPDATE catelogy SET nameCatelogy = :nameCatelogy WHERE idCatelogy = :idCatelogy";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nameCatelogy", $nameCatelogy, PDO::PARAM_STR);
        $stmt->bindParam(":idCatelogy", $idCatelogy, PDO::PARAM_INT);
     
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}