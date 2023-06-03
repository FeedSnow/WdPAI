<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController
{
    public function login()
    {
        $user = new User('jsnow@pk.edu.pl', 'admin', 'John', 'Snow');

        if(!$this->isPost())
        {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $dont_logout = $_POST['dont-logout'] ?? null;

        if($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['Email not found!']]);
        }

        if($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        //return $this->render('offers');

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/offers");
    }
}