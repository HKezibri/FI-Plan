<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}

include '../html/header.php';

require_once '../../backend/models/Transaction.php';

$transactionModel = new Transaction();
$user_id = $_SESSION['user']['id'];

$expensesByCategory = $transactionModel->getExpensesByCategory($user_id);
$expensesByMonth = $transactionModel->getExpensesByMonth($user_id);
$monthlyComparison = $transactionModel->getIncomeAndExpensesByMonth($user_id);

?>
<script>
  const categoryData = <?= json_encode($expensesByCategory) ?>;
  const monthlyData = <?= json_encode($expensesByMonth) ?>;
  const monthlyComparisonData = <?= json_encode($monthlyComparison) ?>;
</script>

<section class="top-card">
  <h3>Budget restant</h3>
  <div class="budget-box">
    <span>€920</span>
    <button>Définir</button>
  </div>
</section>

<section class="charts">
  <div class="chart">
    <h4>Dépenses par catégorie</h4>
    <canvas id="categoryChart"></canvas>
  </div>
  <div class="chart">
    <h4>Évolution mensuelle des dépenses</h4>
    <canvas id="monthlyChart"></canvas>
  </div>
</section>

<section class="tips">
  <h4>Conseil</h4>
  <p>Vous avez dépensé 40% de votre budget en sorties ce mois-ci. Pensez à réduire ces dépenses.</p>
</section>
</main>
</div>

<?php include '../html/footer.php'; ?>