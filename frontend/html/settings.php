<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

include '../html/header.php';

$user = $_SESSION['user'];
?>

<h2 class="settings-title">Mon compte</h2>

<?php if (isset($_SESSION['settings_message'])): ?>
    <p style="color: green;"><?= $_SESSION['settings_message'];
    unset($_SESSION['settings_message']); ?></p>
<?php endif; ?>

<form action="../../backend/index.php?action=update_user" method="POST" class="settings-section">
    <h4>Informations personnelles</h4>

    <label class="settings-label">Nom complet</label>
    <input type="text" name="full_name" class="settings-input" value="<?= htmlspecialchars($user['full_name']) ?>"
        required>

    <label class="settings-label">Email</label>
    <input type="email" name="email" class="settings-email" readonly value="<?= htmlspecialchars($user['email']) ?>"
        required>

    <button type="submit" name="update_info" class="settings-btn">Mettre à jour</button>
</form>

<hr class="settings-divider">

<form action="../../backend/index.php?action=update_user" method="POST" class="settings-section">
    <h4>Changer le mot de passe</h4>

    <label class="settings-label">Ancien mot de passe</label>
    <input type="password" name="old_password" class="settings-input" required>

    <label class="settings-label">Nouveau mot de passe</label>
    <input type="password" name="new_password" class="settings-input" required>

    <label class="settings-label">Confirmer le nouveau mot de passe</label>
    <input type="password" name="confirm_password" class="settings-input" required>

    <button type="submit" name="update_password" class="settings-btn">Changer le mot de passe</button>
</form>
</div>

<?php include '../html/footer.php'; ?>