<?php
// Configuração do banco de dados SQLite
$dbFile = 'pagamentos.db';

try {
    $conn = new PDO("sqlite:$dbFile");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criação da tabela de usuários, se não existir
    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE,
        valor_pagamento REAL NOT NULL,
        data_pagamento REAL NOT NULL,
        status_pagamento TEXT CHECK(status_pagamento IN ('Pendente', 'Pago')) DEFAULT 'Pendente'
    )";
    $conn->exec($sql);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>
