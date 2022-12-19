<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'subject', 'message'];
    protected $dates = ['deleted_at'];
}
