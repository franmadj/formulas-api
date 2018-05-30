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
    
    public static function make($data) {
        $provider = new self;
        self::validate($data, $provider);
        $provider->fill($data);
        $provider->save();
        return $provider;
    }

    public static function updateProvider($data, Provider $provider) {
        self::validate($data, $provider);
        $provider->fill($data);
        $provider->save();
        return $provider;
    }

    private static function validate($data, Provider $provider) {
        $validator = Validator::make($data, $provider->rules);
        if ($validator->fails()) {
            throw new ValidationException($validator, $provider);
        }
    }
}
