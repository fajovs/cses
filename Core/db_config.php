<?php

$host = 'localhost';
$database = 'ccses_db';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$database;user=$user;charset=utf8mb4";

$pdo = new PDO($dsn);

