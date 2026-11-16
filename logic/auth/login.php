<?php 
    require_once __DIR__ . "/../../dbconn/conn.php";

    session_start();

    $email = "";
    $namaErr = $emailErr = $passErr = $confirmPassErr = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty(trim($_POST["email"])) || !filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)){
            $emailErr = "Email invalid";
        }else {
            $email = trim($_POST["email"]);
        }

        if(empty(trim($_POST["password"]))){
            $passErr = "Password invalid";
        }else{
            $pass = trim($_POST["password"]);
        }

        if(empty($emailErr) && empty($passErr)){
            $query = "SELECT id_user, email, password FROM users WHERE email = ?";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$email]);
            if($stmt->rowCount() == 1){
                $row = $stmt->fetch();
                $id = $row["id_user"];
                $email = $row["email"];
                $hash = $row["password"];

                if(password_verify($pass, $hash)){
                    $_SESSION["id"] = $row["id_user"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["pass"] = $row["password"];

                    cekRole($pdo, $_SESSION["id"]);
                }else {
                    $passErr ="Password Salah";
                }
            }else{
                $emailErr = "Email tidak terdaftar";
            }
        }

    }

    function cekRole($pdo, $sesi){
    $query = "SELECT id_user, role FROM users WHERE id_user = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$sesi]);
    $role = $stmt->fetch();

    if($role["role"] == "admin"){
        header("Location: ../../admin/view/php/dashboard.php");
        exit;
    }else{
        header("Location: ../../view/page/dashboard.php");
        exit;
    }

    //var_dump($role["role"]);
}
?>