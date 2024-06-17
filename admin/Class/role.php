<?php
class role{
    public $idRole;
    public $nameRole;
    public static function getAll($pdo) {
        $sql = "SELECT * FROM role";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "role");
            $data = $stmt->fetchAll();
            return $data;
        }
    }
}