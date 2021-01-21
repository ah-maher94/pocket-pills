<?php

namespace App\Models\User;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\UserInfo as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\UserLocation;
use App\Models\User\UserCart;


class UserInfo extends Authenticatable implements JWTSubject
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
        return $this->hasMany(UserCart::class, 'userId');
    }

    public function invoices(){
        return $this->hasMany(UserInvoices::class, 'userId');
    }

        // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
