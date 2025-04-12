<?php
    $user = 'root';
    $password = 'root';
    $db = 'web-blog';
    $host = 'localhost';
    $port = 8889;


    $dsn = 'mysql:host=' . $host . ';dbname=' .$db . ';port=' .$port; // підключення до бази даних
    $pdo = new PDO($dsn, $user, $password);


    // ПІдключення до Бази Даних