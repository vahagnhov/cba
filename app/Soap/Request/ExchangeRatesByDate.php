<?php

namespace App\Soap\Request;

class ExchangeRatesByDate
{
    /**
     * @var string
     */
    protected $date;

    /**
     * ExchangeRatesByDate constructor.
     *
     * @param string $date
     * @param string $ISO
     */
    public function __construct($date)
    {
        $this->date = $date;
    }

}