<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staffdepartment extends Model
{
    use HasFactory;
    protected $table='staffdepartment';
    protected $fillable=['departmentId','departmentName','branchId'];
    public $timestamps=false;
}
