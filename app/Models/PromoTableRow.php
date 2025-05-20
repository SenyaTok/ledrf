<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoTableRow extends Model
{
    protected $fillable = ['promo_page_id', 'columns'];

    protected $casts = [
        'columns' => 'array',
    ];

    public function promoPage()
    {
        return $this->belongsTo(PromoPage::class);
    }
}
