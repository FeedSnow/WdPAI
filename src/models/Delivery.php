<?php

class Delivery
{
    private $codCourier;
    private $codInPerson;
    private $advCourier;
    private $advInPerson;
    private $advInpost;

    public function __construct($codCourier = null, $codInPerson = null, $advCourier = null, $advInPerson = null, $advInpost = null)
    {
        if(!$codCourier && !$codInPerson && !$advCourier && !$advInPerson && !$advInpost)
            die('There must be at least one mode of delivery.');
        $this->codCourier = $codCourier;
        $this->codInPerson = $codInPerson;
        $this->advCourier = $advCourier;
        $this->advInPerson = $advInPerson;
        $this->advInpost = $advInpost;
    }

    public function getCodCourier() : int
    {
        return $this->codCourier;
    }

    public function setCodCourier(int $codCourier)
    {
        $this->codCourier = $codCourier;
    }

    public function getCodInPerson() : int
    {
        return $this->codInPerson;
    }

    public function setCodInPerson(int $codInPerson)
    {
        $this->codInPerson = $codInPerson;
    }

    public function getAdvCourier() : int
    {
        return $this->advCourier;
    }

    public function setAdvCourier(int $advCourier)
    {
        $this->advCourier = $advCourier;
    }

    public function getAdvInPerson() : int
    {
        return $this->advInPerson;
    }

    public function setAdvInPerson(int $advInPerson)
    {
        $this->advInPerson = $advInPerson;
    }

    public function getAdvInpost() : int
    {
        return $this->advInpost;
    }

    public function setAdvInpost(int $advInpost)
    {
        $this->advInpost = $advInpost;
    }


}