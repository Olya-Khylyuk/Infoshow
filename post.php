<!DOCTYPE html>
<html lang="en">
<head>
<?php 
 require_once "lib/mysql.php";                                   //підєднання до БД
 $sql = 'SELECT * FROM articles WHERE `id` = ? ';                // вибір статей з БД але зашифрованих ? Б щоб закиститись від sql команд
 $query = $pdo->prepare($sql);                            //метод query, який дає підготовити sql код
 $query->execute([$_GET['id']]);                         // get дає дані з url в нашому випадку id, по якому будуть шукати з БД

 $article = $query->fetch(PDO::FETCH_OBJ);                 // получили запис і у вигляді обєкта помістили в змінну article


 $website_title = $article->title;
 require "blocks/head.php" 
?>
</head>
<body>
   <?php require "blocks/header.php" ?>
    <main>
        <?php 
       
             echo "<div class='post' >
             <h1>"  . $article->title . "</h1>
             <p>"  . $article->anons . "</p><br>
             <p>"  . $article->full_text . "</p>
             <p class='avtor'> Автор: <span>"  . $article->avtor . "</span></p><br>
             <p><b> Publication time: </b>" . date("H:i:s", $article->date) . "</p>
             </div>";
        
        ?>
        <h3>Comments</h3>
        <form>
        <label for="username">Your name: </label>
        <?php if(isset($_COOKIE['login'])): ?>
        <input type="text" name="username" id="username" value="<?=$_COOKIE['login']?>">
        <?php else:  ?>
            <input type="text" name="username" id="username" >
            <?php endif; ?>
        <label for="mess">Your messege </label>
        <textarea name="mess" id="mess"></textarea>

        <div class="error-mess" id="error-block"></div>
        <button type="button" id="mess_send">Add comment</button>
        </form>

        <div class="comments">

        <?php 
        $sql = 'SELECT * FROM comments WHERE `article_id` = ? ORDER BY id DESC';                // вибір статей з БД але зашифрованих ? Б щоб закиститись від sql команд
        $query = $pdo->prepare($sql);                                    //метод query, який дає підготовити sql код
        $query->execute([$_GET['id']]);  

        $comments = $query->fetchAll(PDO::FETCH_OBJ);
        foreach($comments as $el) {
             echo "<div class='comment'>
             <h2> " . $el->name . " </h2>
             <p> " . $el->mess . " </p>
             </div>";
        }
        ?>
        </div>
    </main>
    <?php require "blocks/aside.php" ?>
    <?php require "blocks/footer.php" ?>
 
    <script>
        $('#mess_send').click(function() {
            let name = $('#username').val();
            let mess = $('#mess').val();

            $.ajax({
                url: 'ajax/comment_add.php',
                type: 'POST',
                cache: false,
                data: {'username': name, 'mess': mess, 'id': '<?= $_GET['id']?>'},
                dataType: 'html',
                success: function(data) {
                   if(data === 'Done' ) {
                   $('.comments').prepend(`<div class='comment'> <h2>${name} </h2> <p> ${mess} </p></div>`);
                   $('#mess_send').text('All done! Congratulation!');
                   $('#error-block').hide();
                   $('#mess').val("");
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