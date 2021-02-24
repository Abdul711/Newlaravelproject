<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
class Coupon extends Model
{
    use HasFactory;
    public function getCouponCodeAttribute($value){
        $value=Crypt::decryptString($value);
        $data=ucFirst($value);
    return $data;
    }
    public function setCouponCodeAttribute($value)
    {
        return $this->attributes['coupon_code']=Crypt::encryptString($value);
    }

}
