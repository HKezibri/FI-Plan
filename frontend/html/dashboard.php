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

require_once '../../backend/models/Tip.php';

$tipModel = new Tip();
$randomTip = $tipModel->getRandomTip();


require_once '../../backend/models/Budget.php';
$budgetModel = new Budget();

$remaining = $budgetModel->getRemainingBudget($user_id);


$dailyData = $transactionModel->getDailyIncomeExpenseThisMonth($user_id);

require_once '../../backend/models/Tip.php';

$tipModel = new Tip();

// Always show a random tip (whether GET is set or not)
$randomTip = $tipModel->getRandomTip();

?>
<script>
  const categoryData = <?= json_encode($expensesByCategory) ?>;
  const monthlyData = <?= json_encode($expensesByMonth) ?>;
  const monthlyComparisonData = <?= json_encode($monthlyComparison) ?>;
  const dailyData = <?= json_encode($dailyData) ?>;

</script>

<section class="top-card">
  <h3>Budget restant</h3>

  <?php
  if (isset($_SESSION['message'])): ?>
    <p style="color: green;"><?= $_SESSION['message'];
    unset($_SESSION['message']); ?></p>
  <?php endif;

  ?>

  <div class="budget-box">
    <strong>€<?= number_format($remaining, 2, ',', ' ') ?></strong>
    <form action="../../backend/index.php?action=set_budget" method="POST" style="display:inline;">
      <input type="number" name="amount" step="0.01" placeholder="Définir budget" required>
      <button type="submit" class="set-btn">Définir</button>
    </form>

  </div>
</section>

<section class="charts">
  <div class="chart-categ">
    <h4>Dépenses par catégorie</h4>
    <canvas id="categoryChart"></canvas>
  </div>
  <div class="chart-evo">
    <h4>Évolution du mois des recettes et dépenses</h4>
    <canvas id="dailyChart"></canvas>
  </div>
</section>

<section class="tips">
  <h4>Conseil</h4>
  <p><?= htmlspecialchars($randomTip['message']) ?></p>
</section>
</main>
</div>

<?php include '../html/footer.php'; ?>