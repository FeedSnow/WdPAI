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

        /*if($offer->getAddress()) {
            $flatnum_stmt = '';
            if($offer->getAddress()->getFlatnum())
                $flatnum_stmt = 'address_flatnum = :flatnum';
            else
                $flatnum_stmt = 'address_flatnum is null';

            $address_stmt = '
                select address_id from addresses
                    where address_voivodeship = ?
                        and address_locality = ?
                        and address_postcode = ?
                        and address_street = ?
                        and address_housenum = ?
                        and '.$flatnum_stmt.'
                    into addr_id;
                
                if not FOUND then
                    insert into addresses
                        values ((select max(address_id) from addresses)+1,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?)
                        returning address_id into addr_id;
                end if;
            ';
        }*/
        /*else {
            $address_stmt = '
                addr_id := null;
            ';
        }*/

        $date = new DateTime();
        /*$stmt = $this->database->connect()->prepare('
            INSERT INTO offers (offer_title,
                                offer_description,
                                offer_image,
                                offer_price,
                                offer_quantity,
                                offer_author_id,
                                offer_created_at,
                                offer_active)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ');*/

        /*$stmt = $this->database->connect()->prepare('
            begin;
                do \$\$
                declare
                    addr_id addresses.address_id%type;
                    del_id delivery.delivery_id%type;
                BEGIN
                    ?
                    
                    insert into delivery (delivery_cod_courier,
                        delivery_cod_inperson,
                        delivery_adv_courier,
                        delivery_adv_inperson,
                        delivery_adv_inpost) values (?, ?, ?, ?, ?) returning delivery_id into del_id;
                    
                    insert into offers (offer_title,
                        offer_description,
                        offer_image,
                        offer_price,
                        offer_quantity,
                        offer_author_id,
                        offer_created_at,
                        offer_active,
                        delivery_id,
                        address_id) values (?, ?, ?, ?, ?, ?, ?, ?, del_id, addr_id);
                
                END \$\$;
            commit;
        ');*/
        /*$stmt = $this->database->connect(true)->prepare('
            begin;
                do $$
                declare
                    addr_id addresses.address_id%type := null;
                    del_id delivery.delivery_id%type;
                BEGIN
                    :address_stmt
                    
                    insert into delivery (delivery_cod_courier,
                        delivery_cod_inperson,
                        delivery_adv_courier,
                        delivery_adv_inperson,
                        delivery_adv_inpost) values (:cod_courier,
                            :cod_inperson,
                            :adv_courier,
                            :adv_inperson,
                            :adv_inpost) returning delivery_id into del_id;
                    
                    insert into offers (offer_title,
                        offer_description,
                        offer_image,
                        offer_price,
                        offer_quantity,
                        offer_author_id,
                        offer_created_at,
                        offer_active,
                        delivery_id,
                        address_id) values (:title, :desc, :img, :price, :quantity, :author, :date, true, del_id, addr_id);
                
                END $$;
            commit;
        ');*/
        $stmt = $this->database->connect(true)->prepare($sql);

        $authorId = 1;
        /*$params = [$address_stmt];
        if($offer->getAddress()) {
            $params = array_merge($params, [
                $offer->getAddress()->getVoivodeship(),
                $offer->getAddress()->getLocality(),
                $offer->getAddress()->getPostcode(),
                $offer->getAddress()->getStreet(),
                $offer->getAddress()->getHousenum()
            ]);
            if($offer->getAddress()->getFlatnum()) {
                $params = array_merge($params, [$offer->getAddress()->getFlatnum()]);
            }
            $params = array_merge($params, [
                $offer->getAddress()->getVoivodeship(),
                $offer->getAddress()->getLocality(),
                $offer->getAddress()->getPostcode(),
                $offer->getAddress()->getStreet(),
                $offer->getAddress()->getHousenum(),
                $offer->getAddress()->getFlatnum()
            ]);
        }

        $params = array_merge($params, [
            $offer->getDelivery()->getCodCourier(),
            $offer->getDelivery()->getCodInPerson(),
            $offer->getDelivery()->getAdvCourier(),
            $offer->getDelivery()->getAdvInPerson(),
            $offer->getDelivery()->getAdvInpost(),
            $offer->getTitle(),
            $offer->getDescription(),
            $offer->getImage(),
            $offer->getPrice(),
            $offer->getQuantity(),
            $authorId,
            $date->format('Y-m-d'),
            true
        ]);*/

        /*$stmt = $this->database->connect()->startTransaction();
        $addressId = null;
        if($offer->getAddress() !== null) {
            if ($offer->getAddress()->getFlatnum() !== null)
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
                        and ' . $flatnum_stmt . '
                    into addr_id;';
            $stmt->prepare($address_stmt);
            $stmt->bindParam(':voivodeship', $offer->getAddress()->getVoivodeship(), PDO::PARAM_STR);
            $stmt->bindParam(':locality', $offer->getAddress()->getLocality(), PDO::PARAM_STR);
            $stmt->bindParam(':postcode', $offer->getAddress()->getPostcode(), PDO::PARAM_STR);
            $stmt->bindParam(':street', $offer->getAddress()->getStreet(), PDO::PARAM_STR);
            $stmt->bindParam(':housenum', $offer->getAddress()->getHousenum(), PDO::PARAM_STR);
            if ($offer->getAddress()->getFlatnum() !== null)
                $stmt->bindParam(':flatnum', $offer->getAddress()->getFlatnum(), PDO::PARAM_STR);
            $stmt->exec();

            $stmt->prepare('
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
                end if;');
            $stmt->bindParam(':voivodeship', $offer->getAddress()->getVoivodeship(), PDO::PARAM_STR);
            $stmt->bindParam(':locality', $offer->getAddress()->getLocality(), PDO::PARAM_STR);
            $stmt->bindParam(':postcode', $offer->getAddress()->getPostcode(), PDO::PARAM_STR);
            $stmt->bindParam(':street', $offer->getAddress()->getStreet(), PDO::PARAM_STR);
            $stmt->bindParam(':housenum', $offer->getAddress()->getHousenum(), PDO::PARAM_STR);
            $stmt->bindParam(':flatnum', $offer->getAddress()->getFlatnum(), PDO::PARAM_STR);
            $stmt->exec();

        }

        $stmt->prepare();*/



        //$stmt->bindParam(':address_stmt', $address_stmt, PDO::PARAM_STR);
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