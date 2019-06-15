<?php

namespace App\Soap\Response;

class ExchangeRatesByDateByISOResponse
{
    /**
     * @var string
     */
    protected $GetExchangeRatesByDateByISOResult;

    /**
     * GetExchangeRatesByDateByISOResult constructor.
     *
     * @param string
     */
    public function __construct($GetExchangeRatesByDateByISOResult)
    {
        $this->GetExchangeRatesByDateByISOResult = $GetExchangeRatesByDateByISOResult;
    }

    /**
     * @return string
     */
    public function getGetExchangeRatesByDateByISOResult()
    {
        return $this->GetExchangeRatesByDateByISOResult;
    }
}