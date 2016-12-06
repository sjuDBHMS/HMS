<?php
    $dsn = 'mysql:host=localhost;dbname=malamodi_csc621new';
    $username = 'malamodi';
    $password = 'am147258';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>