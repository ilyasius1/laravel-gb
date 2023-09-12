<?php

declare(strict_types=1);

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class CurrencyCacheRepository implements CurrencyRepositoryInterface
{
    private ?array $currentRate;
    private ?array $previousRate;
    private ?Carbon $rateLastUpdated;
    private ?Carbon $previousDate;

    public function __construct()
    {
        $this->currentRate = Cache::get('currentRate');
        $this->devideByNominal($this->currentRate['rates']);
        $this->previousRate = Cache::get('previousRate');
        $this->devideByNominal($this->previousRate['rates']);
        $this->rateLastUpdated = Cache::get('rateLastUpdated');
        $this->previousDate = Cache::get('previousDate');
    }

    public function all(): array
    {
        return [
            'current' => $this->getCurrent(),
            'previous' => [
                'date' => $this->previousDate,
                'rate' => $this->currentRate
            ]
        ];
    }

    public function getCurrent(): array
    {
        return [
            'date' => $this->rateLastUpdated,
            'rate' => $this->currentRate
        ];
    }

    public function getByCode(array $codes, bool $previous = false): array
    {
        $rates = [];
        if(is_array($this->currentRate)){
            foreach ($codes as $code) {
                $code = mb_strtoupper($code);
                $key = array_search($code, array_column($this->currentRate,'CharCode'));
                $rates[$code] = $this->currentRate['rates'][$key];
            }
        }
        return $rates;
    }

    public function getByCodeWithDifference(array $codes): array
    {
        $rates = $this->getByCode($codes);
        if($this->previousRate){
            foreach ($codes as $code) {
                $code = mb_strtoupper($code);
                $key = array_search($code, array_column($this->previousRate,'CharCode'));
                $rates[$code]['previousValue'] = $this->previousRate['rates'][$key]['Value'];
                $rates[$code]['diff'] = $rates[$code]['Value'] - $rates[$code]['previousValue'] ;
            }
        }
        return $rates;
    }

    private function devideByNominal(&$array): void
    {
        if(!is_array($array)){
            return;
        }
        foreach ($array as &$item)
        {
            $item['Value'] = $item['Value'] / $item['Nominal'];
            unset($item['Nominal']);
        }
    }

    public function flushData(): void
    {
        Cache::delete('rateLastUpdated');
        Cache::delete('currentRate');
        Cache::delete('previousDate');
        Cache::delete('previousRate');
    }
}
