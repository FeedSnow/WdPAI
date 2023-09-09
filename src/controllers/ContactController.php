<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Contact.php';
require_once __DIR__.'/../repository/ContactRepository.php';

class ContactController extends AppController
{
    const MAX_FILE_SIZE = 5*1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOADS_DIRECTORY = "../../public/uploads/";

    private $messages = [];
    private $contactRepository;

    public function __construct()
    {
        parent::__construct();
        $this->contactRepository = ContactRepository::getInstance();
    }

    public function contacts() {
        // TODO display offers.php
        $contacts = $this->contactRepository->getContacts();
        $this->render('contacts', ['contacts' => $contacts]);
    }

    public function search_contacts()
    {
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';

        if($contentType !== "application/json")
            return;

        $content = trim(file_get_contents('php://input'));
        $decoded = json_decode($content, true);

        header('Content-Type: application/json');
        http_response_code(200);

        echo json_encode($this->contactRepository->getContactByName($decoded['search']));
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