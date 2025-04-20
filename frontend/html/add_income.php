<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

include '../html/header.php';
require_once '../../backend/models/Category.php';

$categoryModel = new Category();
$categories = $categoryModel->getIncomeCategories();

if (isset($_SESSION['message'])): ?>
    <p style="color: green;"><?= $_SESSION['message'];
    unset($_SESSION['message']); ?></p>
<?php endif;
?>
<h2>Ajouter une Recette</h2>

<form action="../../backend/index.php?action=add_income" method="POST" class="expense-form" id="incomeForm">
    <div class="left-form">
        <label for="date">Date</label>
        <input type="date" id="date" name="transaction_date" required>

        <label for="amount">Montant (€)</label>
        <input type="number" id="amount" name="amount" step="0.01" required>

        <label for="comment">Commentaire (optionnel)</label>
        <textarea id="comment" name="comment" rows="3"></textarea>
    </div>

    <div class="right-categories">
        <h3>Catégories de recette</h3>

        <div class="add-category">
            <input type="text" id="newCategoryInput" placeholder="Ajouter une catégorie" />
            <button type="button" id="addCategoryBtn">+</button>
        </div>

        <div class="category-list" id="categoryList">
            <?php foreach ($categories as $cat): ?>
                <label>
                    <input type="radio" name="category_name" value="<?= htmlspecialchars($cat['name']) ?>" required />
                    <?= htmlspecialchars($cat['name']) ?>
                </label>
            <?php endforeach; ?>
        </div>

    </div>

    <div class="form-actions">
        <button type="submit">Ajouter la recette</button>
    </div>
</form>
</main>
</div>
<?php include '../html/footer.php'; ?>