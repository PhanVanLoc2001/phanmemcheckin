<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'prod_name',
        'prod_slug',
        'prod_desc',
        'prod_content',
        'prod_seotitle',
        'prod_seodesc',
        'user_id',
        'prod_thumb',
        'prod_library',
        'prod_template',
        'prod_status',
        'prod_spin',
        'prod_price',
        'prod_excerpt',
        'prod_saleprice',
        'prod_attributes',
        'prod_feature',
        'prod_background',
        'download',
        'update'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category', 'prod_id', 'cate_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'prod_id', 'tag_id');
    }

    public function prodTag(): BelongsToMany

    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'prod_id', 'tag_id');
    }

    public function menuItems(): MorphMany
    {
        return $this->morphMany(MenuItem::class, 'item');
    }
}
