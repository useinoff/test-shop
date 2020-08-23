<?php

namespace Src\Service;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Nathanmac\Utilities\Parser\Parser;

class CurrencyService
{
    CONST CBR_URL = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=';

    private $cachePool;

    /**
     * CurrencyService constructor.
     */
    public function __construct()
    {
        $this->cachePool = new FilesystemAdapter('', 60, "cache");
    }

    public function getData()
    {
        $date = date('d/m/Y');
        $xml = file_get_contents(self::CBR_URL.$date);

        $parser = new Parser();
        $currenciesFromCBR = $parser->xml($xml);
        $currencies = [];

        foreach($currenciesFromCBR['Valute'] as $currencyFromCBR) {

            $currencyArray['name'] = $currencyFromCBR['Name'];
            $currencyArray['english_name'] = $currencyFromCBR['Name'];
            $currencyArray['digit_code'] = $currencyFromCBR['NumCode'];
            $currencyArray['rate'] = (double)str_replace(',','.', $currencyFromCBR['Value']) / (int)$currencyFromCBR['Nominal'];

            $currencies[$currencyFromCBR['CharCode']] = $currencyArray;
        }

        return $currencies;
    }

    public function convertInto($price, $currency = 'USD')
    {
        $currenciesData = [];

        $currencies = $this->cachePool->getItem('currencies');
        if (!$currencies->isHit()) {
            $currenciesData = $this->getData();
            $currencies->set($currenciesData);
            $this->cachePool->save($currencies);
        }

        if ($this->cachePool->hasItem('currencies')) {
            $currencies = $this->cachePool->getItem('currencies');
            $currenciesData = $currencies->get();
        }

        return number_format($price * $currenciesData[$currency]['rate'], 2);
    }

}