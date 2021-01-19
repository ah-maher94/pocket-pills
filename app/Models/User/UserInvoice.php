<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInvoice extends Model
{
    use HasFactory;
    protected $table = "userInv";

    protected $fillable = [
        "InvDate",
        "produtQuantity",
    ];

    public function products(){
        return $this->hasMany(productinfo::class, 'productCode');
    }

    public function user(){
        return $this->belongsTo(UserInfo::class);
    }
}
