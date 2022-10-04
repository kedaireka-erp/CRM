<?php

namespace App\Models;

use App\Models\Fppp;
use App\Models\DetailQuotation;
use App\Models\ProyekQuotation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quotation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'quotations';
    protected $with = ['Item', 'DataQuotation'];


    public function Item() 
    {
        return $this->hasMany(DetailQuotation::class);
    }

    public function Fppp()
    {
        return $this->hasMany(Fppp::class);
    }

    public function DataQuotation()
    {
        return $this->hasOne(ProyekQuotation::class);
    }
}
