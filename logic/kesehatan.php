<?php
require_once __DIR__ . "../../dbconn/conn.php";
session_start();

$berat = $tinggi = $tanggal = "";
$beratErr = $tinggiErr = $tanggalErr = "";
$ambilBmi = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["berat"]))) {
        $beratErr = "Isi berat";
    } elseif (trim($_POST["berat"]) < 0) {
        $beratErr = "Berat  invalid";
    } else {
        $berat = trim($_POST["berat"]);
    }

    if (empty(trim($_POST["tinggi"]))) {
        $tinggiErr = "Isi tinggi";
    } elseif (trim($_POST["tinggi"]) < 0) {
        $beratErr = "tinggi invalid";
    } else {
        $tinggi = trim($_POST["tinggi"]);
    }

    $tanggal = date('Y-m-d');

    if (empty($beratErr) && empty($tinggiErr) && empty($tanggalErr)) {

        $bmi = hitungBmi($berat, $tinggi);
        $kategori = cekKategori($bmi);

        $query = "INSERT INTO bmi_records (id_user,berat, tinggi, bmi, kategori, tanggal) VALUES(?,?,?,?,?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$_SESSION["id"], $berat, $tinggi, round($bmi, 2), $kategori, $tanggal]);
        $ambilBmi = [
            "bmi" => round($bmi, 2),
            "kategori" => $kategori,
            "berat" => $berat
        ];

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

function hitungBmi($berat, $tinggi)
{
    $bmi = $berat / (($tinggi / 100) ** 2);
    return $bmi;
}

function cekKategori($bmi)
{
    $kategori = match (true) {
        $bmi < 18.5 => "Kurus",
        $bmi < 25 => "Normal",
        $bmi < 30 => "Gemuk",
        default => "obesitas"
    };

    return $kategori;
}

// munculin data
function ambilData($pdo, $id_user)
{
    $sql = "SELECT * FROM bmi_records WHERE id_user = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_user]);
    return $stmt->fetchAll();
}

if (isset($_GET["dari-tanggal"]) && isset($_GET["ke-tanggal"])) {
    $dariTanggal = $_GET["dari-tanggal"];
    $keTanggal = $_GET["ke-tanggal"];

    $query = "SELECT * FROM bmi_records WHERE tanggal BETWEEN ? AND ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$dariTanggal, $keTanggal]);
    $cekIsi = $stmt->rowCount();
    $tanggaldata = $stmt->fetchAll();
}

?>