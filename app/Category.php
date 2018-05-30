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
}
