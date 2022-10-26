<?php

namespace App\Models;

use App\Models\Fppp;
use App\Models\DetailQuotation;
use App\Models\MasterAplikator;
use App\Models\ProyekQuotation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quotation extends Model
{
    use HasFactory;
    protected $table = 'proyek_quotations';
    protected $with = ['Item', "Aplikator"];


    public function Item()
    {
        return $this->hasMany(DetailQuotation::class);
    }

    public function Fppp()
    {
        return $this->hasMany(Fppp::class);
    }

    // public function DataQuotation()
    // {
    //     return $this->belongsTo(ProyekQuotation::class, 'proyek_quotation_id', 'id');
    // }

    public function Aplikator()
    {
        return $this->belongsTo(MasterAplikator::class, "kode_aplikator", "kode");
    }
}
