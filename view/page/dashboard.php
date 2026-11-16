<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="style/dashboard.css" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
</head>

<body class="p-0">
    <div class="container-fluid d-flex px-0 flex-column gap-4" style="width: 100%;">
        <?php include("../includes/navbar.php") ?>

        <main class="d-flex flex-column gap-4">
            <section class="p-4 card shadow-sm">
                <p class="fw-medium">Lihat Terus kesehatan kamu</p>
                <h1 class="fs-3">Halo Nama Kamu</h1>
                <p>Pantau dan jaga kesehatan kamu bersama kami</p>
            </section>

            <div class="ringkasan-dash d-flex flex-row justify-content-between">
                <div class="item-ringkasan card shadow-sm">
                    <div class="p-3">item 1</div>
                </div>
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

            <div class="d-flex justify-content-between gap-3">
                <div style="width: 600px;" class="chart card card-body jus">
                    <canvas id="grafik-skor-kesehatan"></canvas>
                </div>

                <div style="width: 400px;" class="chart card card-body jus">
                    <canvas id="grafik-tidur"></canvas>
                </div>
            </div>

        </main>
    </div>

    <script>
        const labels = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei'
        ];
        const dataKesehatan = [1, 3, 6, 7, 10];
        const ctx = document.getElementById("grafik-skor-kesehatan");

        new Chart(ctx, {
            type: 'line',

            data: {
                labels: labels,

                datasets: [{
                    label: 'Skor Kesehatan',
                    data: dataKesehatan,
                    borderWidth: 2,
                    tension: 0.3
                }]
            },

            options: {
                responsive: true
            }

        })

        const ctxTidur = document.getElementById("grafik-tidur");

        new Chart(ctxTidur, {
            type: 'bar',

            data: {
                labels: labels,

                datasets: [{
                    label: 'Rata Tidur Bulanan',
                    data: [12, 19, 8, 15, 22, 17],
                    backgroundColor: '#55BCF7',
                    borderRadius: 5,
                    barThickness: 35
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }

        });
    </script>
</body>

</html>