<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Page extends Model
{
    use HasFactory;
    protected $table = 'pages';
    protected $fillable = [
        'page_title',
        'page_seotitle',
        'page_slug',
        'page_desc',
        'page_seodesc',
        'page_content',
        'page_thumb',
        'page_status',
        'page_templates'
    ];
}
