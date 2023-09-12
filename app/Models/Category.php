<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    //protected $table = 'categories';
    protected $fillable = [
        'title',
        'description'
    ];
    /* Relations*/

    public function news(): BelongsToMany
    {
        return $this->belongsToMany(
            News::class,
            'category_has_news',
            'news_id',
            'category_id');
    }

    public function newsSources(): HasMany
    {
        return $this->hasMany(NewsSource::class);
    }
}
