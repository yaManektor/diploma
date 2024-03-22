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
            <h2>Авторизація</h2>
            <p>Тут ви можете авторизуватися на сайті</p>
            <div class="reg-form">
                <form action="" method="POST" class="form">
                    <input type="text" name="login" placeholder="Введіть логін" value="<?=$_POST['login'] ?? ''?>">
                    <input type="password" name="pass" placeholder="Введіть пароль">
                    <div class="error"><?=$data['error']?></div>
                    <button type="submit" class="btn">Авторизуватися</button>
                </form>
            </div>
        </div>
    </div>

    <?php require_once('public/blocks/footer.php') ?>
</body>

</html>