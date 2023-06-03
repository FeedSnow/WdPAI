<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index() {
        // TODO display login.php
        $this->render('login', ['message' => "Hello World!"]);
    }

    public function offers() {
        // TODO display offers.php
        $this->render('offers');
    }

    public function register() {
        $this->render('register');
    }
}