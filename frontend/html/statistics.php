<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

include '../html/header.php';

require_once '../../backend/models/Transaction.php';
$transactionModel = new Transaction();
$userId = $_SESSION['user']['id'];

$monthlyTotals = $transactionModel->getMonthlyTotals($userId);
$categoryTotals = $transactionModel->getExpensesByCategory($userId);
$paymentTotals = $transactionModel->getByPaymentMethod($userId);

?>

<script>
    const monthlyTotals = <?= json_encode($monthlyTotals) ?>;
    const categoryTotals = <?= json_encode($categoryTotals) ?>;
    const paymentTotals = <?= json_encode($paymentTotals) ?>;
</script>

<div class="chart-grid">
    <div class="chart-block">
        <h3>Évolution mensuelle des recettes et dépenses</h3>
        <canvas id="incomeVsExpenseChart"></canvas>
    </div>

    <div class="chart-block">
        <h3>Dépenses par catégorie</h3>
        <canvas id="categoryPieChart"></canvas>
    </div>

    <div class="chart-block">
        <h3>Dépenses par mode de paiement</h3>
        <canvas id="paymentBarChart"></canvas>
    </div>
</div>


</main>

</div>

<?php include '../html/footer.php'; ?>