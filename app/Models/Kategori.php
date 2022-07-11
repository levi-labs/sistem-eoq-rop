<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    public function kodeKategori()
    {
        $form_name = 'KTG';
        $kodeAdministrasi = '321608';


        $date = Carbon::now()->format('dmY');
        $kategori = Kategori::count();

        if ($kategori == 0) {
            $antrian = 00001;
            $nomor = 'KTG-' . sprintf('%05s', $antrian);
        } else {
            $last = Kategori::all()->last();
            $urut = (int)substr($last->kode_kategori, -5) + 1;

            $nomor = 'KTG-' . sprintf('%05s', $urut);
        }

        return $nomor;
    }
}
