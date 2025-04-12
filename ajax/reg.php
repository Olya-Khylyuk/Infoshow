<?php 
     $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
     $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
     $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
     $pass = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));


     $error = '';

     if(strlen($username) < 3)
     $error = 'Enter your name!';
     else if(strlen($email) < 3)
     $error = 'Enter your email!';
     else if(strlen($login) < 3)
     $error = 'Enter your login!';
     else if (strlen(string: $pass) < 3)
     $error = 'Enter your password!';

     if($error != '') {
        echo $error;
        exit();
     }

     require_once "../lib/mysql.php";
    
    $salt = '3456789>^788090';
    $pass = md5($salt.$pass); //хушування паролю

    $sql = 'INSERT INTO users(name, email, login, password) VALUES(?, ?, ?, ?)';  //не відразу підставляти дані, щоб не було інєкцій sql
    $query = $pdo->prepare($sql);
    $query->execute([$username, $email, $login, $pass]);

    echo "Done";