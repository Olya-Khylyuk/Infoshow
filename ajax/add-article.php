<?php 
$title = trim(filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS));
$anons = trim(filter_var($_POST['anons'], FILTER_SANITIZE_SPECIAL_CHARS));
$full_text = trim(filter_var($_POST['full_text'], FILTER_SANITIZE_SPECIAL_CHARS));
$imagePath = '';

$error = '';

if (strlen($title) < 5) {
    $error = 'Enter correct title';
} else if (strlen($anons) < 5) {
    $error = 'Enter correct anons';
} else if (strlen($full_text) < 10) {
    $error = 'Enter main text';
}

if ($error != '') {
    echo $error;
    exit();
}

// Перевіряємо, чи завантажене зображення
if (!empty($_FILES['add_img']['name'])) {
    $uploadDir = '../uploads/'; // Папка для збереження
    $imageName = time() . '_' . basename($_FILES['add_img']['name']);
    $targetFilePath = $uploadDir . $imageName;

    // Перевірка на тип файлу
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $fileType = mime_content_type($_FILES['add_img']['tmp_name']);
    $fileExt = strtolower(pathinfo($_FILES['add_img']['name'], PATHINFO_EXTENSION));

    if (!in_array($fileType, $allowedTypes) || !in_array($fileExt, ['jpeg', 'png', 'gif', 'webp'])) {
        echo "Invalid file type. Only JPG, PNG, GIF, and WEBP are allowed.";
        exit();
    }

    // Створюємо папку, якщо її немає
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);  // Створює папку, якщо її немає
    }

    // Переміщуємо файл
    if (move_uploaded_file($_FILES['add_img']['tmp_name'], $targetFilePath)) {
        $imagePath = 'uploads/' . $imageName; // Відносний шлях для БД
    } else {
        echo "Error uploading file.";
        exit();
    }
}

require_once "../lib/mysql.php";

$sql = 'INSERT INTO articles(title, anons, full_text, image, date, avtor) VALUES(?, ?, ?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$title, $anons, $full_text, $imagePath, time(), $_COOKIE['login']]); // Данні, які підуть в таблицю

echo "Done";
?>