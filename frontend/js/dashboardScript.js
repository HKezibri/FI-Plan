// Catégories
const categoryLabels = categoryData.map(item => item.category_name);
const categoryValues = categoryData.map(item => item.total);

// Mois
const monthLabels = monthlyData.map(item => item.month);
const monthValues = monthlyData.map(item => item.total);

// Camembert
new Chart(document.getElementById('categoryChart'), {
  type: 'pie',
  data: {
    labels: categoryLabels,
    datasets: [{
      data: categoryValues,
      backgroundColor: ['#f7c100', '#f76d6d', '#6df7d8', '#8f6df7', '#ffb347']
    }]
  }
});


const months = monthlyComparisonData.map(item => item.month);
const expenses = monthlyComparisonData.map(item => parseFloat(item.total_expense));
const incomes = monthlyComparisonData.map(item => parseFloat(item.total_income));

new Chart(document.getElementById('monthlyChart'), {
  type: 'line',
  data: {
    labels: months,
    datasets: [
      {
        label: 'Dépenses',
        data: expenses,
        borderColor: 'red',
        backgroundColor: 'rgba(255, 0, 0, 0.1)',
        fill: true
      },
      {
        label: 'Recettes',
        data: incomes,
        borderColor: 'green',
        backgroundColor: 'rgba(0, 255, 0, 0.1)',
        fill: true
      }
    ]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top'
      },
      title: {
        display: true,
        text: 'Évolution mensuelle des recettes et dépenses'
      }
    }
  }
});

