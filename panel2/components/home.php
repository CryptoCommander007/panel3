<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

    <!-- Sidebar -->
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 sidebar">
                <div class="text-center mb-4">
                    <img src="https://via.placeholder.com/80" class="rounded-circle" alt="User">
                    <h4>User Name</h4>
                </div>
                <a href="#">Home</a>
                <a href="#">Options 1</a>
                <a href="#">Options 2</a>
                <a href="#">Options 3</a>
                <a href="#">Options 4</a>
                <a href="#">Options 5</a>
            </nav>

            <!-- Main Content -->
            <div class="col-md-10 content">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">Search</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Cart</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Notifications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Profile</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Overview Section -->
                <div class="overview-section my-4">
                    <h2>System Overview</h2>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card p-3">
                                <h5>Pending Orders</h5>
                                <p>25</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-3">
                                <h5>Opened Tickets</h5>
                                <p>13</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-3">
                                <h5>Revenue</h5>
                                <p>$234.23</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-3">
                                <h5>Total Profit</h5>
                                <p>$8,224.00</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Graph and Cards Section -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card p-4">
                            <h5>System Overview</h5>
                            <canvas id="myChart"></canvas> <!-- Placeholder for chart -->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-3 mb-3">
                            <h5>Balance</h5>
                            <p>$234.23</p>
                        </div>
                        <div class="card p-3">
                            <h5>Billing</h5>
                            <p>$1,546.95</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Placeholder for the chart
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May'],
                datasets: [{
                    label: 'Performance',
                    data: [12, 19, 3, 5, 2],
                    borderColor: '#6f42c1',
                    backgroundColor: 'rgba(111, 66, 193, 0.2)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>

</body>
</html>
