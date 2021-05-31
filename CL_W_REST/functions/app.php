<?php
ini_set('display_errors', 1);
if (session_status() === PHP_SESSION_NONE) {
    // Initialiser la session
    session_start();
}
ini_set('date.timezone', 'Africa/Douala');

function getDatabase()
{
    $host = 'localhost';
    $dbname = 'examen';
    $username = 'root';
    $password = '';

    try {
        $pdo = new \PDO('mysql:host='. $host .';dbname='.$dbname, $username, $password);
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;

    } catch (\PDOException $e) {
        echo 'Erreur provenant de la base de donnees. Error: ' . $e->getMessage();
        die();
    }
}

function redirectNotFound() {
    header('HTTP/1.1 404 Not Found');
    include('404.php');
    exit();
}
