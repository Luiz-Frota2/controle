<?php include 'database.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listar Usuários</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <h1>Usuários Cadastrados</h1>  
    <a class="btn btn-secondary btn-sm " href="index.php">Voltar</a>
    <form  action="gerar_pdf_multiplos.php" method="POST">
        <table class="table table-striped table-hover"  >
        
            <thead>
                <tr>
                    <th>Selecionar</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Valor</th>
                    <th>Data de Pagamento</th>
                    <th>Status</th>
                    <th></th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                $stmt = $conn->query("SELECT * FROM usuarios");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td><input type='checkbox' name='ids[]' value='{$row['id']}'></td>
                            <td>{$row['nome']}</td>
                            <td>{$row['email']}</td>
                            <td>R$ " . number_format($row['valor_pagamento'], 2, ',', '.') . "</td>
                            <td>{$row['data_pagamento']}</td>
                            <td>{$row['status_pagamento']}</td>
                            <td></td>
                            <td>
                                <a href='editar.php?id={$row['id']}'>Editar</a> |
                                <a href='deletar.php?id={$row['id']}'>Excluir</a> |
                                <a href='gerar_pdf.php?id={$row['id']}'>Gerar PDF</a>
                            </td>
                          </tr>";
                }
                ?>
                
            </tbody>
            
        </table>
        <div class="d-grid gap-2">
         <button class="btn btn-secondary" type="submit">Gerar PDF Selecionados</button>
        </div>
        <br>
        
       
    </form>
    
</body>
</html>
