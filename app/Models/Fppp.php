<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fppp extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $with = ['dataQuotation', 'Item', 'Quotation'];
    protected $table = 'fppps';

    public function dataQuotation()
    {
        return $this->hasOneThrough(ProyekQuotation::class, Quotation::class);
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
