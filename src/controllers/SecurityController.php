<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../../config.php';

class SecurityController extends AppController
{
    private $messages = [];
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = UserRepository::getInstance();
    }

    public function login()
    {
        //$user = new User('jsnow@pk.edu.pl', 'admin', 'John', 'Snow');

        if(!$this->isPost())
        {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $dont_logout = $_POST['dont-logout'] ?? null;

        $user = $this->userRepository->getUser($email, $password);

        if(!$user) {
            return $this->render('login', ['messages' => ['Niewłaściwy adres e-mail lub hasło!']]);
        }

        /*if($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['Email not found!']]);
        }

        if(!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }*/
        $_SESSION['user'] = $user;

        //return $this->render('offers');

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/offers");
    }

    public function logout()
    {
        unset($_SESSION['user']);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }

    public function register()
    {
        if(!$this->isPost())
            return $this->render('register');


        $email = $_POST['email'];
        if($this->userRepository->userExists($email)) {
            $this->messages[] = 'Konto o tym adresie e-mail już istnieje.';
            return $this->render('register', ['messages' => $this->messages]);
        }

        $password = $_POST['password'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];

        if(!$this->userRepository->createUser($email, $password, $name, $surname)) {
            $this->messages[] = 'Nie udało się zarejestrować użytkownika. Spróbuj ponownie.';
            return $this->render('register', ['messages' => $this->messages]);
        }

        $this->messages[] = 'Zarejestrowano pomyślnie.';
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }
}