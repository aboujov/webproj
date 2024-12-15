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
    <div class="row">
        <div class="col-md-8">
            <div class="chart-container">
                <h4>User Activity</h4>
                <canvas id="userActivityChart"></canvas>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card d-flex flex-column align-items-center justify-content-center">
                <h4 id="recent-transactions-heading"></h4>
                <ul class="list-unstyled" id="recent-transactions">
                    <div id="spinner5" class="spinner-border text-primary" role="status"></div>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('userActivityChart').getContext('2d');
    const userActivityChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            datasets: [{
                label: 'Active Users',
                data: [120, 200, 150, 220, 300, 250, 400],
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
