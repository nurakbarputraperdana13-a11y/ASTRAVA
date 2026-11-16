<?php include("../../logic/auth/login.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../view/style/auth.css">

</head>
<body>
    <div class="container p-3 min-vh-100 d-flex flex-row 2-100 justify-content-center align-items-center">
        <div class="card p-4 shadow-sm" style="width: 400px;">
            <h1 class="text-center mb-4">Login</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <div class="mt-3 mb-3">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Masukin email">
                <span><?php echo $emailErr ?></span>
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukin masukin password">
                <span><?php echo $passErr ?></span>
            </div>
            <div class="mb-3 text-end">
                <a href="lupaPw.php" class="text-decoration-none"><small>Lupa Password?</small></a>
            </div>
            <button name="masuk" id="masuk" class="btn btn-dark w-100 mb-3" >Masuk</button>

            <div class="d-flex justify-content-center gap-1">
                <p class="">Belum punya akun?</p>
                <a href="register.php" class="text-decoration-none"><small> Daftar</small></a>
            </div>
        </form>
        </div>
    </div>
</body>
</html>