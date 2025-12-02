<?php
// dashboard.php
require_once 'config.php';
checkAuth();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestion des Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            padding: 20px;
        }
        .product-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-dark sidebar">
                <h4 class="text-white p-3">Dashboard</h4>
                <ul class="nav flex-column">
                    <li><a href="dashboard.php" class="active"><i class="bi bi-speedometer2"></i> Tableau de bord</a></li>
                    <li><a href="products.php"><i class="bi bi-box"></i> Produits</a></li>
                    <li><a href="categories.php"><i class="bi bi-tags"></i> Catégories</a></li>
                    <li><a href="logout.php"><i class="bi bi-box-arrow-right"></i> Déconnexion</a></li>
                </ul>
            </div>

            <!-- Contenu principal -->
            <div class="col-md-10 content">
                <h2>Tableau de Bord</h2>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Produits</h5>
                                <?php
                                $stmt = $pdo->query("SELECT COUNT(*) as total FROM products");
                                $result = $stmt->fetch();
                                echo "<h2>" . $result['total'] . "</h2>";
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Catégories</h5>
                                <?php
                                $stmt = $pdo->query("SELECT COUNT(*) as total FROM categories");
                                $result = $stmt->fetch();
                                echo "<h2>" . $result['total'] . "</h2>";
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Stock Total</h5>
                                <?php
                                $stmt = $pdo->query("SELECT SUM(stock) as total FROM products");
                                $result = $stmt->fetch();
                                echo "<h2>" . ($result['total'] ?? 0) . "</h2>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>