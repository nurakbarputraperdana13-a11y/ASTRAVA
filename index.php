<?php
require_once __DIR__ . "/dbconn/conn.php";
session_start();

if (empty($_SESSION["id"])) {
    header('Location: view/auth/login.php');
    exit;
}
?>
<a href="/logic/auth/logout.php">log</a>