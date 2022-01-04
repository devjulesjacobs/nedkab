<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emballage extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_fullname',
        'customer_contact',
        'customer_contact_phone',
        'street',
        'house_number',
        'postcode',
        'city',
        'contact',
        'contact_phone',
        'contact_email',
        'lifting_equipment',
        'pickup',
        'pickup_date',
        'comments',
        'diameter_60',
        'diameter_80',
        'diameter_100',
        'diameter_120',
        'diameter_140',
        'diameter_160',
        'diameter_180',
        'diameter_200',
        'picture',
        'user',
        'status',
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user');
    }

}
