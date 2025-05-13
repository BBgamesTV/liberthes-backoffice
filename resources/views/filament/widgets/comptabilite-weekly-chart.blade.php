<div class="widget-wrapper">
    <canvas id="weeklyTransactionChart"></canvas>

    <script>
        const ctx = document.getElementById('weeklyTransactionChart').getContext('2d');
        const weeklyTransactionChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels), // Jours de la semaine
                datasets: [
                    {
                        label: 'Revenus',
                        data: @json($revenus), // Données des revenus
                        borderColor: '#22c55e',
                        backgroundColor: '#22c55e',
                        fill: false,
                    },
                    {
                        label: 'Dépenses',
                        data: @json($depenses), // Données des dépenses
                        borderColor: '#ef4444',
                        backgroundColor: '#ef4444',
                        fill: false,
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Jour de la semaine'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Montant (€)'
                        }
                    }
                }
            }
        });
    </script>
</div>
