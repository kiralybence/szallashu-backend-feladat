<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // The primary key in the CSV is called "companyId", so I decided to follow that naming convention
    protected $primaryKey = 'companyId';

    // Because the CSV doesn't contain any create/update timestamps
    public $timestamps = false;

    protected $fillable = [
        'companyName',
        'companyRegistrationNumber',
        'companyFoundationDate',
        'country',
        'zipCode',
        'city',
        'streetAddress',
        'latitude',
        'longitude',
        'companyOwner',
        'employees',
        'activity',
        'active',
        'email',
        'password',
    ];

    protected $casts = [
        'companyFoundationDate' => 'date:Y-m-d',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'active' => 'boolean',
    ];
}
