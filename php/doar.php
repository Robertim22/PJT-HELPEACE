<?php
session_start();
require_once "db_connection.php"; // Inclua o arquivo de conexão com o banco de dados aqui

// Verifica se o ID da campanha foi passado via GET
if (!isset($_GET['campanha_id'])) {
    echo "<p>Campanha não especificada.</p>";
    exit();
}

$campanha_id = $_GET['campanha_id'];

// Recupera as informações da campanha
$stmt = $conn->prepare("SELECT * FROM campanhas WHERE id = :campanha_id");
$stmt->bindParam(":campanha_id", $campanha_id);
$stmt->execute();
$campanha = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se a campanha existe
if (!$campanha) {
    echo "<p>Campanha não encontrada.</p>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doar</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Doar para a Campanha</h2>
        <h3>Campanha: <?php echo $campanha['titulo']; ?></h3>
        <p>Meta: R$<?php echo number_format($campanha['meta'], 2, ',', '.'); ?></p>
        <p>Arrecadado: R$<?php echo number_format($campanha['arrecadado'], 2, ',', '.'); ?></p>
        <form action="process_doacao.php" method="POST">
            <input type="hidden" name="campanha_id" value="<?php echo $campanha_id; ?>">
            <label for="valor_doacao">Valor da Doação (R$):</label>
            <input type="number" id="valor_doacao" name="valor_doacao" step="0.01" min="0.01" required>
            <button type="submit">Doar</button>
        </form>
        <a href="campaign.php">Voltar para a página de campanhas</a>
    </div>
</body>
</html>
