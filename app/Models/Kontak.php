<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ncr;

class Kontak extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function Ncr()
    {
        return $this->belongsToMany(Ncr::class)->withPivot(["id", "validated"]);
    }
}
