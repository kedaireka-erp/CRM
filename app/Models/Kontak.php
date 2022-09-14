<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ncr;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kontak extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ["id"];

    public function Ncr()
    {
        return $this->belongsToMany(Ncr::class)->withPivot(["id", "validated"])->withTrashed();
    }
}
