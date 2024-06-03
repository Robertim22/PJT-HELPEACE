<?php
session_start();
require_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $stmt = $conn->prepare("SELECT id, nome FROM usuarios WHERE email = :email AND senha = :senha");
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":senha", $senha); 
    $stmt->execute();
    

    if ($stmt->rowCount() == 1) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION["id"] = $usuario["id"];
        $_SESSION["nome"] = $usuario["nome"];
        header("Location: campaign.php");
        exit(); 
    } else {
        header("Location: ../../index.html?login_error=1");
        exit();
    }
}
?>
