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
            $offer['offer_author_id'],
            $offer['offer_title'],
            $offer['offer_description'],
            $offer['offer_image'],
            $offer['offer_price'],
            $offer['offer_quantity']
        );
    }

    public function addOffer(Offer $offer): void
    {
        $address_stmt = ' ';

        if($offer->getAddress() !== null) {
            $flatnum_stmt = '';
            if($offer->getAddress()->getFlatnum() !== null)
                $flatnum_stmt = 'address_flatnum = :flatnum';
            else
                $flatnum_stmt = 'address_flatnum is null';

            $address_stmt = '
                select address_id from addresses
                    where address_voivodeship = :voivodeship
                        and address_locality = :locality
                        and address_postcode = :postcode
                        and address_street = :street
                        and address_housenum = :housenum
                        and '.$flatnum_stmt.'
                    into addr_id;
                
                if not FOUND then
                    insert into addresses
                        values ((select max(address_id) from addresses)+1,
                            :voivodeship,
                            :locality,
                            :postcode,
                            :street,
                            :housenum,
                            :flatnum)
                        returning address_id into addr_id;
                end if;
            ';
        }
        $sql = '
            begin;
                do $$
                declare
                    addr_id addresses.address_id%type := null;
                    del_id delivery.delivery_id%type;
                BEGIN
                    '.$address_stmt.'
                    insert into delivery 
                        values ((select max(delivery_id) from delivery)+1,
                            :cod_courier,
                            :cod_inperson,
                            :adv_courier,
                            :adv_inperson,
                            :adv_inpost) returning delivery_id into del_id;
                    
                    insert into offers values ((select max(offer_id) from offers)+1,
                                               :author,
                                               :title,
                                               :desc,
                                               :price,
                                               :quantity,
                                               :date,
                                               true,
                                               :img,
                                               del_id,
                                               addr_id);
                
                END $$;
            commit;
        ';

        $date = new DateTime();

        $stmt = $this->database->connect(true)->prepare($sql);

        $authorId = 1;

        if($offer->getAddress() !== null) {
            $stmt->bindParam(':voivodeship', $offer->getAddress()->getVoivodeship(), PDO::PARAM_STR);
            $stmt->bindParam(':locality', $offer->getAddress()->getLocality(), PDO::PARAM_STR);
            $stmt->bindParam(':postcode', $offer->getAddress()->getPostcode(), PDO::PARAM_STR);
            $stmt->bindParam(':street', $offer->getAddress()->getStreet(), PDO::PARAM_STR);
            $stmt->bindParam(':housenum', $offer->getAddress()->getHousenum(), PDO::PARAM_STR);
            $stmt->bindParam(':flatnum', $offer->getAddress()->getFlatnum(), PDO::PARAM_STR);
        }
        $stmt->bindParam(':cod_courier', $offer->getDelivery()->getCodCourier(), PDO::PARAM_INT);
        $stmt->bindParam(':cod_inperson', $offer->getDelivery()->getCodInPerson(), PDO::PARAM_INT);
        $stmt->bindParam(':adv_courier', $offer->getDelivery()->getAdvCourier(), PDO::PARAM_INT);
        $stmt->bindParam(':adv_inperson', $offer->getDelivery()->getAdvInPerson(), PDO::PARAM_INT);
        $stmt->bindParam(':adv_inpost', $offer->getDelivery()->getAdvInpost(), PDO::PARAM_INT);
        $stmt->bindParam(':title', $offer->getTitle(), PDO::PARAM_STR);
        $stmt->bindParam(':desc', $offer->getDescription(), PDO::PARAM_STR);
        $stmt->bindParam(':img', $offer->getImage(), PDO::PARAM_STR);
        $stmt->bindParam(':price', $offer->getPrice(), PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $offer->getQuantity(), PDO::PARAM_INT);
        $stmt->bindParam(':author', $authorId, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date->format('Y-m-d'), PDO::PARAM_STR);
        //$stmt->bindParam(':active', 1, PDO::PARAM_BOOL);

        $stmt->execute();
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
                $offer['offer_author_id'],
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