<?php
class User{
    public $nameUser;
    public $passWord;
    public $idRole;
    public $name;
    public $email;
    public $phoneNumber;
    public static function getAll($pdo) {
        $sql = "SELECT * FROM user";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
            $data = $stmt->fetchAll();
            return $data;
        }
    }

    public static function getById($pdo, $nameUser) {
        $sql = "SELECT * FROM user WHERE nameUser = :nameUser";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nameUser", $nameUser, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
            return $stmt->fetch();
        }
    }

    public static function addUser($pdo, $nameUser, $passWord, $idRole, $name, $email, $phoneNumber) {
        $sql = "INSERT INTO user(nameUser, passWord, idRole, name, email, phoneNumber)
        VALUES (:nameUser, :passWord, :idRole, :name, :email, :phoneNumber)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nameUser", $nameUser, PDO::PARAM_STR);
        $stmt->bindParam(":passWord", $passWord, PDO::PARAM_STR);
        $stmt->bindParam(":idRole", $idRole, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public static function register($pdo, $nameUser, $passWord, $name, $email, $phoneNumber) {
        $sql = "INSERT INTO user(nameUser, passWord, idRole, name, email, phoneNumber)
        VALUES (:nameUser, :passWord, :idRole, :name, :email, :phoneNumber)";
        $idRole = 3;
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nameUser", $nameUser, PDO::PARAM_STR);
        $stmt->bindParam(":passWord", $passWord, PDO::PARAM_STR);
        $stmt->bindParam(":idRole", $idRole , PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_STR);
        if ($stmt->execute()) 
        {
            return true;
        }
        return false;
    }

    public static function editUser($pdo, $idUser, $passWord, $idRole, $name, $email, $phoneNumber) {
        $sql = "UPDATE user SET passWord = :passWord, idRole = :idRole, name = :name, email = :email, phoneNumber = :phoneNumber WHERE nameUser = '$idUser'";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":passWord", $passWord, PDO::PARAM_STR);
        $stmt->bindParam(":idRole", $idRole, PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public static function deleteUser($pdo, $idUser) {
        $sql =  "DELETE FROM user WHERE nameUser = '$idUser'";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":idUser", $idUser, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }   
}