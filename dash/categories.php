<?php
// categories.php
require_once 'config.php';
checkAuth();

$message = '';

// Ajouter une catégorie
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    $sql = "INSERT INTO categories (name, description) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$name, $description])) {
        $message = '<div class="alert alert-success">Catégorie ajoutée avec succès!</div>';
    }
}

// Supprimer une catégorie
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Vérifier si la catégorie est utilisée
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM products WHERE category_id = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch();
    
    if ($result['count'] == 0) {
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
        if ($stmt->execute([$id])) {
            $message = '<div class="alert alert-success">Catégorie supprimée avec succès!</div>';
        }
    } else {
        $message = '<div class="alert alert-danger">Impossible de supprimer: cette catégorie contient des produits!</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Catégories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container mt-4">
        <h2>Gestion des Catégories</h2>
        
        <?php echo $message; ?>
        
        <div class="row">
            <!-- Formulaire d'ajout -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Ajouter une catégorie</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label>Nom de la catégorie</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" name="add_category" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Liste des catégories -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Liste des catégories</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $pdo->query("SELECT * FROM categories ORDER BY name");
                                while ($category = $stmt->fetch()) {
                                ?>
                                <tr>
                                    <td><?php echo $category['id']; ?></td>
                                    <td><?php echo htmlspecialchars($category['name']); ?></td>
                                    <td><?php echo htmlspecialchars($category['description']); ?></td>
                                    <td>
                                        <a href="edit_category.php?id=<?php echo $category['id']; ?>" 
                                           class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="?delete=<?php echo $category['id']; ?>" 
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>