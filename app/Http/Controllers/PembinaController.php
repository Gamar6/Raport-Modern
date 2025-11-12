<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekskul;
use App\Models\Pembina;

class PembinaController extends Controller
{
    public function dashboardPembina()
    {
        // Ambil semua ekskul milik pembina yang login
        $pembina = auth()->user()->pembina;
        $ekskul = Ekskul::with('anggota')->where('pembina_id', $pembina->id)->get();

        return view('pages.pembina', compact('ekskul'));
    }
}

