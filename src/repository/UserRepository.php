<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM public.users u JOIN public.users_details d ON u.user_details_id=d.user_details_id WHERE user_email=:email
        ');

        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user == false)
            return null;

        return new User($user['user_email'], $user['user_password'], $user['user_name'], $user['user_surname']);
    }
}