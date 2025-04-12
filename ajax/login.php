<?php 
     $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
     $pass = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));


     $error = '';

     if(strlen($login) < 3)
     $error = 'Enter your login!';
     else if (strlen(string: $pass) < 3)
     $error = 'Enter your password!';

     if($error != '') {
        echo $error;
        exit();
     }


    require_once "../lib/mysql.php";
    
    $salt = '3456789>^788090';
    $pass = md5($salt.$pass); //хешування паролю


    $sql = 'SELECT id FROM users WHERE `login` = ? AND `password` = ?';     //вибірка з бази даних
    $query = $pdo->prepare($sql);
    $query->execute([$login, $pass]);

    if($query->rowCount() == 0)  
        echo "No such user found";         //перевірка, чи знайдено користувача в БД
    else
        setcookie('login', $login, time() + 3600 * 24 * 30, "/");  // установлюємо дані в cookie на 30 днів , на всьому сайті
        echo "Done";