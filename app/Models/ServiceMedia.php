<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceMedia extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'image'];

    public $timestamps = false;

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}