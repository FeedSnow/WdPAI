<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    public function index() {
        // TODO display login.php
        $this->render('login', ['message' => "Hello World!"]);
    }

    public function create_offer() {
        $this->render('create-offer');
    }

    public function contacts() {
        $this->render('contacts');
    }

    public function register() {
        $this->render('register');
    }
}