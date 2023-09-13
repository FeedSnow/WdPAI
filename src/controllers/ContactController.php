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
        if(!isset($_SESSION['user']))
            $this->redirect('login');

        // TODO display offers.php
        $contacts = $this->contactRepository->getContacts();
        $this->render('contacts', ['contacts' => $contacts]);
    }

    public function search_contacts()
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

        echo json_encode($this->contactRepository->getContactByName($decoded['search']));
    }
}