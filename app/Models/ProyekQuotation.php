<?php

namespace App\Models;

use App\Models\Quotation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProyekQuotation extends Model
{
    use HasFactory;
    protected $table = 'proyek_quotations';

    public function Quotation()
    {
        return $this->hasOne(Quotation::class, 'proyek_quotation_id');
    }
}
