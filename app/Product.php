<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Watson\Validating\ValidatingTrait;
use Watson\Validating\ValidationException;

class Product extends Model
{
    
    protected $rules = [
        'name' => 'required|string',
        'code' => 'required|string',
        'price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
        'density' => 'required|regex:/^\d*(\.\d{1,3})?$/',
    ];
    
    protected $fillable = [
        'name', 'code', 'price','density'
    ];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    public function provider(){
        return $this->belongsTo(Provider::class);
    }
    
    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}
