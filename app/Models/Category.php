<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'categories';
    protected $fillable = [
        'cate_title',
        'cate_slug',
        'cate_desc',
        'cate_content',
        'cate_thumb',
        'cate_number',
        'cate_parent',
        'cate_type',
        'cate_status',
        'cate_template',
        'cate_lang',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'cate_status' => 'boolean',
    ];

    /**
     * Get the posts for the category.
     */
    public function post(): BelongsToMany
    {
        return $this->belongsToMany(Post::class,'post_category', 'cate_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_category', 'cate_id');
    }
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'cate_parent');
    }
    public function postCategory()
    {
        return $this->hasMany(PostCategory::class, 'cate_id');
    }
    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_category', 'cate_id');
    }
    public function subCate(){
        return $this->hasMany(Category::class,'cate_parent','id');
    }
}
