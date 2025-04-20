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

    public function addExpense($post, $userId)
    {
        $transaction = new Transaction();

        $data = [
            'user_id' => $userId,
            'category_name' => $post['category_name'],
            'type' => 'expense',
            'amount' => $post['amount'],
            'payment_method' => $post['payment_method'],
            'comment' => $post['comment'],
            'transaction_date' => $post['transaction_date']
        ];

        session_start();
        if ($transaction->add($data)) {
            $_SESSION['message'] = 'Dépense ajoutée avec succès.';
        } else {
            $_SESSION['message'] = 'Erreur lors de l\'ajout de la dépense.';
        }

        header('Location: ../frontend/html/add_expense.php');
        exit;
    }

}
