<?php include 'database.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <h1>Cadastrar Novo Usuário</h1>
    <a class="btn btn-secondary btn-sm" href="index.php">Voltar</a>
    <form class="forma" action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" ><br><br>

        <label for="valor_pagamento">Valor do Pagamento:</label>
        <input type="number" step="1.00" id="valor_pagamento" name="valor_pagamento" required><br><br>

        <label for="data_pagamento">Data do Pagamento:</label>
        <input type="date"  id="data_pagamento" name="data_pagamento" required><br><br>

        <label for="status_pagamento">Status do Pagamento:</label>
        <select id="status_pagamento" name="status_pagamento">
            <option value="Pendente">Pendente</option>
            <option value="Pago">Pago</option>
        </select><br><br>

        <button type="submit">Cadastrar</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $valor_pagamento = $_POST['valor_pagamento'];
        $data_pagamento = $_POST['data_pagamento'];
        $status_pagamento = $_POST['status_pagamento'];

        try {
            $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, valor_pagamento, data_pagamento, status_pagamento) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $email, $valor_pagamento, $data_pagamento, $status_pagamento]);
            echo "<p style='text-align:center; color:green;'>Usuário cadastrado com sucesso!</p>";
        } catch (PDOException $e) {
            echo "<p style='text-align:center; color:red;'>Erro: " . $e->getMessage() . "</p>";
        }
    }
    ?>
   
</body>
</html>
