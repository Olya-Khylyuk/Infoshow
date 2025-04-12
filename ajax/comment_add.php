<?php 
     $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
     $mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_SPECIAL_CHARS));
     $id = trim(filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS));



     $error = '';

     if(strlen($username) < 3)
     $error = 'Enter your name!';
     else if(strlen($mess) < 5)
     $error = 'Enter your comment!';

     if($error != '') {
        echo $error;
        exit();
     }

     require_once "../lib/mysql.php";


    $sql = 'INSERT INTO comments(name, mess, article_id) VALUES(?, ?, ?)';  //не відразу підставляти дані, щоб не було інєкцій sql (назви таблиць з БД )
    $query = $pdo->prepare($sql);
    $query->execute([$username, $mess, $id]);

    echo "Done";