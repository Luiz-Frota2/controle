<?php include 'database.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $valor_pagamento = $_POST['valor_pagamento'];
    $status_pagamento = $_POST['status_pagamento'];

    $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, email = ?, valor_pagamento = ?, status_pagamento = ? WHERE id = ?");
    $stmt->execute([$nome, $email, $valor_pagamento, $status_pagamento, $id]);

    header('Location: listar.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <h1>Editar Usuário</h1>
    <a class="btn btn-primary btn-sm" href="listar.php">Voltar</a>
    <form class="forma" action="" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?= $usuario['nome'] ?>" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="<?= $usuario['email'] ?>" ><br><br>

        <label for="valor_pagamento">Valor do Pagamento:</label>
        <input type="number" step="0.01" id="valor_pagamento" name="valor_pagamento" value="<?= $usuario['valor_pagamento'] ?>" required><br><br>

        <label for="status_pagamento">Status do Pagamento:</label>
        <select id="status_pagamento" name="status_pagamento">
            <option value="Pendente" <?= $usuario['status_pagamento'] == 'Pendente' ? 'selected' : '' ?>>Pendente</option>
            <option value="Pago" <?= $usuario['status_pagamento'] == 'Pago' ? 'selected' : '' ?>>Pago</option>
        </select><br><br>

        <button type="submit">Atualizar</button>
    </form>
    
</body>
</html>
