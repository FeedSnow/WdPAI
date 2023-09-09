<?php

class Contact
{
    private $name;
    private $phone;
    private $email;
    private $locality;
    private $image;

    public function __construct($name, $phone, $email, $locality, $image)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->locality = $locality;
        $this->image = $image;
    }

    public function getImage() : string
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getPhone() : string
    {
        return $this->phone;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getLocality() : string
    {
        return $this->locality;
    }

    public function setLocality(string $locality)
    {
        $this->locality = $locality;
    }
}