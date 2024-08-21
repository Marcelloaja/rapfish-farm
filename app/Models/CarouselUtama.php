<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarouselUtama extends Model
{
    // Nama tabel yang digunakan
    protected $table = 'carousel_utama';

    // Nama kolom primary key
    protected $primaryKey = 'ID_CU';

    // Tipe dari primary key, jika bukan integer (misalnya UUID), set ke 'string'
    protected $keyType = 'int';

    // Menghilangkan timestamps jika tidak digunakan
    public $timestamps = true;

    // Jika primary key tidak auto-incrementing, set ke false
    public $incrementing = true;

    // Nama kolom yang diizinkan untuk mass assignment
    protected $fillable = [
        'IMG_CU', 
        'TITLE_CU', 
        'SUB_TITLE_CU', 
        'URL_CU'
    ];
}
