<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\News;
use App\Models\NewsSource;
use App\Services\Contracts\Parser;

use Orchestra\Parser\Xml\Facade;

class NewsParserService implements Contracts\Parser
{

    private NewsSource $source;

    public function __construct(NewsSource $source)
    {
        $this->source = $source;
        $this->link = $source->link;
    }

    /**
     * @param string $link
     * @return void
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return void
     */
    public function saveParseData(): void
    {
        $xml = Facade::load($this->source->link);
        $item_field = 'channel.item';
//        dump($this->source->title_field);
//
//        dump($this->source->xml_fields);
//        dump($this->source);
        $data = $xml->parse([
            'title' => [
                'uses' => 'channel.title',
            ],
            'link' => [
                'uses' => 'channel.link',
            ],
            'description' => [
                'uses' => 'channel.description',
            ],
            'image' => [
                'uses' =>'channel.image.url'
            ],
            'news' => [
                'uses' =>  $this->source->xml_fields,
            ],
        ]);
//        $news = $xml->parse(['news' => [
//        'uses' =>  $this->source->xml_fields]]);

        foreach ($data['news'] as $newsItem) {
            $news = News::create($newsItem);
            if ($news) {
                $news->categories()->attach($this->source['category_id']);
                dump($news);
            }
        }
    }
}
