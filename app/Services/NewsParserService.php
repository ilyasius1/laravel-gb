<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\News;
use App\Models\NewsSource;
use App\Services\Contracts\Parser;

use Orchestra\Parser\Xml\Facade;

class NewsParserService implements Parser
{

    private NewsSource $source;

    public function __construct(NewsSource $source)
    {
        $this->source = $source;
        $this->link = $source->link;
    }

    /**
     * @param string $link
     * @return Parser
     */
    public function setLink(string $link): Parser
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return void
     */
    public function saveParseData(): void
    {
        $xml = Facade::load($this->source->link);
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
                'uses' =>  $this->source->xml_fields,   //"channel.item[title>title,author>author,link>origin_link,description>description,pubDate>pub_date]"
            ],
        ]);
        foreach ($data['news'] as $newsItem) {
            $news = News::create($newsItem);
            if ($news) {
                $news->categories()->attach($this->source['category_id']);
            }
        }
    }
    public function getSource(): string
    {
        return $this->source->xmlFields;
    }
}
