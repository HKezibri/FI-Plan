<!-- frontend/components/sidebar.php -->

<!-- Sidebar HTML -->
<div class="menu-toggle" id="menuToggle" onclick="toggleMenu()">☰</div>

<aside class="sidebar" id="sidebarMenu">
  <div class="logo">
    FI-Plan
    <span class="close-menu" onclick="toggleMenu()">✖</span>
  </div>
  <ul class="nav-links">
    <li><a href="dashboard.php">🏠 Tableau de bord</a></li>
    <li><a href="statistics.php">📊 Statistiques</a></li>
    <li><a href="export_expense.php">📤 Exporter dépenses</a></li>
    <li><a href="add_expense.php">➕ Ajouter dépense</a></li>
    <li><a href="add_income.php">➕ Ajouter recette</a></li>
    <li><a href="settings.php">⚙️ Paramètres</a></li>
    <li><a href="../../backend/index.php?action=logout">🚪 Déconnexion</a></li>
    <li><a href="tips.php">💡 Conseils</a></li>
  </ul>
</aside>