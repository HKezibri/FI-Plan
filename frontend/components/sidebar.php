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
    <li><a href="#">📊 Statistiques</a></li>
    <li><a href="#">📤 Exporter dépenses</a></li>
    <li><a href="#">➕ Ajouter dépense</a></li>
    <li><a href="#">➕ Ajouter recette</a></li>
    <li><a href="#">⚙️ Paramètres</a></li>
    <li><a href="../../backend/index.php?action=logout">🚪 Déconnexion</a></li>
    <li><a href="#">💡 Conseils</a></li>
  </ul>
</aside>