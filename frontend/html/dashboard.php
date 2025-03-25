<!-- frontend/html/dashboard.html -->
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FI-PLAN | Tableau de Bord</title>
  <link rel="stylesheet" href="../css/dashboard_style.css" />
  <link rel="stylesheet" href="../css/sidebar_style.css" />
  <script src="../js/sidebarScript.js" defer></script>
</head>

<body>
  <div class="container">
    <?php include '../components/sidebar.php'; ?>

    <main class="content">
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

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../js/dashboardScript.js"></script>

</body>

</html>