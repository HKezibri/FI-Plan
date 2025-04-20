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




const now = new Date();
const daysInMonth = new Date(now.getFullYear(), now.getMonth() + 1, 0).getDate();

const labels = Array.from({ length: daysInMonth }, (_, i) => `${i + 1}`);

// Map API data into arrays with 0 fallback
const incomeMap = {};
const expenseMap = {};

dailyData.forEach(entry => {
  incomeMap[entry.day] = parseFloat(entry.total_income);
  expenseMap[entry.day] = parseFloat(entry.total_expense);
});

const incomeData = labels.map(day => incomeMap[day] || 0);
const expenseData = labels.map(day => expenseMap[day] || 0);

// Chart.js config
new Chart(document.getElementById('dailyChart'), {
  type: 'line',
  data: {
    labels,
    datasets: [
      {
        label: 'Recettes',
        data: incomeData,
        borderColor: 'green',
        backgroundColor: 'rgba(0,255,0,0.1)',
        fill: true
      },
      {
        label: 'Dépenses',
        data: expenseData,
        borderColor: 'red',
        backgroundColor: 'rgba(255,0,0,0.1)',
        fill: true
      }
    ]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { position: 'top' },
      title: {
        display: true,
        text: 'Évolution quotidienne des recettes et dépenses (ce mois)'
      }
    }
  }
});

