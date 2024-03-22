<?php

class UserController extends Controller
{
    public function auth()
    {
        $data = [
            'title' => 'Авторизація',
            'description' => 'Сторінка авторизації',
            'error' => ''
        ];

        // Check input data
        if (isset($_POST['login'])) {
            $user = $this->model('User');

            // Validate auth data
            $data['error'] = $user->authorizateUser($_POST['login'], $_POST['pass']);
        }

        $this->view('user/auth', $data);
    }

    public function dashboard()
    {
        // If user is not authorized -> redirect
        if (!isset($_COOKIE['login']) || $_COOKIE['login'] == '') {
            header('Location: /user/auth');
            exit();
        }
        
        $data = [
            'title' => 'Кабінет користувача',
            'description' => 'Сторінка авторизованого користувача'
        ];

        // User trying to exit
        if (isset($_POST['exit_btn'])) {
            $user = $this->model('User');

            // LogOut
            $user->logOut();
            exit();
        }

        $this->view('user/dashboard', $data);
    }
}