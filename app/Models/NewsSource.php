<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class NewsSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'link',
        'category_id',
        'item_field',
        'title_field',
        'author_field',
        'image_field',
        'description_field',
        'origin_link_field',
        'isActive',
    ];

    protected function xmlFields(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $fields = array_filter([
                    $attributes['title_field'],
                    $attributes['author_field'],
                    $attributes['image_field'],
                    $attributes['description_field'],
                    $attributes['origin_link_field']
                ], fn ($item) => strlen($item));
                return $attributes['item_field']
                . '['
                . implode(',', $fields)
                . ']';
        });
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault();
    }

    public function scopeActive(Builder $query)
    {
        $query->where('is_active', true);
    }
}
