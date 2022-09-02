<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'job_title',
        'email',
        'name',
        'registered_since',
        'phone'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
