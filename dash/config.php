<?php
// config.php
session_start();

$host = '185.185.80.116';
$dbname = 'dbtest';
$username = 'root';
$password = 'Ubuntu1250ubuntu';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion: " . $e->getMessage());
}

// Vérifier si l'utilisateur est connecté
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Rediriger si non connecté
function checkAuth() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}
?>