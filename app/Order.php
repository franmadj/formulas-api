<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Watson\Validating\ValidatingTrait;
use Watson\Validating\ValidationException;

class Order extends Model {

    protected $rules = [
        'number' => 'required|integer',
        'provider_id' => 'required|integer',
    ];
    protected $fillable = [
        'number', 'provider_id', 'received_by', 'notes', 'delivery_at', 'delivery'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'delivered_at'];

    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('price');
    }

    public function provider() {
        return $this->belongsTo(Provider::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
