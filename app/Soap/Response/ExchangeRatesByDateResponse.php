<?php

namespace App\Soap\Response;

class ExchangeRatesByDateResponse
{
    /**
     * @var string
     */
    protected $GetExchangeRatesByDateResult;

    /**
     * GetExchangeRatesByDateResult constructor.
     *
     * @param string
     */
    public function __construct($GetExchangeRatesByDateResult)
    {
        $this->GetExchangeRatesByDateResult = $GetExchangeRatesByDateResult;
    }

    /**
     * @return string
     */
    public function getGetExchangeRatesByDateResult()
    {
        return $this->GetExchangeRatesByDateResult;
    }
}