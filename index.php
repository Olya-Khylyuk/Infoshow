<!DOCTYPE html>
<html lang="en">
<head>
<?php 
$website_title = "INFOSHOW";
require "blocks/head.php" 
?>
</head>
<body>
   <?php require "blocks/header.php" ?>
   <?php require_once "blocks/main-page.php"; ?>
    <main>
        <?php 
        require_once "lib/mysql.php";                                      //підєднання до БД

        $sql = 'SELECT * FROM articles ORDER BY `date` DESC';              // вибір статей з БД
        $query = $pdo->query($sql);                                        //метод query, який дає виконати sql код
        while ($row = $query->fetch(PDO::FETCH_OBJ)) { 
            echo "<div class='one-post'>
                    <div class='post'>
                        <h1>" . htmlspecialchars($row->title) . "</h1>
                        <p>" . htmlspecialchars($row->anons) . "</p>
                        <p class='avtor'>Автор: <span>" . htmlspecialchars($row->avtor) . "</span></p>
                        <a href='/post.php?id=" . $row->id . "' title='" . htmlspecialchars($row->title) . "'>Read more <i class='fa-solid fa-chevron-right'></i></a>
                    </div>";
        
            // Додаємо зображення, якщо воно є
            if ($row->image) {
                echo "<img class='post-img' src='" . $row->image . "' alt='Image'>";
            }
        
            echo "</div>";
        }
        ?>
    </main>
    <?php require "blocks/aside.php" ?>
    
    <?php require_once "blocks/video.php" ?>
    <?php require_once "blocks/carusel.php" ?>
    <?php require "blocks/footer.php" ?>


</body>
</html>