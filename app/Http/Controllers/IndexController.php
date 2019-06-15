<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\DomCrawler\Crawler;
use Session;
use DB;

class IndexController extends Controller
{
    /**
     * Show simple currencies table
     *
     */
    public function index()
    {
        $currencies = Currency::all();
        $date = date('d.m.Y');
        return view('index', [
            'currencies' => $currencies,
            'date' => $date
        ]);
    }

    /**
     * Show currencies table by date select
     *
     */
    public function currenciesByDate()
    {
        $currencies = Currency::select('id', 'currency')->get();
        return view('currencies-all', [
            'currencies' => $currencies
        ]);
    }


    /**
     * Parse Currencies
     *
     */
    public function parseCurrencies()
    {

        ini_set('max_execution_time', 300);
        $client = new Client();

        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
            'verify' => false
        ));

        $client->setClient($guzzleClient);

        $goutteClient = $client->request('GET', 'https://www.cba.am/en/sitepages/exchangearchive.aspx');
        Currency::query()->truncate();
        $goutteClient->filter('.three_tables table tr:not(.blue_td)')->each(function ($node) {

            $currency = $node->filter('tr:not(.blue_td) td span')->text();
            $unit = $node->filter('tr:not(.blue_td) td em')->text();
            $rate = $node->filter('tr:not(.blue_td) td:nth-child(2)')->text();

            /* DB::table('currencies')->insert(
                 ['currency' => $currency, 'unit' => $unit, 'rate' => $rate]
             );*/

            $currencies = new Currency();
            $currencies->currency = $currency;
            $currencies->unit = $unit;
            $currencies->rate = $rate;
            $currencies->save();

        });
        Session::flash('success-message', 'Parsing successfully finished!');
        return redirect()->back();

    }


    /**
     * Parse Currencies By Date
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function parseCurrenciesByDate(Request $request)
    {
        session_start();

        if (isset($_SESSION['date'])) {
            unset($_SESSION['date']);
        }
        if (isset($_SESSION['rate'])) {
            unset($_SESSION['rate']);
        }
        if (isset($_SESSION['count'])) {
            unset($_SESSION['count']);
        }
        if (isset($_SESSION['currencies'])) {
            unset($_SESSION['currencies']);
        }
        $input = $request->all();
        $currencies = $input['currencies'];

        if ($currencies == '') {
            $currencies = 'USD,GBP,RUB,EUR';
        }
        $count = $input['count'];
        if ($count == 0) {
            $count = 4;
        }
        $_SESSION['count'] = $count;
        $_SESSION['currencies'] = $currencies;
        $start_date = $input['start_date'];
        $end_date = $input['end_date'];

        ini_set('max_execution_time', 300);
        $client = new Client();

        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
            'verify' => false
        ));

        $client->setClient($guzzleClient);

        $goutteClient = $client->request('GET', "https://www.cba.am/EN/SitePages/ExchangeArchive.aspx?DateFrom=" . $start_date . "&DateTo=" . $end_date . "&ISOCodes=" . $currencies);


        $goutteClient->filter('table.table_46 tr:not(.blue_td)')->each(function ($node) {
            /* $goutteClient->filter('table.table_46')->each(function ($node) {*/
            /* $table = $node->filter('.table_46')->text();*/

            $date = $node->filter('tr:not(.blue_td) td:nth-child(1)')->text();
            $rate = $node->filter('tr:not(.blue_td) td:not(:first-child)')->text();



            $_SESSION['date'] = $date;
            $_SESSION['rate'] = $rate;
            /* $_SESSION['date'] = $date;
             $_SESSION['rate'] = $rate;*/


        });

        //return redirect()->back()->with('table', $_SESSION['table']);

        return redirect('by-date');

    }

    public function byDate()
    {
        session_start();
        return view('by-date')->with([
            'rate' => $_SESSION['rate'],
            'date' => $_SESSION['date'],
            'count' => $_SESSION['count'],
            'currencies' => $_SESSION['currencies'],
        ]);
    }

}
