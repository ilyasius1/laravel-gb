<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\ParserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Parser\ParserRequest;
use App\Jobs\NewsParsingJob;
use App\Models\NewsSource;
use App\Queries\NewsSourcesQueryBuilder;
use App\Queries\QueryBuilder;
use App\Repositories\CurrencyRepositoryInterface;
use App\Services\Contracts\Parser;
use App\Services\CurrencyRatesParserService;
use App\Services\NewsParserService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;

class ParserController extends Controller
{
    protected QueryBuilder $newsSourcesQueryBuilder;
    protected CurrencyRepositoryInterface $currencyRepository;

    public function __construct(NewsSourcesQueryBuilder $newsSourcesQueryBuilder, CurrencyRepositoryInterface $currencyRepository) {
        $this->newsSourcesQueryBuilder = $newsSourcesQueryBuilder;
        $this->currencyRepository = $currencyRepository;
    }
    /**
     * Handle the incoming request.
     */
     public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     {
//         $this->currencyRepository->flushData();
         $rates = $this->currencyRepository->getByCodeWithDifference(['USD','EUR']);
         return view('admin.parser.index', [
             'newsSources' => $this->newsSourcesQueryBuilder->getActive(),
             'rates' => $rates
         ]);
     }

    /**
     * @param ParserRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|Application|RedirectResponse|Redirector
     */
    public function run(ParserRequest $request): \Illuminate\Contracts\Foundation\Application|Application|RedirectResponse|Redirector
     {
         $data = $request->validated();
//         dd($data);
         if($data['type'] === ParserType::NEWS->value) {
             $sources = $this->newsSourcesQueryBuilder->findMany($data['sources']);
             foreach ($sources as $source) {
                 dispatch(new NewsParsingJob($source->link));
//                 NewsParsingJob::dispatch($source);
             }
             die();
         }
         else {
             $parser = new CurrencyRatesParserService();
             try {
                 $parser->saveParseData();
             } catch (\Throwable $exception) {
                 \Log::error($exception->getMessage(), $exception->getTrace());
                 die();
                 return redirect(route('admin.parser.index'))->with('error', __('Failed to load or parse data'));
             }
         }
         return redirect(route('admin.parser.index'))->with('success', __('Job(s) added to queue'));
     }
}
