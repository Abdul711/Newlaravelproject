<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
class Category extends Model
{
    use HasFactory;
    public function getCategoryNameAttribute($value){
        $value=Crypt::decryptString($value);
        $data=ucwords($value);

    return $data;
    }
    public function setCategoryNameAttribute($value)
    {
        return $this->attributes['category_name']=Crypt::encryptString($value);
    }
}
