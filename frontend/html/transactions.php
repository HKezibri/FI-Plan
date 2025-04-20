<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

include '../html/header.php';
require_once '../../backend/models/Transaction.php';

$user_id = $_SESSION['user']['id'];
$transactionModel = new Transaction();
$transactions = $transactionModel->getAllByUser($user_id);
?>

<h2>Historique des Transactions</h2>

<?php if (empty($transactions)): ?>
    <p>Aucune transaction trouvée.</p>
<?php else: ?>
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
            <?php foreach ($transactions as $tx): ?>

                <tr class="<?= $tx['type'] === 'expense' ? 'expense' : 'income' ?>">
                    <td><?= htmlspecialchars($tx['category_name']) ?></td>
                    <td><?= date('d/m/Y', strtotime($tx['transaction_date'])) ?></td>
                    <td><?= ucfirst($tx['type']) ?></td>
                    <td class="amount"><?= $tx['type'] === 'expense' ? '-' : '+' ?>
                        € <?= number_format($tx['amount'], 2, ',', ' ') ?></td>
                    <td>
                        <form action="../../backend/index.php?action=delete_transaction" method="POST"
                            onsubmit="return confirm('Supprimer cette transaction ?');">
                            <input type="hidden" name="id" value="<?= $tx['id'] ?>">
                            <button type="submit" class="delete-btn" title="Supprimer">🗑️</button>
                        </form>

                    </td>
                </tr>

            <?php endforeach; ?>
        <?php endif; ?>


    </tbody>
</table>
</main>



<?php include '../html/footer.php'; ?>