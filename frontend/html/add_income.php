<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FI-PLAN | Ajouter une Recette</title>
    <link rel="stylesheet" href="../css/sidebar_style.css" />
    <link rel="stylesheet" href="../css/add_expense_style.css" /> <!-- Reuse style -->
    <script src="../js/sidebarScript.js" defer></script>
    <script src="../js/add_income_script.js" defer></script>
</head>

<body>
    <div class="dashboard-container">
        <?php include '../components/sidebar.php'; ?>

        <main class="content">
            <h2>Ajouter une Recette</h2>

            <form action="../../backend/index.php?action=add_income" method="POST" class="expense-form" id="incomeForm">
                <div class="left-form">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required>

                    <label for="amount">Montant (€)</label>
                    <input type="number" id="amount" name="amount" step="0.01" required>

                    <label for="comment">Commentaire (optionnel)</label>
                    <textarea id="comment" name="comment" rows="3"></textarea>
                </div>

                <div class="right-categories">
                    <h3>Catégories de recette</h3>

                    <div class="add-category">
                        <input type="text" id="newIncomeCategory" placeholder="Ajouter une catégorie" />
                        <button type="button" id="addIncomeCategoryBtn">+</button>
                    </div>

                    <div class="category-list" id="incomeCategoryList">
                        <label><input type="checkbox" name="categories[]" value="Alternance"> Alternance</label>
                        <label><input type="checkbox" name="categories[]" value="Job étudiant"> Job étudiant</label>
                        <label><input type="checkbox" name="categories[]" value="Virement"> Virement</label>
                        <label><input type="checkbox" name="categories[]" value="Bourse"> Bourse</label>
                        <label><input type="checkbox" name="categories[]" value="Autre"> Autre</label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit">Ajouter la recette</button>
                </div>
            </form>
        </main>
    </div>
</body>

</html>