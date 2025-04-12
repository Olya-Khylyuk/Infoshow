<!-- <header>
        <a href="/" class="logo"><img src="/img/LOGO.png" alt="create" style="width: 140px;"></a>
        <nav>
            <a href="/">Main Page</a>
            <a href="/contacts.php">Contacts</a>
            <?php  if (isset($_COOKIE['login'])) : ?>
                <a href="/add-article.php" >Add news</a>
                <a href="/login.php" class="btn-nav">User account</a>

                <?php else : ?>
             <a href="/login.php" class="btn-nav">Sign in</a>
             <a href="/register.php" class="btn-nav">Sign up</a>
            <?php endif; ?>
        </nav>
    </header> -->

    <header>
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a href="/" class="navbar-brand">
                <img src="/img/LOGO.png" alt="infoshow" style="width: 140px;">
            </a>
            <!-- Кнопка для мобільних пристроїв -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Меню -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">  <!-- Вирівнювання праворуч -->
                    <li class="nav-item">
                        <a class="nav-link" href="/">Main Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contacts.php">Contacts</a>
                    </li>
                    
                    <?php if (isset($_COOKIE['login'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/add-article.php">Add news</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link btn-nav text-white" href="/login.php">User account</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-primary" href="/login.php">Sign in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white" href="/register.php">Sign up</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>