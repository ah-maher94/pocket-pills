<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\UserInfo;

class UserCart extends Model
{
    use HasFactory;
    protected $table = "userCart";

    public function user(){
        return $this->belongsTo(UserInfo::class);
    }

    public function products(){
        return $this->hasMany(productinfo::class, 'productCode');
    }
}
