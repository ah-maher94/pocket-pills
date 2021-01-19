<?php

namespace App\Models\User;
use Illuminate\Foundation\Auth\UserInfo as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\UserLocation;
use App\Models\User\UserCart;


class UserInfo extends Authenticatable
{
    use HasFactory;
    protected $table = "userInfo";

    protected $fillable = [
        "userName",
        "email",
        "password",
        "userPhone",
        "userLocation"
    ];

    protected $hidden = [
        'password',
    ];
    public function locations(){
        return $this->hasMany(UserLocation::class, 'userId');
    }

    public function cart(){
        return $this->belongsTo(UserCart::class, 'userId');
    }

    public function invoices(){
        return $this->hasMany(UserInvoices::class, 'userId');
    }

}
