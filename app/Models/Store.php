<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'store';

    protected $primaryKey = 'ID_STORE';

    protected $keyType = 'int';

    public $timestamps = true;

    public $incrementing = true;
    
    protected $fillable = [
        'IMG_STORE', 
        'TITLE_STORE', 
        'DESC_STORE', 
        'PRICE_STORE', 
        'URL_STORE'
    ];
}
