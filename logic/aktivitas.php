<?php 
require_once __DIR__ . "../../dbconn/conn.php";
    session_start();


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["submit-fisik"])){
            $idUser = $_SESSION["id"];
            $namaAktivitas = $_POST["aktivitas"];
            $durasi = $_POST["durasi"];
            $kalori = (int) ($_POST["kalori-terbakar"] ?? 0);
            $tanggal = $_POST["tanggal"];
            $catatan = trim($_POST["catatan_fisik"] ?? "");

            if(empty($idUser) || empty($namaAktivitas) || empty($durasi)  || empty($kalori) || empty($tanggal)){
                $error = "datanya blm valid boy"; 
            }else{
                $query = "INSERT INTO aktivitas_fisik ()"
            }
        }

    }

?>