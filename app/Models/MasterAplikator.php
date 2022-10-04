<?php

namespace App\Models;

use App\Models\Quotation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterAplikator extends Model
{
    use HasFactory;

    protected $table = "master_aplikators";

    public function quotation () {
        return $this->hasOne(Quotation::class);
    }
}
