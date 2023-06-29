<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Offer.php';

class OfferController extends AppController
{
    const MAX_FILE_SIZE = 5*1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOADS_DIRECTORY = "../../public/uploads/";

    private $messages = [];

    public function create_offer()
    {
        if($this->isPost() && is_uploaded_file($_FILES['photo']['tmp_name']) && $this->validate($_FILES['photo'])) {
            // TODO

            move_uploaded_file($_FILES['photo']['tmp_name'],
            dirname(__DIR__).self::UPLOADS_DIRECTORY.$_FILES['photo']['name']);

            $offer = new Offer($_POST['title'], $_POST['desc'], $_FILES['photo']['name'], $_POST['price'], $_POST['quantity']);

            return $this->render('offers', ["messages" => $this->messages, 'offer' => $offer]);
        }

        $this->render("create-offer", ["messages" => $this->messages]);
    }

    private function validate(array $photo) : bool
    {
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