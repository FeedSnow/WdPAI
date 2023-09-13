<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $email, string $password): ?User
    {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM public.users u JOIN public.users_details d ON u.user_details_id=d.user_details_id WHERE user_email=:email
        ');

        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user == false)
            return null;

        if(!password_verify($password, $user['user_password'])) {
            return null;
        }

        return new User($user['user_id'],
            $user['user_email'],
            $user['user_name'],
            $user['user_surname'],
            $user['user_image'],
            $user['user_role']);
    }

    public function userExists(string $email) : bool
    {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM users WHERE user_email=:email;
        ');

        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user != false;
    }

    public function createUser(string $email, string $password, string $name, string $surname)
    {
        $options = [
            'cost' => 11
        ];
        if(!$hashed = password_hash($password, PASSWORD_BCRYPT, $options))
            return false;

        $stmt = $this->database->connect(true)->prepare('
        begin;
        do $$
        declare
            det_id int;
        begin
            insert into users_details(user_name, user_surname) values (:name, :surname) returning user_details_id into det_id;
            insert into users(user_details_id, user_email, user_password) VALUES (det_id, :email, :password);
        end $$;
        commit;
        ');

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);

        return $stmt->execute() !== false;
    }
}