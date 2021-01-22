<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userinfo extends Model
{
    use HasFactory;
    protected $table="userinfo";
    protected $fillable=
                        ['userId',
                        'userName',
                        'userEmail',
                        'userPassword',
                        'userPhone',
                        'userRole'];
    public $timestamps=false;
}
