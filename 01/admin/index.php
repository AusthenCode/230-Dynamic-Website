<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - NaturaTech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-card {
            transition: transform 0.2s ease-in-out;
        }
        .dashboard-card:hover {
            transform: scale(1.03);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-5 fw-bold">🌿 NaturaTech Admin Dashboard</h1>
        <p class="text-center text-muted mb-5">
            Manage your company's data — products, team, awards, and more.
        </p>

        <div class="row justify-content-center g-4">
            <!-- Products -->
            <div class="col-md-4">
                <div class="card dashboard-card text-center shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Products</h4>
                        <p class="text-muted">Manage NaturaTech’s products and services.</p>
                        <a href="products/index.php" class="btn btn-success w-100">Go to Products</a>
                    </div>
                </div>
            </div>

            <!-- Team -->
            <div class="col-md-4">
                <div class="card dashboard-card text-center shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Team</h4>
                        <p class="text-muted">Edit team member info and roles.</p>
                        <a href="team/index.php" class="btn btn-primary w-100">Go to Team</a>
                    </div>
                </div>
            </div>

            <!-- Pages -->
            <div class="col-md-4">
                <div class="card dashboard-card text-center shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Pages</h4>
                        <p class="text-muted">Manage content pages and overview text.</p>
                        <a href="pages/index.php" class="btn btn-warning w-100">Go to Pages</a>
                    </div>
                </div>
            </div>

            <!-- Awards -->
            <div class="col-md-4">
                <div class="card dashboard-card text-center shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Awards</h4>
                        <p class="text-muted">Add or update company awards.</p>
                        <a href="awards/index.php" class="btn btn-info w-100">Go to Awards</a>
                    </div>
                </div>
            </div>

            <!-- Contacts -->
            <div class="col-md-4">
                <div class="card dashboard-card text-center shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Contacts</h4>
                        <p class="text-muted">View contact form submissions.</p>
                        <a href="contacts/index.php" class="btn btn-danger w-100">Go to Contacts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
