<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $primaryKey = "id";

    public $incrementing = true;

    public $timestamps = true;
}
