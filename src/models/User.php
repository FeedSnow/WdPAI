<?php

class User
{
    private $id;
    private $email;
    //private $password;
    private $name;
    private $surname;
    private $img;
    private $role;

    public function __construct(int $id, string $email, /*string $password,*/ string $name, string $surname, string $img, UserRole $role)
    {
        $this->id = $id;
        $this->email = $email;
        //$this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->img = $img;
        $this->role = $role;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /*public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }*/

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function getImage() : string
    {
        return $this->img;
    }

    public function setImage(string $img)
    {
        $this->img = $img;
    }

    public function getRole() : UserRole
    {
        return $this->role;
    }
}

enum UserRole
{
    case Admin;
    case User;
}