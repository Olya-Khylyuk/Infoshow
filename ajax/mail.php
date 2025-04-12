<?php 
     $username = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
     $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
     $mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_SPECIAL_CHARS));


     $error = '';

     if(strlen($username) < 3)
     $error = 'Enter your name!';
     else if(strlen($email) < 3)
     $error = 'Enter your email!';
     else if(strlen($mess) < 10)
     $error = 'Enter your message!';


     if($error != '') {
        echo $error;
        exit();
     }

     $to = "olyahylyuk@gmail.com";                                                                // 4 параметра, які треба ввести при функції mail(), щоб відправити повідомлення
     $subject = "=?utf-8?B?" .base64_encode( "New message")."?=";                         // тема повідомлення, записання, щоб не було кодування 
     $message = "User: $username.<br>$mess";                                                      // повідомлення
     $headers = "Fron: $email\r\nReply-to: $email\r\nContent-type: text/html; charset=utf-8\r\n"; // заголовки і характеристики повідомлення

     mail($to, $subject, $message, $headers);


    echo "Done";

    // з локального сервера повідомлення не будуть відправлятися, необхідно сайт вигрузити в мережу(на сервер)