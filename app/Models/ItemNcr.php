<?php

namespace App\Models;

use App\Models\Ncr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemNcr extends Model
{
    use HasFactory;
    
    protected $guarded = ["id"];

    public function ncr() {
        return $this->belongsTo(Ncr::class)->withTrashed();
    }
}
