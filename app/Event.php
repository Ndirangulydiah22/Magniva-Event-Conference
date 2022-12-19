<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    public $table = 'events';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
       'event_name',
       'minimum_guests',
       'maximum_guests',
       'event_location',
       'venue',
       'start_date',
       'end_date',
        'created_on',
        'updated_at',
        'deleted_at',
    ];

  

    
}
