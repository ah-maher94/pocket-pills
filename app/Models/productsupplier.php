<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productsupplier extends Model
{
    use HasFactory;

    protected $table="productsupplier";
    protected $fillable=
                        [
                        'supplierId',
                        'productCode'];
    public $timestamps=false;
}
