<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['name','number','description','type','temperature','operatingtime','data','state'];
}
