<?php
// Configuration de la connexion
$host = '185.185.80.116';
$user = 'root';
$pass = 'Ubuntu1250ubuntu';
$dbname = 'dbtest'; // Laissez vide si vous voulez juste tester la connexion

// // Tentative de connexion avec MySQLi
// echo "=== Test de connexion MySQL ===\n\n";
// echo "Host: $host\n";
// echo "User: $user\n\n";

// // Méthode 1: MySQLi
// echo "--- Test avec MySQLi ---\n";
// $mysqli = @new mysqli($host, $user, $pass, $dbname);

// if ($mysqli->connect_errno) {
//     echo "❌ Échec de connexion MySQLi\n";
//     echo "Erreur ($mysqli->connect_errno): $mysqli->connect_error\n\n";
// } else {
//     echo "✅ Connexion MySQLi réussie!\n";
//     echo "Version du serveur: " . $mysqli->server_info . "\n";
//     echo "Version du protocole: " . $mysqli->protocol_version . "\n";
//     $mysqli->close();
//     echo "Connexion fermée.\n\n";
// }

// Méthode 2: PDO
echo "--- Test avec PDO ---\n";
echo $host;
echo $user;
echo $dbname;


try {
    $dsn = "mysql:host=$host";
    if (!empty($dbname)) {
        $dsn .= ";dbname=$dbname";
    }
    
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Connexion PDO réussie!\n";
    $version = $pdo->query('SELECT VERSION()')->fetchColumn();
    echo "Version MySQL: $version\n";
    
    $pdo = null;
    echo "Connexion fermée.\n";
    
} catch (PDOException $e) {
    echo "❌ Échec de connexion PDO\n";
    echo "Erreur: " . $e->getMessage() . "\n";
}

echo "\n=== Fin du test ===\n";
?>
