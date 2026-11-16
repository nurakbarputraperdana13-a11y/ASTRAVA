<?php 
    require_once __DIR__ . "/../../dbconn/conn.php";

    $email = "";
    $namaErr = $emailErr = $passErr = $confirmPassErr = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty(trim($_POST["nama"]))){
            $namaErr = "Nama Invalid";
        }else{
            $nama = trim($_POST["nama"]);
        }

        if(empty(trim($_POST["email"])) || !filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)){
            $emailErr = "Email invalid";
        }else {
            $query = "SELECT id_user FROM users WHERE email = ?";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$_POST["email"]]);
            if($stmt->rowCount() == 1){
                $emailErr = "Email ini sudah dipakai";
            }else {
                $email = trim($_POST["email"]);
            }

        }

        if(empty(trim($_POST["password"]))){
            $passErr = "Password invalid";
        }elseif(strlen($_POST["password"]) < 6){
            $passErr = "Password kurang dari 6 karakter";
        }else {
            $pass = trim($_POST["password"]);
            $hash = password_hash($pass, PASSWORD_DEFAULT);
        }

        if(empty(trim($_POST["c-password"]))){
            $confirmPassErr = "Confirm password invalid";
        }else {
            $conPass = trim($_POST["c-password"]);
            if($conPass == $pass){
                $conPass = trim($_POST["c-password"]);
            }else {
                $confirmPassErr = "Confirm password invalid";
            }
        }

        if(empty($namaErr) && empty($emailErr) && empty($passErr) && empty($confirmPassErr)){

            $query = "INSERT INTO users (nama, email, password)
            VALUES(?, ?, ?)";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$nama, $email,$hash]);
            $id = $pdo->lastInsertId();
        }
    }
?>