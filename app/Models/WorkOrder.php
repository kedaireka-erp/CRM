<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;
    protected $table = 'logistics';

    public function fppp()
    {
        return $this->belongsTo(Fppp::class);
    }
}
