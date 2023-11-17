<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{
    use HasFactory;

    //nama tables atribute yang dipakai
    protected $fillable = ["id", "name", "gender", "phone", "alamat", "status", "hired_on"];

}
