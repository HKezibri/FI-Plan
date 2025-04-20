<?php
require_once __DIR__ . '/../models/Transaction.php';

class TransactionController
{
    public function index($userId)
    {
        $transaction = new Transaction();
        $transactions = $transaction->getAllByUser($userId);
        echo json_encode($transactions);
    }

    public function delete($post, $userId)
    {
        $transaction = new Transaction();
        $success = $transaction->delete($post['id'], $userId);

        session_start();
        if ($success) {
            $_SESSION['message'] = 'Transaction supprimée avec succès.';
        } else {
            $_SESSION['message'] = 'Erreur lors de la suppression.';
        }

        header('Location: ../frontend/html/transactions.php');
        exit;
    }

}
