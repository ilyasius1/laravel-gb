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
        'pub_date_field',
        'isActive',
    ];

    protected function xmlFields(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
//                $fields = array_filter([
//                    $attributes['title_field'],
//                    $attributes['author_field'],
//                    $attributes['image_field'],
//                    $attributes['description_field'],
//                    $attributes['origin_link_field'],
//                    $attributes['pub_date_field']
//                ], fn ($item) => strlen($item));
//                $fields =
//                    [
//                    $attributes['title_field'],
//                    $attributes['author_field'],
//                    $attributes['image_field'],
//                    $attributes['description_field'],
//                    $attributes['origin_link_field'],
//                    $attributes['pub_date_field']
//                ];
                $str = '';
//                foreach ($attributes as $key => $field) {
//                    if(strlen($field) && str_ends_with($key, '_field')) {
//                        $str .= substr($key, 0,-6) . '>' . $field;
//                    }
//                };
                $fields = array_filter($attributes, function($value, $key) {
                    return strlen($value) && str_ends_with($key, '_field') && $key !== 'item_field';
                    }, ARRAY_FILTER_USE_BOTH);

                $transformedFields = array_map(function( $key,  $value) {
                        return $value . '>' . substr($key, 0,-6);
                }, array_keys($fields), array_values($fields));
                return $attributes['item_field']
                . '['
                . implode(',', $transformedFields)
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
