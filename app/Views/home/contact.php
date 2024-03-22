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
        <h2>Зворотній зв'язок</h2>
        <p>Напишіть нам, якщо у вас виникли запитання</p>
        <div class="reg-form">
            <form action="" method="POST" class="form">
                <input type="text" name="name" placeholder="Введіть ім'я" value="<?=$_POST['name'] ?? ''?>">
                <input type="email" name="email" placeholder="Введіть email" value="<?=$_POST['email'] ?? ''?>">
                <input type="text" name="subject" placeholder="Введіть тему повідомлення" value="<?=$_POST['subject'] ?? ''?>">
                <textarea name="mess" placeholder="Введіть повідомлення"><?=$_POST['mess'] ?? ''?></textarea>
                <div class="error"><?=$data['error']?></div>
                <button type="submit" class="btn">Відправити</button>
            </form>
        </div>
    </div>
</div>

<?php require_once('public/blocks/footer.php') ?>
</body>

</html>