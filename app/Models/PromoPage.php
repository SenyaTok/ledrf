<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoPage extends Model
{
    protected $fillable = ['slug', 'title_promo', 'text_promo', 'slider_images'];

    protected $casts = [
        'slider_images' => 'array',
    ];

    public function tableRows()
    {
        return $this->hasMany(PromoTableRow::class);
    }
}
