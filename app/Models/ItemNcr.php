<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ncr;

class ItemNcr extends Model
{
    protected $fillable = [
        "kode_item", "nama_item", "jenis_kerusakan", "deskripsi",
        "analisa", "solusi", "bukti_kecacatan", "tipe_item", "warna",
        "bukaan", "lebar", "tinggi", "alasan", "charge", "return_barang", "keterangan"];

    public function ncr() {
        return $this->belongsTo(Ncr::class);
    }
}
