<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SavedPayments extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'type', 'gateway', 'data', 'status'
	];
}