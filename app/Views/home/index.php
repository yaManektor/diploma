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
            <h1>Reduce.url</h1>
            <p>Вам потрібно скоротити посилання?
                <?php if (isset($_COOKIE['login']))
                    echo 'Зараз ми це зробимо';
                else
                    echo 'Спочатку слід зареєструватися на сайті'
                ?>
            </p>

            <?php if (!isset($_COOKIE['login']) || $_COOKIE['login'] == ''): ?>
                <div class="reg-form">
                    <form action="" method="POST" class="form">
                        <input type="text" name="login" placeholder="Введіть логін" value="<?=$_POST['login'] ?? ''?>">
                        <input type="email" name="email" placeholder="Введіть email" value="<?=$_POST['email'] ?? ''?>">
                        <input type="password" name="pass" placeholder="Введіть пароль">
                        <div class="error"><?=$data['error']?></div>
                        <button type="submit" class="btn">Зареєструватися</button>
                    </form>
                </div>
                <p>Вже створили аккаунт? Спробуйте <a href="/user/auth">авторизуватися</a></p>

            <?php else: ?>
                <div class="reg-form">
                    <form action="" method="POST" class="form">
                        <input type="text" name="full_url" placeholder="Повне посилання" value="<?=$_POST['full_url'] ?? ''?>">
                        <input type="text" name="short_url" placeholder="Коротка назва" value="<?=$_POST['short_url'] ?? ''?>">
                        <div class="error"><?=$data['error']?></div>
                        <button type="submit" class="btn">Зменшити</button>
                    </form>
                </div>
            <?php endif; ?>

            <?php if (isset($data['links']) && $data['links'] && isset($_COOKIE['login'])): ?>
                <div class="urls">
                    <h1>Скорочені посилання</h1>

                    <?php foreach ($data['links'] as $link): ?>
                        <div class="url">
                            <p><b>Повне: </b><?=$link->full_link?></p>
                            <p><b>Коротке: </b><a href="/s/<?=$link->short_link?>">dyplom/s/<?=$link->short_link?></a></p>
                            <form action="" method="POST" class="form">
                                <input type="hidden" name="delete_url" value="<?=$link->id?>">
                                <button type="submit" class="btn">
                                    Видалити
                                    <i class="fa-solid fa-trash-arrow-up"></i>
                                </button>
                            </form>
                        </div>
                    <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php require_once('public/blocks/footer.php') ?>
</body>

</html>