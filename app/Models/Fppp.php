<?php

namespace App\Models;

use App\Models\Quotation;
use App\Models\DetailQuotation;
use App\Models\ProyekQuotation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fppp extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $with = ['dataQuotation', 'Item', 'Quotation'];
    protected $table = 'fppps';

    public function dataQuotation()
    {
        return $this->hasOne(ProyekQuotation::class);
    }

    public function Item()
    {
        return $this->hasManyThrough(DetailQuotation::class, Quotation::class);
    }

    public function Quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}
