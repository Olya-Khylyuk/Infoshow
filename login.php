<!DOCTYPE html>
<html lang="en">
<head>
<?php 
$website_title = "Sign in";
require "blocks/head.php" ?>
</head>
<body>
   <?php require "blocks/header.php" ?>
    <main>
       <?php if(!isset($_COOKIE['login'])):     // перевірка чи є вже користувач в cookie авторизований
       ?>
        <h1> Sign in </h1>
        <form>
        <label for="login">Enter login </label>
        <input type="text" name="login" id="login" placeholder="">
        <label for="password">Enter password </label>
        <input type="password" name="password" id="password" placeholder="">

        <div class="error-mess" id="error-block"></div>
        <button type="button" id="login_user">Enter</button>
        </form>

        <?php   else: ?>
        <h2><?=$_COOKIE['login']?></h2>
        <form action="">
            <button type="button" id="exit_user">Exit</button>
        </form>
        <?php endif; ?>
    </main>
    <?php require "blocks/aside.php" ?>
    <?php require "blocks/footer.php" ?>
    <script>
        $('#login_user').click(function() {
            let login = $('#login').val();
            let pass = $('#password').val();

            $.ajax({
                url: 'ajax/login.php',
                type: 'POST',
                cache: false,
                data: {'login': login, 'password': pass},
                dataType: 'html',
                success: function(data) {
                   if(data === 'Done' ) {
                   $('#login_user').text('All done! Congratulation!');
                   $('#error-block').hide();
                   document.location.reload(true);   // при успішному вході сторінка перезагрузиться 
                   }
                   else {
                     $('#error-block').show();
                     $('#error-block').text(data);
                }
                }
            });
        }); 
        $('#exit_user').click(function() {

            $.ajax({
                url: 'ajax/exit.php',
                type: 'POST',
                cache: false,
                data: {},
                dataType: 'html',
                success: function(data) {
                   document.location.reload(true);   // при успішному виході сторінка перезагрузиться 
                   }
            });
        }); 
    </script>
 

</body>
</html>