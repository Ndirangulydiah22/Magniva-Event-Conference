<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class attendance extends Model
{
    use SoftDeletes;

    public $table = 'attendances';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
       'event_name',
       'first_name',
       'last_name',
       'phone',
       'email',
       'designation',
       'organization',
       'status',
       'city',
        'country',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

  
}
