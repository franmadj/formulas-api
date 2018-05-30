<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Watson\Validating\ValidatingTrait;
use Watson\Validating\ValidationException;

class Category extends Model
{
    
    protected $rules = [
        'name' => 'required|string',
      
    ];
    
    protected $fillable = [
        'name'
    ];
    
    public function formulas(){
        return $this->belongsToMany(Formula::class);
    }
    
    public static function make($data) {
        $category = new self;
        self::validate($data, $category);
        $category->fill($data);
        $category->save();
        return $category;
    }

    public static function updateCategory($data, self $category) {
        self::validate($data, $category);
        $category->fill($data);
        $category->save();
        return $category;
    }

    private static function validate($data, $category) {
        $validator = Validator::make($data, $category->rules);
        if ($validator->fails()) {
            throw new ValidationException($validator, $category);
        }
    }
}
