<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .sidebar {
            position: fixed;
            height: 100%;
            min-width: 275px;
            max-width: 275px;
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.2s;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar h2 {
            color: #fff;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
            margin-left: 275px;
        }
        .stat-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .chart-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .logout-btn {
            background-color: #dc3545;
            color: #ffffff;
            text-align: center;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            display: block;
            margin-top: 20px;
            transition: background-color 0.2s;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <h2>Admin Dashboard</h2>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.announcements.index') }}">Manage Announcements</a>
            <a href="{{ route('admin.bookings') }}">Manage Bookings</a>
            <a href="{{ route('admin.properties') }}">Manage Properties</a>
            <a href="{{ route('admin.analytics') }}">Analytics</a>
            <a href="{{ route('admin.users') }}">User Management</a>
            <a href="{{ route('admin.hosts') }}">Manage Hosts</a>
            <a href="{{ route('admin.tickets') }}">Manage Tickets</a>
            <a href="{{ route('admin.transactions') }}">Manage Transactions</a>
        </div>
        <a href="{{ route('logout') }}" class="logout-btn">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @stack('scripts')
</body>
</html>
