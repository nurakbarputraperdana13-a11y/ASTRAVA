<?php 
    $localhost = "127.0.0.1";
    $username = "root";
    $pass = "";
    $db ="db_astrava";
    $charset = 'utf8mb4';

    $conn = "mysql:host=$localhost;dbname=$db;charset=$charset";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try{
        $pdo = new PDO($conn, $username, $pass, $options);
        return $pdo;
    }catch(PDOException $e){
        die("Koneksi DB gagal:" . $e->getMessage());
    }
?>