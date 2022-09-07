<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ncr;

class ItemNcr extends Model
{
    protected $guarded = ["id"];

    public function ncr() {
        return $this->belongsTo(Ncr::class);
    }
}
