<!doctype html>
<html lang="en">

<head>
    <?php require_once 'public/blocks/head.php' ?>
    <link rel="stylesheet" href="/public/css/form.css">
</head>

<body>
    <?php require_once('public/blocks/header.php') ?>

    <div class="container">
        <div class="main">
            <div class="user">
                <h1>Кабінет користувача</h1>
                <p>Привіт, <b><?=$_COOKIE['login']?></b></p>
                <form action="" method="POST" class="form">
                    <input type="hidden" name="exit_btn">
                    <button type="submit" class="btn">Вийти</button>
                </form>
            </div>
        </div>
    </div>

    <?php require_once('public/blocks/footer.php') ?>
</body>

</html>