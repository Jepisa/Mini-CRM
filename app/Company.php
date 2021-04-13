<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = ['id'];// Revisar esto o si no poner el fillable

    public function employees()
    {
        return $this->hasMany('App\Employee');
    }
}
