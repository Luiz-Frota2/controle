<?php
require('fpdf/fpdf.php');
include 'database.php';

// Obtém o ID do usuário
$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuário não encontrado.");
}

// Criando o PDF com FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Cabeçalho do PDF
$pdf->Cell(0, 10, 'Detalhes do Usuario', 0, 1, 'C');
$pdf->Ln(10); // Espaço

// Dados do Usuário
$pdf->SetFont('Arial', '', 12);


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

$pdf->Ln(10); // Espaço

// Rodapé
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Gerado em: ' . date('d/m/Y H:i'), 0, 0, 'C');

// Gera o PDF para download
$pdf->Output('I', 'usuario_' . $usuario['id'] . '.pdf');
?>
