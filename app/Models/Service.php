<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'file', 'service_type_id'];

    public function type()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }

    public function __get($key)
    {
        switch ($key) {
            case 'type':
                return $this->type()->first()->name;

            case 'cover':
                return $this->serviceMedia()->first()->image;
        }

        return parent::__get($key);
    }

    public function serviceMedia()
    {
        return $this->hasMany(ServiceMedia::class);
    }

}
