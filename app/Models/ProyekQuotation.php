<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekQuotation extends Model
{
    use HasFactory;
    protected $table = 'proyek_quotations';

    public function Quotation()
    {
        return $this->hasOne(Quotation::class);
    }
}
