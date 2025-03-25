<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FI-PLAN | Transactions</title>
    <link rel="stylesheet" href="../css/sidebar_style.css" />
    <link rel="stylesheet" href="../css/transactions_style.css" />
    <script src="../js/sidebarScript.js" defer></script>
</head>

<body>
    <div class="dashboard-container">
        <?php include '../components/sidebar.php'; ?>

        <main class="content">
            <h2>Historique des Transactions</h2>

            <table class="transaction-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Montant</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="expense">
                        <td>Hospital</td>
                        <td>Hier, 14:00</td>
                        <td>Dépense</td>
                        <td class="amount">- €1,900</td>
                        <td>
                            <button class="delete-btn" title="Supprimer">🗑️</button>
                        </td>
                    </tr>
                    <tr class="income">
                        <td>Alfredo Torres</td>
                        <td>Hier, 10:00</td>
                        <td>Recette</td>
                        <td class="amount">+ €2,000</td>
                        <td>
                            <button class="delete-btn" title="Supprimer">🗑️</button>
                        </td>
                    </tr>
                    <tr class="income">
                        <td>Claudia Alves</td>
                        <td>Hier, 04:00</td>
                        <td>Recette</td>
                        <td class="amount">+ €2,500</td>
                        <td>
                            <button class="delete-btn" title="Supprimer">🗑️</button>
                        </td>
                    </tr>
                    <tr class="expense">
                        <td>Installment</td>
                        <td>1 mois, 16:00</td>
                        <td>Dépense</td>
                        <td class="amount">- €200</td>
                        <td>
                            <button class="delete-btn" title="Supprimer">🗑️</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </main>

    </div>

    <script src="../js/transactionsScript.js" defer></script>

</body>

</html>