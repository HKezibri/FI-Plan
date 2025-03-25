<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FI-PLAN | Ajouter une Dépense</title>
    <link rel="stylesheet" href="../css/sidebar_style.css" />
    <link rel="stylesheet" href="../css/add_expense_style.css" />
    <script src="../js/sidebarScript.js" defer></script>
</head>

<body>
    <div class="dashboard-container">
        <?php include '../components/sidebar.php'; ?>

        <main class="content">
            <h2>Ajouter une Dépense</h2>

            <form action="../../backend/index.php?action=add_expense" method="POST" class="expense-form"
                id="expenseForm">
                <div class="left-form">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required>

                    <label for="amount">Montant (€)</label>
                    <input type="number" id="amount" name="amount" step="0.01" required>

                    <label for="payment">Mode de paiement</label>
                    <select id="payment" name="payment" required>
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
                        <label><input type="checkbox" name="categories[]" value="Logement"> Logement</label>
                        <label><input type="checkbox" name="categories[]" value="Alimentation"> Alimentation</label>
                        <label><input type="checkbox" name="categories[]" value="Transport"> Transport</label>
                        <label><input type="checkbox" name="categories[]" value="Loisirs"> Loisirs</label>
                        <label><input type="checkbox" name="categories[]" value="Études"> Études</label>
                        <label><input type="checkbox" name="categories[]" value="Abonnements"> Abonnements</label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit">Ajouter la dépense</button>
                </div>
            </form>
        </main>

    </div>

    <script src="../js/add_expense_script.js" defer></script>

</body>

</html>