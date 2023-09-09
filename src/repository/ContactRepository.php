<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Contact.php';

class ContactRepository extends Repository
{
    /*
    public function getOffer(int $id): ?Contact
    {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM contacts WHERE user_id_1=:id OR user_id_2=:id
        ');

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $offer = $stmt->fetch(PDO::FETCH_ASSOC);

        if($offer == false)
            return null;

        return new Contact()
        (
            $offer['user_name'].' '.$offer['user_surname'],
            $offer['offer_description'],
            $offer['offer_image'],
            $offer['offer_price'],
            $offer['offer_quantity']
        );
    }*/

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

    public function getContacts(): array
    {
        $result = [];
        // TODO $user_id to ma być id użytkownika danej sesji
        $user_id = 1;

        $stmt = $this->database->connect()->prepare('
            select u.user_id as id,
               user_name as name,
               user_surname as surname,
               user_email as email,
               user_phone as phone,
               user_image as image, 
               address_locality as locality,
               contact_status as status
            from contacts c
                join users u
                    on c.user_id_1 = u.user_id
                join users_details ud
                    on u.user_details_id = ud.user_details_id
                join addresses_to_users atu
                    on u.user_id = atu.user_id
                join addresses a
                    on atu.address_id = a.address_id
            where user_id_2 = :id
            union
            select u.user_id as id,
                   user_name as name,
                   user_surname as surname,
                   user_email as email,
                   user_phone as phone,
                   user_image as image, 
                   address_locality as locality,
                   contact_status as status
            from contacts c
                join users u
                    on c.user_id_2 = u.user_id
                join users_details ud
                    on u.user_details_id = ud.user_details_id
                join addresses_to_users atu
                    on u.user_id = atu.user_id
                join addresses a
                    on atu.address_id = a.address_id
            where user_id_1 = :id;
        ');
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($contacts as $contact)
        {
            $result[] = new Contact(
                $contact['name'].' '.$contact['surname'],
                $contact['phone'],
                $contact['email'],
                $contact['locality'],
                $contact['image']
            );
        }

        return $result;
    }

    public function getContactByName(string $searchString)
    {
        $searchString = '%'.strtolower($searchString).'%';
        $user_id = 1;

        $stmt = $this->database->connect()->prepare(' 
            (select u.user_id as id,
                    user_name as name,
                    user_surname as surname,
                    user_email as email,
                    user_phone as phone,
                    user_image as image,
                    address_locality as locality,
                    contact_status as status
                from contacts c
                    join users u
                        on c.user_id_1 = u.user_id
                    join users_details ud
                        on u.user_details_id = ud.user_details_id
                    join addresses_to_users atu
                        on u.user_id = atu.user_id
                    join addresses a
                        on atu.address_id = a.address_id
                where user_id_2 = :id
            union
            select u.user_id as id,
                    user_name as name,
                    user_surname as surname,
                    user_email as email,
                    user_phone as phone,
                    user_image as image,
                    address_locality as locality,
                    contact_status as status
                from contacts c
                    join users u
                        on c.user_id_2 = u.user_id
                    join users_details ud
                        on u.user_details_id = ud.user_details_id
                    join addresses_to_users atu
                        on u.user_id = atu.user_id
                    join addresses a
                        on atu.address_id = a.address_id
                where user_id_1 = :id)
            intersect
            (select u.user_id as id,
                    user_name as name,
                    user_surname as surname,
                    user_email as email,
                    user_phone as phone,
                    user_image as image,
                    address_locality as locality,
                    contact_status as status
                from contacts c
                    join users u
                        on c.user_id_2 = u.user_id
                    join users_details ud
                        on u.user_details_id = ud.user_details_id
                    join addresses_to_users atu
                        on u.user_id = atu.user_id
                    join addresses a
                        on atu.address_id = a.address_id
                WHERE LOWER(user_name)
                          LIKE :search
                   OR LOWER(user_surname)
                          LIKE :search
                   or lower(concat(user_name, \' \', user_surname))
                          like :search
            union
            select u.user_id as id,
                    user_name as name,
                    user_surname as surname,
                    user_email as email,
                    user_phone as phone,
                    user_image as image,
                    address_locality as locality,
                    contact_status as status
                from contacts c
                    join users u
                        on c.user_id_1 = u.user_id
                    join users_details ud
                        on u.user_details_id = ud.user_details_id
                    join addresses_to_users atu
                        on u.user_id = atu.user_id
                    join addresses a
                        on atu.address_id = a.address_id
                WHERE LOWER(user_name)
                          LIKE :search
                   OR LOWER(user_surname)
                          LIKE :search
                   or lower(concat(user_name, \' \', user_surname))
                          like :search);
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}