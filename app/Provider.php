<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Watson\Validating\ValidatingTrait;
use Watson\Validating\ValidationException;

class Provider extends Model
{
    
    protected $rules = [
        'name' => 'required|string',
        'address' => 'required|string',
        'phone' => 'required|string',
    ];
    
    protected $fillable = [
        'name', 'address', 'phone',
    ];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

   
    public function products(){
        return $this->hasMany(Product::class);
    }
    
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
