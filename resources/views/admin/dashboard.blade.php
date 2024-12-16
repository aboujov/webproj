@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h1 class="mb-4">Welcome to the Admin Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card d-flex flex-column align-items-center justify-content-center" style="height: 9rem; max-height: 9rem;">
                <div id="spinner1" class="spinner-border text-primary" role="status"></div>
                <h4 id="user-count-heading"></h4>
                <p class="display-5" id="user-count"></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card d-flex flex-column align-items-center justify-content-center" style="height: 9rem; max-height: 9rem;">
                <h4 id="pending-bookings-heading"></h4>
                <div id="spinner2" class="spinner-border text-primary" role="status"></div>
                <p class="display-5" id="pending-bookings"></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card d-flex flex-column align-items-center justify-content-center" style="height: 9rem; max-height: 9rem;">
                <h4 id="transactions-heading"></h4>
                <div id="spinner3" class="spinner-border text-primary" role="status"></div>
                <p class="display-5" id="transactions"></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card d-flex flex-column align-items-center justify-content-center" style="height: 9rem; max-height: 9rem;">
                <h4 id="unresolved-tickets-heading"></h4>
                <div id="spinner4" class="spinner-border text-primary" role="status"></div>
                <p class="display-5" id="unresolved-tickets"></p>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="chart-container">
                <h4>Weekly Bookings Overview</h4>
                <canvas id="userActivityChart"></canvas>
            </div>
        </div>
        <div class="col-md-4 d-flex flex-column justify-content-between">
            <div class="stat-card d-flex flex-column align-items-center justify-content-center">
                <h4 id="recent-transactions-heading"></h4>
                <ul class="list-unstyled" id="recent-transactions">
                    <div id="spinner5" class="spinner-border text-primary" role="status"></div>
                </ul>
            </div>
            <div class="chart-container">
                <h4>User Roles Distribution</h4>
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('userActivityChart').getContext('2d');
        let userActivityChart;

        // Fetch Weekly Bookings Data
        axios.get('/admin/weekly-bookings')
            .then(response => {
                const data = response.data;

                // Extract labels and data points
                const labels = data.map(entry => entry.date);
                const bookingCounts = data.map(entry => entry.count);

                // Destroy existing chart if it exists
                if (userActivityChart) {
                    userActivityChart.destroy();
                }

                // Create chart with dynamic data
                userActivityChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Bookings',
                            data: bookingCounts,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            fill: false
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                        },
                        scales: {
                            x: {
                                beginAtZero: true
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching weekly bookings:', error);
            });

    const barCtx = document.getElementById('barChart').getContext('2d');
    let barChart;

    axios.get('/admin/user-roles')
        .then(response => {
            const data = response.data;

            // Extract labels and data
            const labels = data.map(role => role.role.charAt(0).toUpperCase() + role.role.slice(1));
            const counts = data.map(role => role.count);

            // Destroy existing chart if it exists
            if (barChart) {
                barChart.destroy();
            }

            // Create the chart with API data
            barChart = new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'User Roles',
                        data: counts,
                        backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'], // Add more colors if needed
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                    },
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching user roles:', error);
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Total Users
        axios.get('/admin/user-count')
            .then(response => {
                document.getElementById('spinner1').remove();
                document.getElementById('user-count-heading').textContent = 'Total Users';
                document.getElementById('user-count').textContent = response.data.count || 'No data available';
            })
            .catch(error => {
                document.getElementById('user-count').textContent = 'Error fetching user count';
                console.error('Error fetching user count:', error);
            });

        // Pending Bookings
        axios.get('/admin/pending-bookings')
            .then(response => {
                document.getElementById('spinner2').remove();
                document.getElementById('pending-bookings-heading').textContent = 'Pending Bookings';
                document.getElementById('pending-bookings').textContent = response.data.count || 'No pending bookings';
            })
            .catch(error => {
                document.getElementById('pending-bookings').textContent = 'Error fetching pending bookings';
                console.error('Error fetching pending bookings:', error);
            });

        // Transactions Total Amount
        axios.get('/admin/transactions/total-amount')
            .then(response => {
                document.getElementById('spinner3').remove();
                document.getElementById('transactions-heading').textContent = 'Transactions';
                document.getElementById('transactions').textContent = `$ ${response.data.total_amount}` || 'No transactions';
            })
            .catch(error => {
                document.getElementById('transactions').textContent = 'Error fetching transactions';
                console.error('Error fetching transactions:', error);
            });

        // Unresolved Tickets
        axios.get('/admin/unresolved-tickets')
            .then(response => {
                document.getElementById('spinner4').remove();
                document.getElementById('unresolved-tickets-heading').textContent = 'Unresolved Tickets';
                document.getElementById('unresolved-tickets').textContent = response.data.count || 'No unresolved tickets';
            })
            .catch(error => {
                document.getElementById('unresolved-tickets').textContent = 'Error fetching unresolved tickets';
                console.error('Error fetching unresolved tickets:', error);
            });

        // Recent Transactions
        axios.get('/admin/transactions/last')
            .then(response => {
                const transactions = response.data || [];
                document.getElementById('spinner5').remove();
                document.getElementById('recent-transactions-heading').textContent = 'Recent Transactions';

                const recentTransactionsList = document.getElementById('recent-transactions');
                recentTransactionsList.innerHTML = '';

                if (transactions.length > 0) {
                    transactions.forEach(transaction => {
                        const listItem = document.createElement('li');
                        listItem.textContent = `$ ${transaction.amount} - ${transaction.status}`;
                        recentTransactionsList.appendChild(listItem);
                    });
                } else {
                    recentTransactionsList.textContent = 'No recent transactions available.';
                }
            })
            .catch(error => {
                document.getElementById('recent-transactions').textContent = 'Error loading transactions.';
                console.error('Error fetching recent transactions:', error);
            });
    });
</script>
@endpush
