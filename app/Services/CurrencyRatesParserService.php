<?php

declare(strict_types=1);

namespace App\Services;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use http\Env;
use Illuminate\Support\Facades\Cache;
use Orchestra\Parser\Xml\Facade;

class CurrencyRatesParserService implements Contracts\Parser
{
    private string $link;
    private string $format;

    public function __construct($link = '', $format = 'xml')
    {
        $this->link = env('CURRENCY_RATES_URI', $link);
        $this->format = env('CURRENCY_RATES_FORMAT', $format);
    }

    private function parseXML(): void
    {
        $xml = Facade::load($this->link);
        $attributes = $xml->getContent()->attributes();


        $rateDate = new CarbonImmutable($attributes['Date']);
        $data['date'] = $rateDate;
        $data['rates'] = $xml->parse([
            [
                'uses' => 'Valute[NumCode,CharCode,Nominal,Name,Value]'
            ]
        ])[0];
        foreach ($data['rates'] as &$rate) {
            $rate['Value'] = (float)(str_replace(',', '.', $rate['Value']));
            $rate['Nominal'] = (float)(str_replace(',', '.', $rate['Nominal']));
            echo $rate['Value'];
        }
        dump($data);
        $previousDate = Cache::get('rateLastUpdated');
        $previousRate = Cache::get('currentRate');
        if(!$previousRate) {
            $previousRate = $data;
            $previousDate = now();
        }
        Cache::put('previousDate', $previousDate);
        Cache::put('rateLastUpdated', now());
        Cache::put('previousRate', $previousRate);
        Cache::put('currentRate', $data);
    }

    private function parseJSON(): void
    {

    }

    /**
     * @param string $link
     * @return $this
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @inheritDoc
     */
    public function saveParseData(): void
    {
        $previousDate = Cache::get('rateLastUpdated');
        if($this->format === 'xml'){
            $this->parseXML();
        } else {
            $this->parseJSON();
        }
    }

}
