<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'quotations';


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
