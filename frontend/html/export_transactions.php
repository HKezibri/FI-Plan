<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once '../../libs/tcpdf.php';
require_once '../../backend/models/Transaction.php';

$user = $_SESSION['user'];
$user_id = $user['id'];
$transactionModel = new Transaction();
$transactions = $transactionModel->getAllByUser($user_id);

// Initialisation PDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Métadonnées
$pdf->SetCreator('FI-PLAN');
$pdf->SetAuthor($user['full_name']);
$pdf->SetTitle('Historique des transactions');
$pdf->SetMargins(15, 25, 15);
$pdf->SetAutoPageBreak(TRUE, 20);
$pdf->SetFont('helvetica', '', 10);
$pdf->AddPage();

// En-tête utilisateur
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Historique des transactions', 0, 1, 'C');
$pdf->Ln(4);

$pdf->SetFont('helvetica', '', 11);
$pdf->Cell(0, 6, 'Nom : ' . $user['full_name'], 0, 1);
$pdf->Cell(0, 6, 'Email : ' . $user['email'], 0, 1);
$pdf->Cell(0, 6, 'Date : ' . date('d/m/Y'), 0, 1);
$pdf->Ln(5);

// Table HTML
$html = '
<style>
  table {
    border-collapse: collapse;
    width: 100%;
    font-size: 10pt;
  }
  th {
    background-color: #f7c100;
    color: #000;
    font-weight: bold;
    text-align: center;
    border: 1px solid #999;
  }
  td {
    border: 1px solid #ccc;
    padding: 5px;
  }
</style>

<table>
  <thead>
    <tr>
      <th>Date</th>
      <th>Type</th>
      <th>Catégorie</th>
      <th>Montant (€)</th>
      <th>Paiement</th>
      <th>Commentaire</th>
    </tr>
  </thead>
  <tbody>
';

foreach ($transactions as $tx) {
    $html .= '<tr>
    <td align="center">' . htmlspecialchars($tx['transaction_date']) . '</td>
    <td align="center">' . ucfirst($tx['type']) . '</td>
    <td>' . htmlspecialchars($tx['category_name']) . '</td>
    <td align="right">' . number_format($tx['amount'], 2, ',', ' ') . '</td>
    <td>' . htmlspecialchars($tx['payment_method']) . '</td>
    <td>' . htmlspecialchars($tx['comment']) . '</td>
  </tr>';
}

$html .= '</tbody></table>';

// Écrire le HTML dans le PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Générer le PDF
$pdf->Output('transactions_' . date('Ymd') . '.pdf', 'I');
