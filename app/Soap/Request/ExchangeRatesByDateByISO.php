<?php

namespace App\Soap\Request;

class ExchangeRatesByDateByISO
{
    /**
     * @var string
     */
    protected $date;

    /**
     * @var string
     */
    protected $ISO;


    /**
     * Get ExchangeRatesByDateByISO constructor.
     *
     * @param string $date
     * @param string $ISO
     */
    public function __construct($date, $ISO)
    {
        $this->date = $date;
        $this->ISO = $ISO;
    }

}