<?php 
if(!isset($_COOKIE['login'])) {
    header('Location: /register.php');    // якщо корислувач не авторизований іде переадресація
    exit();   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php 
$website_title = "Add news";
require "blocks/head.php" ?>
</head>
<body>
   <?php require "blocks/header.php" ?>
    <main>
        <h1> Add news </h1>
        <form id="news-form" enctype="multipart/form-data">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="">
        <label for="anons">Announcement </label>
        <textarea name="anons" id="anons"></textarea>
        <label for="full_text">Main text</label>
        <textarea name="full_text" id="full_text"></textarea>
        <label for="add_img">Add image</label>
        <input type="file" name="add_img" id="add_img">


        <div class="error-mess" id="error-block"></div>
        <button type="button" id="add_article">Add</button>
        </form>
    </main>
    <?php require "blocks/aside.php" ?>
    <?php require "blocks/footer.php" ?>
    <script>
        $('#add_article').click(function() {
    let formData = new FormData($('#news-form')[0]);

    $.ajax({
        url: 'ajax/add-article.php',
        type: 'POST',
        cache: false,
        processData: false,  // Не обробляти дані (бо передаємо FormData)
        contentType: false,  // Не встановлювати contentType, бо це робить браузер для FormData
        data: formData,
        dataType: 'html',
        success: function(data) {
            if (data === 'Done') {
                $('#add_article').text('All done! Congratulations!');
                $('#error-block').hide();
                $('#title').val("");
                $('#anons').val("");
                $('#full_text').val("");
                $('#news-form')[0].reset(); // Скидає форму після успішної відправки
            } else {
                $('#error-block').show();
                $('#error-block').text(data);  // Виводимо помилку
            }
        }
    });
});
    </script>
 

</body>
</html>