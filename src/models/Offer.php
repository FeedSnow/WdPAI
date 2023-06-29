<?php

class Offer
{
    public function __construct($title, $description, $image, $price, $quantity)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
        $this->quantity = $quantity;
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

    private $title;
    private $description;
    private $image;
    private $price;
    private $quantity;

    public function getPrice() : float
    {
        return $this->price;
    }

    public function setPrice(float $price)
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
}