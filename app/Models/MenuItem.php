<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MenuItem extends Model
{
    use HasFactory;
    protected $table = 'menu_item';
    protected $fillable = [
        'name',
        'icon',
        'type',
        'slug',
        'menu_id',
        'parent',
        'item_id',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'item_id')->where('type', 'categories');
    }
    public function posts()
    {
        return $this->belongsTo(Post::class, 'item_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'item_id')->where('type', 'posts');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'item_id')->where('type', 'products');
    }
    public function products()
    {
        return $this->belongsTo(Product::class, 'item_id');
    }
    public function page()
    {
        return $this->belongsTo(Product::class, 'item_id')->where('type', 'pages');
    }
}
