<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

include '../html/header.php';
require_once '../../backend/models/Category.php';

$categoryModel = new Category();
$categories = $categoryModel->getExpenseCategories();

if (isset($_SESSION['message'])): ?>
    <p style="color: green;"><?= $_SESSION['message'];
    unset($_SESSION['message']); ?></p>
<?php endif;

?>
<h2>Ajouter une Dépense</h2>

<form action="../../backend/index.php?action=add_expense" method="POST" class="expense-form" id="expenseForm">
    <div class="left-form">
        <label for="date">Date</label>
        <input type="date" name="transaction_date" required>

        <label for="amount">Montant (€)</label>
        <input type="number" id="amount" name="amount" step="0.01" required>

        <label for="payment_method">Mode de paiement</label>
        <select id="payment_method" name="payment_method" required>
            <option value="Carte bancaire">Carte bancaire</option>
            <option value="Espèces">Espèces</option>
        </select>

        <label for="comment">Commentaire (optionnel)</label>
        <textarea id="comment" name="comment" rows="3"></textarea>
    </div>

    <div class="right-categories">
        <h3>Catégories de dépense</h3>

        <div class="add-category">
            <input type="text" id="newCategoryInput" placeholder="Ajouter une catégorie" />
            <button type="button" id="addCategoryBtn">+</button>
        </div>

        <div class="category-list" id="categoryList">
            <?php foreach ($categories as $cat): ?>
                <label>
                    <input type="radio" name="category_name" value="<?= htmlspecialchars($cat['name']) ?>" required>
                    <?= htmlspecialchars($cat['name']) ?>
                </label>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit">Ajouter la dépense</button>
    </div>
</form>
</main>

</div>

<?php include '../html/footer.php'; ?>