<?php
$envFile = file_get_contents('.env');
$envVars = parse_ini_string($envFile);

$hostname = $envVars['DB_HOST'];
$username = $envVars['DB_USER'];
$password = $envVars['DB_PASS'];
$database = $envVars['DB_NAME'];
$connection = mysqli_connect($hostname, $username, $password, $database);
if (!$connection) {
    echo "Error connecting to database: " . mysqli_connect_error();
    exit;
}
?>