<?php
session_start();
require_once "db_connection.php"; 

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["campanha_id"]) && isset($_POST["valor_doacao"])) {
        $campanha_id = $_POST["campanha_id"];
        $valor_doacao = $_POST["valor_doacao"];

        $stmt = $conn->prepare("UPDATE campanhas SET arrecadado = arrecadado + :valor_doacao WHERE id = :campanha_id");
        $stmt->bindParam(":valor_doacao", $valor_doacao);
        $stmt->bindParam(":campanha_id", $campanha_id);
        $stmt->execute();

        header("Location: campaign.php");
        exit();
    } else {
        header("Location: doar.php?campanha_id={$campanha_id}&error=1");
        exit();
    }
} else {
    header("Location: doar.php?campanha_id={$campanha_id}");
    exit();
}
?>
