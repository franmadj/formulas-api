<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Watson\Validating\ValidatingTrait;
use Watson\Validating\ValidationException;

class Formula extends Model
{
    
    protected $rules = [
        'name' => 'required|string',
        'code' => 'required|string',
        'category_id' => 'required|string',
    ];
    
    protected $fillable = [
        'name', 'code', 'category_id','description'
    ];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('price');
    }
    
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
