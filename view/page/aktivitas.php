<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivitas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="style/dashboard.css" rel="stylesheet">
    <link href="style/aktivitas.css" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid d-flex px-0 flex-column gap-4" style="width: 100%;">
        <?php include("../includes/navbar.php") ?>

        <main class="d-flex flex-column gap-4">
            <section class="p-4 card shadow-sm">
                <p class="fw-medium">Lihat Terus kesehatan kamu</p>
                <h1 class="fs-3">Halo Nama Kamu</h1>
                <p>Pantau dan jaga kesehatan kamu bersama kami</p>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="get" class="d-flex gap-2">
                    <input class="form-control w-25" type="date" name="filter">
                    <button name="terapkan-filter" class="btn btn-dark">terapkan</button>
                    <button name="reset-filter" class="btn btn-dark">Reset</button>
                </form>
            </section>

            <div class="ringkasan-dash d-flex flex-row gap-3">
                <div class="item-ringkasan card shadow-sm">
                    <div class="p-3">item 1</div>
                </div>
                <div class="item-ringkasan card shadow-sm">
                    <div class="p-3">item 1</div>
                </div>
                <div class="item-ringkasan card shadow-sm">
                    <div class="p-3">item 1</div>
                </div>
            </div>

            <section class="tambah-aktivitas card p-3">
                <h5 class="mb-3">Tambah Aktivitas</h5>
                <div class="container-btn-akt d-flex gap-3 justify-content-between">
                    <button type="button" class="btn btn-primary w-100" data-overlay-open="overlay-fisik">+ Catat Fisik</button>
                    <button type="button" class="btn btn-dark w-100" data-overlay-open="overlay-tidur">+ Catat Tidur</button>
                    <button type="button" class="btn btn-warning w-100" data-overlay-open="overlay-nutrisi">+ Catat Nutrisi</button>
                </div>
            </section>

            <section class="card">
                <table>
                    <tbody>
                        <tr>
                            <th>Riwayat</th>
                            <th>Aktivitas</th>
                            <th>Tidur</th>
                            <th>Nutrisi</th>
                        </tr>
                    </tbody>
                </table>
            </section>

        </main>
    </div>

    <div class="overlay-aktivitas" id="overlay-fisik">
        <div class="overlay-content card shadow-sm p-3">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <div class="mt-3 mb-3 ">
                    <label for="akt">Nama Aktivitas</label>
                    <input type="text" id="akt" name="aktivitas" class="form-control" placeholder="Contoh: Lari">
                    <span></span>
                </div>
                <div class="mt-3 mb-3 ">
                    <label for="durasi">Durasi (menit)</label>
                    <input type="number" id="durasi" name="durasi" class="form-control" placeholder="Dalam menit">
                    <span></span>
                </div>
                <div class="mt-3 mb-3 ">
                    <label for="kalori-terbakar">Kalori terbakar</label>
                    <input type="number" id="kalori" name="kalori-terbakar" class="form-control" placeholder="">
                    <span></span>
                <div class="mt-3 mb-3 ">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" placeholder="">
                    <span></span>
                </div>
                <div class="mt-3 mb-3 ">
                    <label for="catatan-fisik">Catatan (opsional)</label>
                    <textarea id="catatan-fisik" name="catatan_fisik" class="form-control" rows="4"></textarea>
                    <span></span>
                </div>

                <div>
                    <button class="btn" type="button" data-overlay-close="overlay-fisik">Batal</button>
                    <button class="btn btn-dark" name="submit-fisik" type="submit">submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="overlay-aktivitas" id="overlay-tidur">
        <div class="overlay-content card shadow-sm p-3">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <h5>Catat Tidur</h5>
                <div class="mt-3 mb-3">
                    <label for="tanggal-tidur">Tanggal</label>
                    <input type="date" id="tanggal-tidur" name="tanggal_tidur" class="form-control" required>
                </div>
                <div class="mt-3 mb-3">
                    <label for="mulai-tidur">Waktu mulai tidur</label>
                    <input type="time" id="mulai-tidur" name="mulai_tidur" class="form-control" required>
                </div>
                <div class="mt-3 mb-3">
                    <label for="bangun-tidur">Waktu bangun</label>
                    <input type="time" id="bangun-tidur" name="waktu_bangun" class="form-control" required>
                </div>
                <div class="mt-3 mb-3">
                    <label for="catatan-tidur">Catatan (opsional)</label>
                    <textarea id="catatan-tidur" name="catatan_tidur" class="form-control" rows="4"></textarea>
                </div>
                <div>
                    <button class="btn" type="button" data-overlay-close="overlay-tidur">Batal</button>
                    <button class="btn btn-dark" name="submit-tidur" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="overlay-aktivitas" id="overlay-nutrisi">
        <div class="overlay-content card shadow-sm p-3">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <h5>Catat Nutrisi</h5>
                <div class="mt-3 mb-3">
                    <label for="nama-makanan">Nama makanan/minuman</label>
                    <input type="text" id="nama-makanan" name="nama_makanan" class="form-control" required>
                </div>
                <div class="mt-3 mb-3">
                    <label for="tanggal-nutrisi">Tanggal</label>
                    <input type="date" id="tanggal-nutrisi" name="tanggal_nutrisi" class="form-control" required>
                </div>
                <div class="mt-3 mb-3">
                    <label for="kalori">Kalori</label>
                    <input type="number" id="kalori" name="kalori" class="form-control" min="0" step="1" placeholder="kkal">
                </div>
                <div class="mt-3 mb-3">
                    <label for="catatan-nutrisi">Catatan (opsional)</label>
                    <textarea id="catatan-nutrisi" name="catatan_nutrisi" class="form-control" rows="4"></textarea>
                </div>
                <div>
                    <button class="btn" type="button" data-overlay-close="overlay-nutrisi">Batal</button>
                    <button class="btn btn-dark" name="submit-nutrisi" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="/view/page/script/script.js"></script>
</body>

</html>