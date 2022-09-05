<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ncr extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    protected $fillable = ["nama_mitra", "nama_projek", "nomor_ncr", "nomor_fppp","tanggal_ncr", "pelapor", "nomor_memo", "tanggal_memo", "alamat_pengiriman", "deadline_pengambilan"];

    public function kontak()
    {
        return $this->belongsToMany(Kontak::class);
    }
    
    public function ItemNcr()
    {
        return $this->hasMany(Item_Ncr::class, "item_id", "id");
    }
}
