<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Models\ExternalSource;

interface Parser
{
    /**
     * @param string $link
     * @return void
     */
    public function setLink(string $link): void;

    /**
     * @return void
     */
    public function saveParseData(): void;

}
