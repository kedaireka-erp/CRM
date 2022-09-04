<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ncr extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    protected $fillable = ["mitra", "projek", "no_ncr", "no_wo", "tanggal", "no_fppp", "kepada", "item"];
}
