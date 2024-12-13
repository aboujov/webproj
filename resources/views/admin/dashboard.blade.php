<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <h1 class="my-4">Admin Dashboard</h1>

        <!-- Dashboard Quick Links -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <a href="{{ route('admin.announcements.index') }}" class="btn btn-primary btn-block">
                    Manage Announcements
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('admin.bookings') }}" class="btn btn-primary btn-block">
                    Manage Bookings
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('admin.properties') }}" class="btn btn-primary btn-block">
                    Manage Properties
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('admin.analytics') }}" class="btn btn-primary btn-block">
                    Analytics
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('admin.users') }}" class="btn btn-primary btn-block">
                    User Management
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('admin.hosts') }}" class="btn btn-primary btn-block">
                    Manage Hosts
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('admin.tickets') }}" class="btn btn-primary btn-block">
                    Manage Tickets
                </a>
            </div>
            <div class="col-md-4 mb-3">
              <a href="{{ route('admin.transactions') }}" class="btn btn-primary btn-block">
                  Manage Transactions
              </a>
          </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
