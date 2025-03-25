<?php
function connectToDatabase() {
    $config_path = '/var/www/private/db-config.ini';

    if (!file_exists($config_path) || !is_readable($config_path)) {
        die("Database config file missing or unreadable.");
    }

    $config = parse_ini_file($config_path);

    $conn = new mysqli(
        $config['servername'],
        $config['username'],
        $config['password'],
        $config['dbname']
    );

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!$conn->set_charset("utf8")) {
        die("Error loading character set utf8: " . $conn->error);
    }

    return $conn;
}
?>
