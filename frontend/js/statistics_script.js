const months = monthlyTotals.map(row => row.month);
const incomes = monthlyTotals.map(row => parseFloat(row.income));
const expenses = monthlyTotals.map(row => parseFloat(row.expense));

new Chart(document.getElementById('incomeVsExpenseChart'), {
  type: 'line',
  data: {
    labels: months,
    datasets: [
      {
        label: 'Recettes',
        data: incomes,
        borderColor: 'green',
        fill: false,
      },
      {
        label: 'Dépenses',
        data: expenses,
        borderColor: 'red',
        fill: false,
      }
    ]
  }
});


new Chart(document.getElementById('categoryPieChart'), {
    type: 'pie',
    data: {
        labels: categoryTotals.map(row => row.category_name),
        datasets: [{
        data: categoryTotals.map(row => row.total),
        backgroundColor: ['#f7c100', '#f76d6d', '#6df7d8', '#8f6df7', '#ffb347']
      }]
    }
});

  
new Chart(document.getElementById('paymentBarChart'), {
type: 'bar',
    data: {
        labels: paymentTotals.map(row => row.payment_method),
        datasets: [{
        label: 'Dépenses (€)',
        data: paymentTotals.map(row => row.total),
        backgroundColor: '#f7c100'
        }]
    }
});
  