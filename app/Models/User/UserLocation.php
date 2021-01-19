<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\UserInfo;

class UserLocation extends Model
{
    use HasFactory;
    protected $table = "userlocation";

    public function user(){
        return $this->belongsTo(UserInfo::class);
    }

}
