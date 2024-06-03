<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

require_once "db_connection.php"; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $meta = $_POST["meta"];
    $descricao = $_POST["descricao"];
    $usuario_id = $_SESSION["id"];

    $stmt = $conn->prepare("INSERT INTO campanhas (titulo, meta, descricao, usuario_id) VALUES (:titulo, :meta, :descricao, :usuario_id)");
    $stmt->bindParam(":titulo", $titulo);
    $stmt->bindParam(":meta", $meta);
    $stmt->bindParam(":descricao", $descricao);
    $stmt->bindParam(":usuario_id", $usuario_id);

    if ($stmt->execute()) {
        header("Location: campaign.php");
        exit();
    } else {
        header("Location: create_campaign.php?error=1");
        exit();
    }
} else {
    header("Location: create_campaign.php");
    exit();
}
?>
