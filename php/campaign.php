<?php
session_start();
require_once "db_connection.php";

// Verifica se o usuário está logado
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

// Recupera as campanhas do banco de dados
$stmt = $conn->prepare("SELECT campanhas.*, usuarios.nome AS nome_usuario FROM campanhas INNER JOIN usuarios ON campanhas.usuario_id = usuarios.id");
$stmt->execute();
$campanhas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campanhas</title>
    <link rel="stylesheet" href="/assets/style.css">
    <style>
        .campanhas {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .campanha {
            flex: 1 1 calc(33.33% - 20px);
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            box-sizing: border-box;
        }

        .campanha h3 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .campanha p {
            margin: 0;
        }

        .doar-button {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .doar-button:hover {
            background-color: #0056b3;
        }

        .meta-arrecadacao {
            font-size: 16px;
            font-weight: bold;
            color: #555;
            margin-bottom: 8px; 
        }

        #arrecadado {
            font-size: 16px;
            font-weight: bold;
            color: #555;
            margin-bottom: 8px; 
        }

        strong {
            color: blue;
        }

        /* Estilo adicional para garantir responsividade */
        @media (max-width: 768px) {
            .campanha {
                flex: 1 1 calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .campanha {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
       <center><h2>Campanhas HELPEACE</h2></center>
        <button onclick="location.href='create_campaign.php';">Criar Campanha</button>
        <div class="campanhas">
            <?php foreach ($campanhas as $campanha): ?>
                <div class="campanha">
                    <h3>Campanha criada por: <?php echo $campanha['nome_usuario']; ?></h3>
                    <p class="meta-arrecadacao">Meta de arrecadação: R$<?php echo number_format($campanha['meta'], 2, ',', '.'); ?></p>
                    <p id="arrecadado">Arrecadado: <strong>R$</strong><?php echo number_format($campanha['arrecadado'], 2, ',', '.'); ?></p>
                    <form action="doar.php?campanha_id=<?php echo $campanha['id']; ?>" method="POST">
                        <button type="submit" class="doar-button">Doar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>
