// Get the balance elements
const currentBalanceElement = document.getElementById('current-balance');
const debitBalanceElement = document.getElementById('debit-balance');

// Initialize the balances
let currentBalance = 0;
let debitBalance = 0;

// Update the balance displays
function updateBalances() {
  currentBalanceElement.textContent = `$${currentBalance.toFixed(2)}`;
  debitBalanceElement.textContent = `$${debitBalance.toFixed(2)}`;
}

// Add daily savings
function addDailySavings(amount) {
  currentBalance += amount;
  updateBalances();
  updateSavingsChart(amount);
}

// Savings chart
const ctx = document.getElementById('savings-chart').getContext('2d');
const savingsChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [],
    datasets: [{
      label: 'Daily Savings',
      data: [],
      backgroundColor: '#4CAF50',
      borderColor: '#4CAF50',
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      x: {
        display: true,
        title: {
          display: true,
          text: 'Jours'
        }
      },
      y: {
        beginAtZero: true,
        ticks: {
          callback: function(value) {
            return '$' + value;
          }
        },
        title: {
          display: true,
          text: 'Montant'
        }
      }
    },
    plugins: {
      title: {
        display: false,
      },
      legend: {
        display: false
      }
    }
  }
});

// Update the savings chart
function updateSavingsChart(amount) {
  const now = new Date();
  const label = `${now.getDate()}/${now.getMonth() + 1}`;

  // Check if the label already exists in the chart
  const index = savingsChart.data.labels.indexOf(label);
  if (index !== -1) {
    savingsChart.data.datasets[0].data[index] += amount;
  } else {
    savingsChart.data.labels.push(label);
    savingsChart.data.datasets[0].data.push(amount);
  }

  savingsChart.update();
}