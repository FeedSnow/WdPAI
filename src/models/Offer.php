<?php

require_once __DIR__.'/../models/Delivery.php';
require_once __DIR__.'/../models/Address.php';

class Offer
{
    private $authorId;
    private $title;
    private $description;
    private $image;
    private $price;
    private $quantity;
    private $delivery;
    private $address;

    public function __construct($authorId, $title, $description, $image, $price, $quantity, $delivery = null, $address = null)
    {
        $this->authorId = $authorId;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->delivery = $delivery;
        $this->address = $address;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getImage() : string
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function getPrice() : int
    {
        return $this->price;
    }

    public function setPrice(int $price)
    {
        $this->price = $price;
    }

    public function getQuantity() : int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function getDelivery() : ?Delivery
    {
        return $this->delivery;
    }

    public function setDelivery(Delivery $delivery)
    {
        $this->delivery = $delivery;
    }

    public function getAddress() : ?Address
    {
        return $this->address;
    }

    public function setAddress(Address $address)
    {
        $this->address = $address;
    }

    public function getAuthorId() : int
    {
        return $this->authorId;
    }
}