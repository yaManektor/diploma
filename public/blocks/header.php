<header>
    <div class="container">
        <div class="logo">
            <img src="/public/img/robot_url_icon.png" alt="Logo">
            <span>Зробимо все швидко та якісно!</span>
        </div>

        <div class="nav">
            <a href="/">Головна</a>
            <a href="/home/contact">Контакти</a>

            <?php if (!isset($_COOKIE['login']) || $_COOKIE['login'] == ''): ?>
                <a href="/user/auth">Ввійти</a>
            <?php else: ?>
                <a href="/user/dashboard">Кабінет користувача</a>
            <?php endif; ?>
        </div>
    </div>
</header>
