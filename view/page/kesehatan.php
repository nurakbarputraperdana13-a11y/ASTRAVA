<?php
include("../../logic/kesehatan.php");
$data = ambilData($pdo, $_SESSION["id"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Kesehatan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <link href="style/style.css" rel="stylesheet">
    <link href="style/kesehatan.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-3.1.5/datatables.min.css">
    <script src="https://cdn.datatables.net/v/dt/dt-3.1.5/datatables.min.js"></script>
</head>

<body>

    <div class="container-fluid d-flex px-0 flex-column gap-4" style="width: 100%;">
        <?php include("../includes/navbar.php") ?>

        <main class="d-flex flex-column gap-4">
            <section class="p-4 card shadow-sm">
                <h1 class="fs-3">Hitung dan catat BMI</h1>
                <p>Catat dan pantau terus kesehatan kamu ya!</p>
            </section>

            <section class="d-flex gap-4 justify-content-between">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="form-bmi">
                    <div class="mt-3 mb-3 ">
                        <label for="berat">Berat badan</label>
                        <input type="number" id="berat" name="berat" class="form-control"
                            placeholder="Masukan berat badan (Kg)">
                        <span><?php echo $beratErr ?></span>
                    </div>

                    <div class="mt-3 mb-3">
                        <label for="tinggi">Tinggi badan</label>
                        <input type="number" id="tinggi" name="tinggi" class="form-control"
                            placeholder="Masukan tinggi badan (cm)">
                        <span><?php echo $tinggiErr ?></span>
                    </div>


                    <input type="submit" name="submit" value="Hitung" class="btn btn-dark w-100 mb-3">
                </form>

                <div class="result-bmi flex-fill shadow-sm card p-3">
                    <h2 class="text-center fs-4">Hasil Perhitungan BMI</h2>
                    <div class="hasil">
                        <p class="text-hasil"><?php echo $hasilbmuy = ($ambilBmi) ? $ambilBmi["bmi"] : 0; ?></p>
                        <p class="text-hasil-ket"><?php echo $hasilbmuy = ($ambilBmi) ? $ambilBmi["kategori"] : "-"; ?>
                        </p>
                    </div>
                </div>
            </section>


            <section class="d-flex flex-column gap-2">
                <form action="kesehatan.php" method="get" class="d-flex gap-2 justify-content-end align-items-end">
                    <h3 class="me-auto align-self-center">Riwayat perhitungan</h3>
                    <div>
                        <label>Dari Tanggal</label>
                        <input class="form-control" name="dari-tanggal" type="date">
                    </div>
                    <div>
                        <label>Ke Tanggal</label>
                        <input class="form-control" name="ke-tanggal" type="date">
                    </div>


                    <input class="btn btn-dark" name="anjay" type="submit" value="Filter">

                    <input class="btn btn-dark" name="reset" type="submit" value="Reset">
                    <?php if (isset($_GET["reset"])) {
                        unset($_GET["anjay"]);
                    } ?>

                </form>
                <table id="table-riwayat">
                    <thead>
                        <tr>
                            <th>Berat Badan</th>
                            <th>Tinggi Badan</th>
                            <th>BMI</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            if (empty($_GET["anjay"])): ?>
                                    <?php foreach ($data as $row): ?>
                                <tr>
                                    <td><?= $row["berat"] ?></td>
                                    <td><?= $row["tinggi"] ?></td>
                                    <td><?= $row["bmi"] ?></td>
                                    <td><?= $row["kategori"] ?></td>
                                    <td><?= $row["tanggal"] ?></td>
                                </tr>
                                    <?php endforeach; ?>
                            <?php else: ?>
                                <?php foreach ($tanggaldata as $row): ?>
                                <tr>
                                    <td><?= $row["berat"] ?></td>
                                    <td><?= $row["tinggi"] ?></td>
                                    <td><?= $row["bmi"] ?></td>
                                    <td><?= $row["kategori"] ?></td>
                                    <td><?= $row["tanggal"] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif ?>
                    </tbody>
                </table>
                    <?php if (empty($data)): ?>
                    <div>Blm ada data!</div>
                    <?php endif ?>

                <div class="pagination-table">

                </div>
            </section>
        </main>
    </div>

    <script defer>
        new DataTable('#table-riwayat');
    </script>
</body>

</html>