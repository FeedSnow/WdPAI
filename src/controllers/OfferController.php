<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Offer.php';
require_once __DIR__.'/../repository/OfferRepository.php';

class OfferController extends AppController
{
    const MAX_FILE_SIZE = 5*1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOADS_DIRECTORY = "../../public/uploads/";

    private $messages = [];
    private $offerRepository;

    public function __construct()
    {
        parent::__construct();
        $this->offerRepository = OfferRepository::getInstance();
    }

    public function create_offer()
    {
        if(!isset($_SESSION['user']))
            $this->redirect('login');

        if($this->isPost() && is_uploaded_file($_FILES['photo']['tmp_name']) && $this->validate($_FILES['photo'])) {
            // TODO

            move_uploaded_file($_FILES['photo']['tmp_name'],
            dirname(__DIR__).self::UPLOADS_DIRECTORY.$_FILES['photo']['name']);
            $address = null;
            if($_POST['voivodeship'] !== '')
                $address = new Address(
                    $_POST['voivodeship'],
                    $_POST['locality'],
                    $_POST['postcode'],
                    $_POST['street'],
                    $_POST['housenum'],
                    $_POST['flatnum']
                );
            
            $delivery = new Delivery(
                $_POST['cod-courier'] !== "" ? (int)($_POST['cod-courier']*100) : null,
                $_POST['cod-in-person'] !== "" ? (int)($_POST['cod-in-person']*100) : null,
                $_POST['adv-courier'] !== "" ? (int)($_POST['adv-courier']*100) : null,
                $_POST['adv-in-person'] !== "" ? (int)($_POST['adv-in-person']*100) : null,
                $_POST['adv-inpost'] !== "" ? (int)($_POST['adv-inpost']*100) : null
            );

            $offer = new Offer(
                $_SESSION['user']->getId(),
                $_SESSION['user']->getEmail(),
                $_POST['title'],
                $_POST['desc'],
                $_FILES['photo']['name'],
                (int)($_POST['price']*100),
                $_POST['quantity'],
                $delivery,
                $address
            );

            $this->offerRepository->addOffer($offer);

            //TODO Zrobić coś, żeby $messages[] nie były tracone
            return $this->redirect('offers');
            /*return $this->render('offers',
                ["messages" => $this->messages,
                    'offers' => $this->offerRepository->getOffers()
                ]);*/
            //return $this->offers();
        }

        $this->render("create-offer", ["messages" => $this->messages]);
    }

    public function offers() {
        if(!isset($_SESSION['user']))
            $this->redirect('login');

        // TODO display offers.php
        //$offers = $this->offerRepository->getOffers();
        //$this->render('offers', ['offers' => $offers]);
        $this->render('offers');
    }

    public function search_offers()
    {
        if(!isset($_SESSION['user']))
            $this->redirect('login');

        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';

        if($contentType !== "application/json")
            return;

        $content = trim(file_get_contents('php://input'));
        $decoded = json_decode($content, true);

        header('Content-Type: application/json');
        http_response_code(200);

        echo json_encode($this->offerRepository->getOfferByTitle($decoded['search']));
    }

    public function delete_offer()
    {
        if(!isset($_SESSION['user']))
            $this->redirect('login');

        $content = trim(file_get_contents('php://input'));
        $decoded = json_decode($content, true);

        http_response_code(200);

        echo json_encode($this->offerRepository->deleteOffer($decoded['id']));
    }

    private function validate(array $photo) : bool
    {
        if(!isset($_SESSION['user']))
            $this->redirect('login');

        if($photo['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'Przesłany plik jest zbyt duży.';
            return false;
        }

        if(!isset($photo['type']) || !in_array($photo['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'Niewłaściwy format pliku.';
            return false;
        }

        return true;
    }
}