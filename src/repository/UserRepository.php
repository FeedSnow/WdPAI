<?php

require_once 'Repository.php';
require_once __DIR__."/../models/User.php";

class UserRepository extends Repository
{
    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('SELECT * FROM users;'/**/);

        /*$stmt->bindParam(':email', $email, PDO::PARAM_STR);/**/
        $stmt->execute();
        /*var_dump($stmt);/**/

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($user);/**/

        if($user == false) {
            return null;
        }
        return new User('j','j','j','j');/**/

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname']
        );
    }
}