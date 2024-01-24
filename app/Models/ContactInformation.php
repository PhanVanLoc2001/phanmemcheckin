<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    use HasFactory;

    protected $table = 'contact_information';

    protected $fillable = [
        'name',
        'phone_number',
        'facebook_link',
        'phone_link',
        'messenger_link',
        'zalo_link',
        'hcm_link',
        'group_link',
        'tiktok_link',
        'map_link',
        'youtube_link',
        'code_header',
        'banner',
        'code_footer',
        'list_phone',
        'contact_single'
    ];
}
