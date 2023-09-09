<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Offer.php';

class OfferRepository extends Repository
{
    public function getOffer(int $id): ?Offer
    {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM offers WHERE offer_id=:id
        ');

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $offer = $stmt->fetch(PDO::FETCH_ASSOC);

        if($offer == false)
            return null;

        return new Offer
        (
            $offer['offer_title'],
            $offer['offer_description'],
            $offer['offer_image'],
            $offer['offer_price'],
            $offer['offer_quantity']
        );
    }

    public function addOffer(Offer $offer): void
    {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO offers (offer_title,
                                offer_description,
                                offer_image,
                                offer_price,
                                offer_quantity,
                                offer_author_id,
                                offer_created_at,
                                offer_active)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ');

        $authorId = 1;
        $stmt->execute([
            $offer->getTitle(),
            $offer->getDescription(),
            $offer->getImage(),
            $offer->getPrice(),
            $offer->getQuantity(),
            $authorId,
            $date->format('Y-m-d'),
            true
        ]);
    }

    public function getOffers(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM offers;
        ');
        $stmt->execute();
        $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($offers as $offer)
        {
            $result[] = new Offer(
                $offer['offer_title'],
                $offer['offer_description'],
                $offer['offer_image'],
                $offer['offer_price'],
                $offer['offer_quantity']
            );
        }

        return $result;
    }

    public function getOfferByTitle(string $searchString)
    {
        $searchString = '%'.strtolower($searchString).'%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM offers WHERE LOWER(offer_title) LIKE :search OR LOWER(offer_description) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function voivodeshipToCode(string $voivodeship) : string
    {
        switch ($voivodeship)
        {
            case "Dolnośląskie":
                return 'DS';
            case "Kujawsko-Pomorskie":
                return 'KP';
            case "Lubelskie":
                return 'LU';
            case "Lubuskie":
                return 'LB';
            case "Łódzkie":
                return 'LD';
            case "Małopolskie":
                return 'MA';
            case "Mazowieckie":
                return 'MZ';
            case "Opolskie":
                return 'OP';
            case "Podkarpackie":
                return 'PK';
            case "Podlaskie":
                return 'PD';
            case "Pomorskie":
                return 'PM';
            case "Śląskie":
                return 'SL';
            case"Świętokrzyskie":
                return 'SK';
            case "Warmińsko-Mazurskie":
                return 'WM';
            case "Wielkopolskie":
                return 'WP';
            case"Zachodniopomorskie":
                return 'ZM';
        }
        die('Wrong voivodeship.');
    }
}