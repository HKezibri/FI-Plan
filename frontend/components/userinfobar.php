<?php
if (!isset($_SESSION))
    session_start();

// Default values if user not logged in
$userName = $_SESSION['user']['name'] ?? 'Invité';
$userRole = $_SESSION['user']['role'] ?? 'Visiteur';
$userAvatar = $_SESSION['user']['avatar'] ?? '../assets/user.png';
?>

<div class="topbar">
    <div class="date-picker">
        <span class="calendar-icon">📅</span>
        <input type="text" value="<?= date('d-m-Y') ?>" readonly />
    </div>

    <div class="user-info">
        <div class="dropdown">
            <span class="account-label" onclick="toggleDropdown()">Mon compte ▼</span>
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="#">Profil</a>
                <a href="../../backend/index.php?action=logout">Déconnexion</a>
            </div>
        </div>

        <div class="user-details">
            <span class="username"><?= htmlspecialchars($userName) ?></span>
            <span class="role"><?= htmlspecialchars($userRole) ?></span>
        </div>
        <img src="<?= $userAvatar ?>" alt="User Avatar" class="user-avatar">
    </div>
</div>