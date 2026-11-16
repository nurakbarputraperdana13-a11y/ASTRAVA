<?php
$pdo = require_once __DIR__ . "../../dbconn/conn.php";
session_start();

$userId = $_SESSION["id"];
$nama = $dosis = $frekuensi = "";
$namaErr = $dosisErr = $frekuensiErr = "";
$action = $_GET["aksi"] ?? ($_POST["aksi"] ?? "tambah_obat");

//buat  nampilin data yg mau diedit
$editObat = null;
if ($action === "edit" && isset($_GET["id"])) {
    $stmt = $pdo->prepare("SELECT * FROM obat WHERE id_obat = ? AND id_user = ?");
    $stmt->execute([(int)$_GET["id"], $userId]);
    $editObat = $stmt->fetch();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($action === "tambah_obat") {
        if (empty(trim($_POST["nama-obat"]))) {
            $namaErr = "masukan nama";
        } else {
            $nama = trim($_POST["nama-obat"]);
        }

        if (empty(trim($_POST["dosis"]))) {
            $dosisErr = "masukan dosis";
        } else {
            $dosis = trim($_POST["dosis"]);
        }

        if (empty(trim($_POST["frekuensi"]))) {
            $frekuensiErr = "masukan frekuensi";
        } else {
            $frekuensi = (int) trim($_POST["frekuensi"]);
            if ($frekuensi < 1) {
                $frekuensiErr = "Frekuensi minimal 1";
            }
        }



        if (empty($namaErr) && empty($dosisErr) && empty($frekuensiErr)) {
            $query = "INSERT INTO obat (id_user, nama_obat, dosis, frekuensi, status) VALUES(?, ?, ?, ?, 'Aktif')";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$userId, $nama, $dosis, $frekuensi]);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

    } elseif ($action === "hapus_obat") {
        $id = (int) ($_POST["id_obat"] ?? 0);
        if ($id > 0) {
            $stmt = $pdo->prepare("DELETE FROM obat WHERE id_obat = ? AND id_user = ?");
            $stmt->execute([$id, $userId]);
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;

    } elseif ($action === "edit_obat") {
        $id = (int) trim($_POST["id_obat"]);

        if ($id > 0) {
            $query = "SELECT * FROM obat WHERE id_obat = ? AND id_user = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$id, $userId]);
            $obat = $stmt->fetch();

            if ($obat) {
                if (empty(trim($_POST["nama-obat"]))) {
                    $namaErr = "masukan nama";
                } else {
                    $nama = trim($_POST["nama-obat"]);
                }

                if (empty(trim($_POST["dosis"]))) {
                    $dosisErr = "masukan dosis";
                } else {
                    $dosis = trim($_POST["dosis"]);
                }

                if (empty(trim($_POST["frekuensi"]))) {
                    $frekuensiErr = "masukan frekuensi";
                } else {
                    $frekuensi = (int) trim($_POST["frekuensi"]);
                    if ($frekuensi < 1) {
                        $frekuensiErr = "Frekuensi minimal 1";
                    }
                }



                if (empty($namaErr) && empty($dosisErr) && empty($frekuensiErr)) {
                    $query = "UPDATE obat
                            SET nama_obat=?, dosis = ?, frekuensi = ?, updated_at = NOW()
                            WHERE id_obat = ? AND id_user = ?";

                    $stmt = $pdo->prepare($query);
                    $stmt->execute([$nama, $dosis, $frekuensi, $id, $userId]);
                }
            }
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;

    } elseif ($action === "toggle_status") {
        $id = (int)trim($_POST["id_obat"]);

        if($id > 0){
            $query = "SELECT status FROM obat WHERE id_obat = ? AND id_user = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$id, $userId]);
            $current = $stmt->fetchColumn();

            if($current){
                $newStatus = ($current == "Aktif") ? "Selesai" : "Aktif";
                $query = "UPDATE obat SET STATUS = ?, updated_at = NOW() WHERE id_obat = ? AND id_user = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$newStatus, $id, $userId]);
            }
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

}


$query = "SELECT * FROM obat where id_user = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$userId]);
$dataObat = $stmt->fetchAll();


?>