<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Campanha</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Criar Campanha</h2>
        <form action="process_create_campaign.php" method="POST">
            <input type="text" name="titulo" placeholder="Título da Campanha" required>
            <input type="number" name="meta" placeholder="Meta de Arrecadação" required>
            <textarea name="descricao" placeholder="Descrição da Campanha" required></textarea>
            <button type="submit">Criar</button>
        </form>
        <a href="campaign.php">Voltar para Campanhas</a>
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>
