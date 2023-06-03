<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index() {
        // TODO display login.html
        $this->render('login');
    }

    public function offers() {
        // TODO display offers.html
        $this->render('offers');
    }

    public function register() {
        $this->render('register');
    }
}