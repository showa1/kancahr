<?php
namespace App\Http\Controllers\Transaksi;
use App\Http\Controllers\Controller;
class RiwayatKaryawanController extends Controller {
    public function index() { return view('transaksi.riwayat.index'); }
}
