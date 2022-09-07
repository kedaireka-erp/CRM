<?php

namespace App\Models;

use App\Models\Kontak;
use App\Models\ItemNcr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ncr extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    
    protected $dates = ["tanggal_ncr", "tanggal_memo", "deadline_pengambilan"];

    protected $with = ["Kontak", "ItemNcr"];

    public function Kontak()
    {
        return $this->belongsToMany(Kontak::class);
    }
    
    public function ItemNcr()
    {
        return $this->hasMany(ItemNcr::class);
    }
}
