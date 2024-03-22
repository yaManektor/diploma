<?php

class HomeController extends Controller
{
    public function index($flag = null, $short_link = null)
    {
        $data = [
            'title' => 'Reduce.url',
            'description' => 'Головна сторінка сайту',
            'error' => ''
        ];

        $user = $this->model('User');

        // Get user id
        if (isset($_COOKIE['login']))
            $user_id = $user->getUser($_COOKIE['login'])->id;

        // --|Check user-reg form data|--
        if (isset($_POST['login'])) {
            // Validate input data
            $user->setUser($_POST['login'], $_POST['email'], $_POST['pass']);
            $data['error'] = $user->validateUser();

            // No errors -> logIn
            if ($data['error'] == 'success') {
                $user->addUser(); // Add user to DB
                $data['error'] = '';

                // Set cookie
                $user->logIn($_POST['login']);
            }
        }

        $link = $this->model('Link');

        // Redirect
        if ($flag == 's') {
            $redirect = $link->getLink($short_link);
            header('Location: ' . $redirect->full_link);
            exit();
        }

        // --|Check link form data|--
        if (isset($_POST['full_url'])) {
            // Validate input data
            $link->setLink($_POST['full_url'], $_POST['short_url']);
            $data['error'] = $link->validateLink();

            // No errors -> add link to DB
            if ($data['error'] == 'success') {
                $data['error'] = '';

                $link->addLink($user_id);
            }
        }

        // --|Check delete link button|--
        if (isset($_POST['delete_url'])) {
            $link->deleteLink($_POST['delete_url']);
        }

        // Get all links to display then on page
        if (isset($user_id))
            $data['links'] = $link->getLinks($user_id);

        $this->view('home/index', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Контакти',
            'description' => 'Сторінка для feedback',
            'error' => ''
        ];

        // --|Check contact form data|--
        if (isset($_POST['name'])) {
            $mail = $this->model('Contact');

            // Validate input data
            $mail->setData($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['mess']);
            $data['error'] = $mail->validateForm();

            // No errors -> send mail
            if ($data['error'] == 'success')
                $data['error'] = $mail->sendMail();
            
            if ($data['error'] == 'Повідомлення надіслано')
                unset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['mess']);
        }

        $this->view('home/contact', $data);
    }
}