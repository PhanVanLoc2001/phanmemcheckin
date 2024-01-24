<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = [
        'post_title',
        'post_seotitle',
        'post_slug',
        'post_desc',
        'post_seodesc',
        'post_content',
        'user_id',
        'post_thumb',
        'post_library',
        'post_status',
        'post_spinned',
        'post_keyword',
        'post_lang',
        'post_templates',
        'post_list'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function menuItem()
    {
        return $this->hasOne(MenuItem::class, 'item_id');
    }
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'cate_id');
    }
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
    public function postTag(): BelongsToMany

    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
