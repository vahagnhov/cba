<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Soap\Request\GetISOCodes;
use App\Soap\Request\ExchangeRatesByDateByISO;
use App\Soap\Request\ExchangeRatesByDate;
use App\Soap\Response\GetISOCodesResponse;
use App\Soap\Response\ExchangeRatesByDateByISOResponse;
use App\Soap\Response\ExchangeRatesByDateResponse;

class SoapController
{
    /**
     * @var SoapWrapper
     */
    protected $soapWrapper;

    /**
     * SoapController constructor.
     *
     * @param SoapWrapper $soapWrapper
     */
    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;
    }

    /**
     * Use the SoapWrapper for get get Rates By Dates And Codes
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getRates(Request $request)
    {
        $input = $request->all();
        $currency = $input['currency'];
        $date = $input['date'];

        $this->soapWrapper->add('Currency', function ($service) {
            $service
                ->wsdl('http://api.cba.am/exchangerates.asmx?WSDL')
                ->trace(true)
                ->cache(WSDL_CACHE_NONE)// Optional: Set the WSDL cache
                ->options([
                    'user_agent' => 'PHPSoapClient',      // Add this as options
                ])
                ->classmap([
                    ExchangeRatesByDateByISO::class,
                    ExchangeRatesByDateByISOResponse::class,
                ]);
        });


        // With classmap
        $response = $this->soapWrapper->call('Currency.ExchangeRatesByDateByISO', [
            new ExchangeRatesByDateByISO($date, $currency)
        ]);


        $ISO = $response->ExchangeRatesByDateByISOResult->Rates->ExchangeRate->ISO;
        $rate = $response->ExchangeRatesByDateByISOResult->Rates->ExchangeRate->Rate;
        $amount = $response->ExchangeRatesByDateByISOResult->Rates->ExchangeRate->Amount;

        return redirect()->back()->withErrors(['ISO' => $ISO, 'amount' => $amount, 'rate' => $rate, 'date' => $date]);

    }


    /**
     * Use the SoapWrapper for get ISO Codes
     */
    public function getISOCodes()
    {

        $this->soapWrapper->add('Currency', function ($service) {
            $service
                ->wsdl('http://api.cba.am/exchangerates.asmx?WSDL')
                ->trace(true)
                ->cache(WSDL_CACHE_NONE)// Optional: Set the WSDL cache
                ->options([
                    'user_agent' => 'PHPSoapClient',      // Add this as options
                ])
                ->classmap([
                    GetISOCodes::class,
                    GetISOCodesResponse::class,
                ]);
        });


        // With classmap
        $response = $this->soapWrapper->call('Currency.ISOCodes', [
            new GetISOCodes()
        ]);

        $currencies = $response->ISOCodesResult->string;
        return view('iso-codes', [
            'currencies' => $currencies
        ]);

    }

    /**
     * Charts
     */
    public function charts()
    {
        return view('charts');
    }

    /**
     * Use the SoapWrapper for get get Rates By Dates
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getRatesByDate(Request $request)
    {
        $input = $request->all();
        $date = $input['date'];

        $this->soapWrapper->add('Currency', function ($service) {
            $service
                ->wsdl('http://api.cba.am/exchangerates.asmx?WSDL')
                ->trace(true)
                ->cache(WSDL_CACHE_NONE)// Optional: Set the WSDL cache
                ->options([
                    'user_agent' => 'PHPSoapClient',      // Add this as options
                ])
                ->classmap([
                    ExchangeRatesByDate::class,
                    ExchangeRatesByDateResponse::class,
                ]);
        });


        // With classmap
        $response = $this->soapWrapper->call('Currency.ExchangeRatesByDate', [
            new ExchangeRatesByDate($date)
        ]);
        $exchangeRates = $response->ExchangeRatesByDateResult->Rates->ExchangeRate;
        $ISO_array = [];
        $rate_array = [];
        foreach ($exchangeRates as $exchangeRate) {
            $ISO_array[] .= $exchangeRate->ISO;
            $rate_array[] .= $exchangeRate->Rate;
        }
        dd($exchangeRates);
        return redirect()->back();


    }


}