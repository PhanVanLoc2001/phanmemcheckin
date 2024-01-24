<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'cate_id',
    ];

    /**
     * Get the post that owns the post-category relationship.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the category that owns the post-category relationship.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id');
    }
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
