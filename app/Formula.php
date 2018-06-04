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
    use SoftDeletes;
    
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
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
    
    public function categories(){
        return $this->belongsTo(Category::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function setProducts($products){
        $this->products()->detach();
        $this->products()->attach($products);
    }
    
    public static function make($data) {
        $formula = new self;
        self::validate($data, $formula);
        $formula->fill($data);
        $formula->save();
        if ($products = array_get($data, 'products')) {
            $formula->setProducts($products);
        }
        return $formula;
    }

    public static function updateFormula($data, self $formula) {
        self::validate($data, $formula);
        $formula->fill($data);
        $formula->save();
        if ($products = array_get($data, 'products')) {
            $formula->setProducts($products);
        }
        return $formula;
    }

    private static function validate($data, $formula) {
        $validator = Validator::make($data, $formula->rules);
        if ($validator->fails()) {
            throw new ValidationException($validator, $formula);
        }
    }
}
