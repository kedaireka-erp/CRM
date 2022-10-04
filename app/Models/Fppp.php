<?php

namespace App\Models;

use App\Models\Quotation;
use App\Models\WorkOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fppp extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $with = ['Quotation', 'wo'];
    protected $table = 'fppps';

    public function Quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function wo() {
        return $this->hasMany(WorkOrder::class);
    }
}
