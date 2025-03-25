// Sample data for charts
const ctx1 = document.getElementById('categoryChart');
const ctx2 = document.getElementById('monthlyChart');

// Pie chart
new Chart(ctx1, {
  type: 'pie',
  data: {
    labels: ['Logement', 'Loisirs', 'Transport', 'Alimentation'],
    datasets: [{
      data: [300, 150, 100, 200],
      backgroundColor: ['#f7c100', '#f76d6d', '#6df7d8', '#8f6df7']
    }]
  }
});

// Line chart
new Chart(ctx2, {
  type: 'line',
  data: {
    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai'],
    datasets: [{
      label: 'Dépenses mensuelles',
      data: [400, 300, 450, 380, 500],
      borderColor: '#f7c100',
      fill: false
    }]
  }
});
