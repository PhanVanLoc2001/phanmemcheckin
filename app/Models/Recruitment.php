<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    protected $fillable = [
        'rec_title',
        'rec_slug',
        'rec_desc',
        'rec_content',
        'rec_thumb',
        'rec_seotitle',
        'rec_seodesc',
        'rec_money',
        'rec_department',
        'rec_status',
        'rec_spin',
        'rec_quantity',
        'rec_time',
        'rec_workplace',
        'rec_address',
        'rec_template',
    ];
}
