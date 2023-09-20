<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\NewsSource;
use App\Services\Contracts\Parser;
use App\Services\NewsParserService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewsParsingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $link;
    protected NewsSource $source;

    /**
     * Create a new job instance.
     */
    public function __construct(string $link)
    {
        $this->link = $link;
    }

    /**
     * Execute the job.
     */
    public function handle(NewsParserService $parser): void
    {
        $parser->setLink($this->link)->saveParseData();
    }
}
