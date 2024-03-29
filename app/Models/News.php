<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\NewsStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';
    protected $fillable = [
        'title',
        'author',
        'status',
        'description',
        'origin_link'
    ];

    /* Relations*/

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'category_has_news',
            'news_id',
            'category_id');
    }

    /* Scopes */
    public function scopeActive(Builder $query): void
    {
        $query->where('status', NewsStatus::ACTIVE->value);
    }

    public function scopeDraft(Builder $query): void
    {
        $query->where('status', NewsStatus::DRAFT->value);
    }

    public function scopeBlocked(Builder $query): void
    {
        $query->where('active', NewsStatus::BLOCKED->value);
    }

}
