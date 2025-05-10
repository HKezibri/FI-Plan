<?php
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
$user = $_SESSION['user'];
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
                <p><strong>Nom :</strong> <?= htmlspecialchars($user['full_name']) ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
                <a href="../../backend/index.php?action=logout">Déconnexion</a>
            </div>
        </div>

        <div class="user-details">
            <span class="username" style="margin-bottom: 0px;"><?= htmlspecialchars($user['full_name']) ?></span>
            <span class="role"><?= htmlspecialchars($user['role']) ?></span>
        </div>
        <img src="../assets/user.png" alt="User Avatar" class="user-avatar">
    </div>
</div>