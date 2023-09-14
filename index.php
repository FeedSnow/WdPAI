<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('offers', 'OfferController');
Routing::get('contacts', 'ContactController');
Routing::get('logout', 'SecurityController');


Routing::post('register', 'SecurityController');
Routing::post('login', 'SecurityController');
Routing::post('create-offer', 'OfferController');
Routing::post('search-offers', 'OfferController');
Routing::post('search-contacts', 'ContactController');
Routing::post('delete-offer', 'OfferController');
Routing::post('add-contact', 'ContactController');

session_start();

Routing::run($path);