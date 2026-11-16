<?php include('../../logic/obat.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Obat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="style/dashboard.css" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
    <link href="style/obat.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid d-flex px-0 flex-column gap-4" style="width: 100%;">
        <?php include("../includes/navbar.php") ?>

        <main class="d-flex flex-column gap-4">
            <section class="p-4 card shadow-sm">
                <h1 class="fs-3">Kelola Jadwal Obat Kamu!</h1>
                <p>Catat jadwal dan minum obat kamu disini ya</p>
            </section>

            <div class="d-flex flex-row gap-3 ">
                <section class="card shadow-sm p-3 w-75">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <p>Obat</p>
                        <button id="btn-tambah-obat">Tambah obat</button>

                    </div>
                    <table class="table table-sm table-responsive table-hover">
                        <thead>
                            <tr class="table-primary">
                                <th>Nama Obat</th>
                                <th>Dosis</th>
                                <th>Frekuensi</th>
                                <th>Aksi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($dataObat)): ?>
                                <?php foreach ($dataObat as $row): ?>
                                    <tr>
                                        <td><?= $row["nama_obat"] ?></td>
                                        <td><?= $row["dosis"] ?>gram</td>
                                        <td><?= $row["frekuensi"] ?> Kali sehari</td>
                                        <td>
                                            <!-- Edit (nanti) -->
                                            <a href="?aksi=edit&id=<?= $row['id_obat'] ?>"
                                                class="btn btn-sm btn-outline-primary">Edit</a>

                                            <!-- Hapus -->
                                            <form method="post" style="display:inline"
                                                onsubmit="return confirm('Yakin hapus obat ini?')">
                                                <input type="hidden" name="aksi" value="hapus_obat">
                                                <input type="hidden" name="id_obat" value="<?= $row['id_obat'] ?>">
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>

                                        <td>
                                            <!-- Toggle Button -->
                                            <form method="post" style="display:inline" class="ms-1">
                                                <input type="hidden" name="aksi" value="toggle_status">
                                                <input type="hidden" name="id_obat" value="<?= $row['id_obat'] ?>">
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-<?= $row['status'] === 'Aktif' ? 'warning' : 'success' ?>">
                                                    <?= $row['status'] === 'Aktif' ? 'Selesai' : 'Aktifkan' ?>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>


                        </tbody>
                    </table>
                </section>

                <section class="w-50 card shadow-sm p-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <p>Frekuensi</p>
                        <button id="btn-tambah-jadwal">Tambah jadwal</button>
                    </div>
                    <table class="table table-sm table-responsive table-hover">
                        <thead>
                            <tr class="table-primary">
                                <th>Nama Obat</th>
                                <th>Waktu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Paracetamol</td>
                                <td>09.00</td>
                                <td><button>Belum</button></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>

        </main>
    </div>
    <?php $number = 3; ?>
    <div class="overlay">
        <div class="overlay-content card shadow-sm p-4">
            <div class="d-flex justify-content-between">
                <p>Tambah jadwal</p>
                <a href="<?= $_SERVER["PHP_SELF"] ?>" id="btn-close" class="btn btn-dark p-1">Tutup</a>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <div class="mt-3 -mb-3">
                    <label for="Nama Obat">Nama Obat</label>
                    <input class="form-control" type="text" name="nama-obat" value="<?= $editObat['nama_obat'] ?? '' ?>"
                        placeholder="Masukan nama obat" required>
                </div>
                <div class="mt-3 -mb-3">
                    <label for="dosis">Dosis</label>
                    <input class="form-control" type="text" name="dosis" value="<?= $editObat['dosis'] ?? '' ?>"
                        placeholder="Masukan dosis" required>
                </div>
                <div class="mt-3 -mb-3">
                    <label for="frekuensi">Frekuensi</label>
                    <div class="d-flex justify-content-between">
                        <input id="input-waktu" class="form-control flex-grow me-1" type="number" name="frekuensi"
                            placeholder="Contoh: 3 Kali sehari" required value="<?= $editObat['frekuensi'] ?? '' ?>">
                        <input type="text" value="Kali sehari" class="flex-grow  form-control w-50 me-1" readonly>


                        <!-- </div>
                    <label for="waktu" id="label-waktu"></label>
                    <div class="d-flex flex-column justify-content-between" id="tampilan-waktu">
                    </div> -->
                    </div>
                    <div class="mt-3 -mb-3">
                        <label for="frekuensi">Catatan</label>
                        <textarea class="form-control" id="catatan" name="Catatan" rows="3" cols="50"
                            placeholder="Catatan (opsional)"></textarea>
                    </div>

                    <input type="hidden" name="id_obat" value="<?= $editObat['id_obat'] ?? '' ?>">
                    <input type="hidden" name="aksi" value="<?= $editObat ? 'edit_obat' : 'tambah_obat' ?>">
                    <button id="btn-tambah" class="btn btn-dark p-1 w-100 mt-3">Masukan</button>

            </form>
        </div>
    </div>

    <script src="/view/page/script/script.js"></script>

    <?php if ($editObat): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const overlay = document.querySelector('.overlay');
                if (overlay) overlay.classList.add('aktif');
            });
        </script>
    <?php endif; ?>
</body>

</html>