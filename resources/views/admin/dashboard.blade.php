@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h1 class="mb-4">Welcome to the Admin Dashboard</h1>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <h4>Total Users</h4>
                <p class="display-5" id="user-count">Loading...</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <h4>Pending Bookings</h4>
                <p class="display-5" id="pending-bookings">Loading...</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <h4>Transactions</h4>
                <p class="display-5">$54,210</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <h4>Unresolved Tickets</h4>
                <p class="display-5" id="unresolved-tickets">Loading...</p>
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
            <div class="stat-card">
                <h4>Recent Transactions</h4>
                <ul class="list-unstyled">
                    <li>Transaction 1: $200</li>
                    <li>Transaction 2: $150</li>
                    <li>Transaction 3: $400</li>
                    <li>Transaction 4: $300</li>
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
        axios.get('/admin/user-count')
            .then(response => {
                document.getElementById('user-count').textContent = response.data.count;
            })
            .catch(error => {
                console.error('Error fetching user count:', error);
                document.getElementById('user-count').textContent = 'Error';
            });

            axios.get('/admin/pending-bookings')
            .then(response => {
                document.getElementById('pending-bookings').textContent = response.data.count;
            })
            .catch(error => {
                console.error('Error fetching pending bookings:', error);
                document.getElementById('pending-bookings').textContent = 'Error';
            });

            axios.get('/admin/unresolved-tickets')
            .then(response => {
                document.getElementById('unresolved-tickets').textContent = response.data.count;
            })
            .catch(error => {
                console.error('Error fetching unresolved tickets:', error);
                document.getElementById('unresolved-tickets').textContent = 'Error';
            });
    });
</script>
@endpush
