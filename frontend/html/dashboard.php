<?php include '../html/header.php'; ?>

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