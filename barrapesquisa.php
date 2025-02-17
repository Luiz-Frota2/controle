<?php 
include 'database.php';

// Verificar se há um termo de pesquisa
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Query para buscar usuários com base no termo de pesquisa
$query = "SELECT * FROM usuarios WHERE nome LIKE :search OR email LIKE :search";
$stmt = $conn->prepare($query);
$stmt->bindValue(':search', "%$searchTerm%", PDO::PARAM_STR);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Pagamentos</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }


        /* Estilos para a barra de pesquisa */
       

    </style>
</head>
<body>

    <div class="container">
        <h1>Controle de Pagamentos</h1>

        <!-- Barra de Pesquisa -->
        <div class="search-container">
            <form action="listar.php" method="GET">
                <input type="text" name="search" placeholder="Pesquisar por nome ou e-mail" value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button type="submit">Pesquisar</button>
            </form>
        </div>

        <!-- Tabela de Pagamentos -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['nome']; ?></td>
                        <td><?php echo $usuario['email']; ?></td>
                        <td>R$ <?php echo number_format($usuario['valor_pagamento'], 2, ',', '.'); ?></td>
                        <td><?php echo $usuario['status_pagamento']; ?></td>
                        <td class="actions">
                            <a href="editar.php?id=<?php echo $usuario['id']; ?>">Editar</a> |
                            <a href="deletar.php?id=<?php echo $usuario['id']; ?>">Excluir</a> |
                            <a href="gerar_pdf.php?id=<?php echo $usuario['id']; ?>">Gerar PDF</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
