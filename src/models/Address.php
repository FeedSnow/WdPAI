<?php

class Address
{
    private $voivodeship;
    private $locality;
    private $postcode;
    private $street;
    private $housenum;
    private $flatnum;

    public function __construct($voivodeship, $locality, $postcode, $street, $housenum, $flatnum = null)
    {
        $this->voivodeship = $voivodeship;
        $this->locality = $locality;
        $this->postcode = $postcode;
        $this->street = $street;
        $this->housenum = $housenum;
        $this->flatnum = $flatnum;
    }

    public function getVoivodeship() : string
    {
        return $this->voivodeship;
    }

    public function setVoivodeship(string $voivodeship)
    {
        $this->voivodeship = $voivodeship;
    }

    public function getLocality() : string
    {
        return $this->locality;
    }

    public function setLocality(string $locality)
    {
        $this->locality = $locality;
    }

    public function getPostcode() : string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode)
    {
        $this->postcode = $postcode;
    }

    public function getStreet() : string
    {
        return $this->street;
    }

    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    public function getHousenum() : string
    {
        return $this->housenum;
    }

    public function setHousenum(string $housenum)
    {
        $this->housenum = $housenum;
    }

    public function getFlatnum() : string
    {
        return $this->flatnum;
    }

    public function setFlatnum(string $flatnum)
    {
        $this->flatnum = $flatnum;
    }
}