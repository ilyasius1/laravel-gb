<?php

declare(strict_types=1);

namespace App\Repositories;

interface CurrencyRepositoryInterface
{
    public function all(): array;

    public function getByCode(array $codes): array;

    public function getByCodeWithDifference(array $codes): array;

    public function flushData(): void;
}
