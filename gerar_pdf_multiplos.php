<?php
require('fpdf/fpdf.php');
include 'database.php';

// Verifica se algum ID foi selecionado
if (!isset($_POST['ids']) || empty($_POST['ids'])) {
    die("Nenhum usuário selecionado.");
}

// Recupera os IDs selecionados
$ids = $_POST['ids'];

// Prepara a consulta para buscar os dados dos IDs selecionados
$placeholders = str_repeat('?,', count($ids) - 1) . '?';
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id IN ($placeholders)");
$stmt->execute($ids);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($usuarios)) {
    die("Nenhum usuário encontrado.");
}

// Criando o PDF com FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Cabeçalho do PDF
$pdf->Cell(0, 10, 'Detalhes dos Usuarios Selecionados', 0, 1, 'C');
$pdf->Ln(10); // Espaço

// Adicionando os dados de cada usuário
$pdf->SetFont('Arial', '', 12);
foreach ($usuarios as $usuario) {
    
    $pdf->Cell(50, 10, 'Nome:', 1);
    $pdf->Cell(0, 10, $usuario['nome'], 1, 1);

    $pdf->Cell(50, 10, 'E-mail:', 1);
    $pdf->Cell(0, 10, $usuario['email'], 1, 1);

    $pdf->Cell(50, 10, 'Valor do Pagamento:', 1);
    $pdf->Cell(0, 10, 'R$ ' . number_format($usuario['valor_pagamento'], 2, ',', '.'), 1, 1);

    $pdf->Cell(50, 10, 'Data de Pagamento:', 1);
    $pdf->Cell(0, 10, $usuario['data_pagamento'], 1, 1);
     

    $pdf->Cell(50, 10, 'Status do Pagamento:', 1);
    $pdf->Cell(0, 10, $usuario['status_pagamento'], 1, 1);

    $pdf->Ln(10); // Espaço entre os usuários
}

// Rodapé
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Gerado em: ' . date('d/m/Y H:i'), 0, 0, 'C');

// Gera o PDF para download
$pdf->Output('I', 'usuarios_selecionados.pdf');
?>
