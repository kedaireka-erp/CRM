<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ncr;

class Kontak extends Model
{
    use HasFactory;
    protected $fillable = ["nama", "nomor_whatsapp", "divisi"];

    public function Ncr()
    {
        return $this->belongsToMany(Ncr::class);
    }
}
