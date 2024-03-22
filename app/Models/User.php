<?php

require_once 'app/Core/DB.php';

class User
{
    private $login;
    private $email;
    private $password;

    private $_db = null;

    // Get DB object
    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    // Set user`s login, email, password
    public function setUser($login, $email, $password)
    {
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
    }

    // Add user to DB
    public function addUser()
    {
        // Prepare sql query
        $sql = 'INSERT INTO `users` (`login`, `email`, `pass`) VALUES (:login, :email, :pass)';
        $query = $this->_db->prepare($sql);

        // Hash password
        $pass = password_hash($this->password, PASSWORD_DEFAULT);

        // Execute query
        $query->execute(['login' => $this->login, 'email' => $this->email, 'pass' => $pass]);
    }

    // Get user data from DB
    public function getUser($login)
    {
        // Prepare sql query
        $sql = 'SELECT * FROM `users` WHERE `login` = :login';
        $query = $this->_db->prepare($sql);

        // Execute query
        $query->execute(['login' => $login]);

        // Check for same login
        if ($query->rowCount() == 0)
            return false;
        else
            return $query->fetch(PDO::FETCH_OBJ);
    }

    // Validate reg form
    public function validateUser()
    {
        if (strlen($this->login) < 3)
            return 'Логін занадто короткий';
        elseif ($this->getUser($this->login))
            return 'Такий користувач уже зареєстрований';
        elseif (strlen($this->email) < 5 || !strpos($this->email, '.'))
            return 'Введіть коректний email';
        elseif (strlen($this->password) < 5)
            return 'Пароль повинен бути не менше 5 символів';
        else
            return 'success';
    }

    // Validate auth form
    public function authorizateUser($login, $password)
    {
        // Prepare sql query
        $sql = 'SELECT `pass` FROM `users` WHERE `login` = :login';
        $query = $this->_db->prepare($sql);

        // Execute query
        $query->execute(['login' => $login]);

        if ($query->rowCount() == 0) // Zero matches
            return 'Такого користувача не існує';
        else {
            $user = $query->fetch(PDO::FETCH_OBJ);

            // Verify password
            if (!password_verify($password, $user->pass))
                return 'Паролі не співпадають';
            else
                $this->logIn($login);
        }
    }

    // Set cookie as user`s login
    public function logIn($login)
    {
        setcookie('login', $login, strtotime('+10 minutes', time()), '/');
        header('Location: /user/dashboard'); // Redirect to home page
    }

    // Delete user`s login cookie
    public function logOut()
    {
        setcookie('login', $this->login, strtotime('-10 minutes', time()), '/');
        unset($_COOKIE['login']);
        header('Location: /user/auth'); // Redirect to home page
    }
}