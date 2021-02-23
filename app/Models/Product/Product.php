<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
class Product extends Model
{
    use HasFactory;

 public function getProductNameAttribute($value){
        $value=Crypt::decryptString($value);
        $data=ucFirst($value);
    return $data;
    }
    public function setProductNameAttribute($value)
    {
        return $this->attributes['product_name']=Crypt::encryptString($value);
    }
}
