<!DOCTYPE html>
<html lang="en">
<head>
<?php 
$website_title = "Sign up";
require "blocks/head.php" ?>
</head>
<body>
   <?php require "blocks/header.php" ?>
    <main>
        <h1> Sign Up </h1>
        <form>
        <label for="username">Your name: </label>
        <input type="text" name="username" id="username" placeholder="">
        <label for="email">Your email </label>
        <input type="email" name="email" id="email" placeholder="">
        <label for="login">Enter login </label>
        <input type="text" name="login" id="login" placeholder="">
        <label for="password">Enter password </label>
        <input type="password" name="password" id="password" placeholder="">

        <div class="error-mess" id="error-block"></div>
        <button type="button" id="reg_user">Sign up</button>
        </form>
    </main>
    <?php require "blocks/aside.php" ?>
    <?php require "blocks/footer.php" ?>
    <script>
        $('#reg_user').click(function() {
            let name = $('#username').val();
            let login = $('#login').val();
            let email = $('#email').val();
            let pass = $('#password').val();

            $.ajax({
                url: 'ajax/reg.php',
                type: 'POST',
                cache: false,
                data: {'username': name, 'login': login, 'email': email, 'password': pass},
                dataType: 'html',
                success: function(data) {
                   if(data === 'Done' ) {
                   $('#reg_user').text('All done! Congratulation!');
                   $('#error-block').hide();
                   }
                   else {
                     $('#error-block').show();
                     $('#error-block').text(data);
                }
                }
            });
        }); 
    </script>
 

</body>
</html>