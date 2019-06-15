<?php

namespace App\Soap\Response;

class GetISOCodesResponse
{
    /**
     * @var string
     */
    protected $GetISOCodesResult;

    /**
     * GetConversionAmountResponse constructor.
     *
     * @param string
     */
    public function __construct($GetISOCodesResult)
    {
        $this->GetISOCodesResult = $GetISOCodesResult;
    }

    /**
     * @return string
     */
    public function getGetISOCodesResult()
    {
        return $this->GetISOCodesResult;
    }
}