<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Konsol;
use App\Models\Pelanggan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KetersediaanController extends Controller
{
    const BUKA = 10;   // jam buka
    const TUTUP = 22;  // jam tutup

    public function index(Request $request)
    {
        $request->validate([
            'tanggal' => 'nullable|date',
            'jam' => 'nullable|integer|min:' . self::BUKA . '|max:' . (self::TUTUP - 1),
            'durasi' => 'nullable|integer|min:1|max:8',
        ]);

        $tanggal = $request->input('tanggal', now()->toDateString());
        $jam = $request->input('jam');
        $durasi = $request->input('durasi');
        $jamList = range(self::BUKA, self::TUTUP - 1);
        $hasil = null;
        $pesan = null;

        if ($jam !== null && $durasi !== null) {
            $awal = $jam * 60;
            $akhir = $awal + $durasi * 60;

            if ($akhir > self::TUTUP * 60) {
                $pesan = 'Durasi melewati jam tutup (' . self::TUTUP . ':00). Kurangi durasi atau pilih jam yang lebih awal.';
            } elseif (Carbon::parse($tanggal)->setTime((int) $jam, 0)->lte(now())) {
                $pesan = 'Jam yang dipilih sudah lewat. Pilih jam lain.';
            } else {
                $bookings = Booking::where('tanggal', $tanggal)
                    ->where('status', '!=', 'batal')
                    ->get()
                    ->groupBy('konsol_id');

                $hasil = Konsol::orderBy('nama_konsol')->get()->map(function ($k) use ($bookings, $awal, $akhir) {
                    $k->kosong = !$this->terisi($bookings->get($k->id, collect()), $awal, $akhir);
                    return $k;
                });
            }
        }

        return view('ketersediaan', compact('tanggal', 'jam', 'durasi', 'jamList', 'hasil', 'pesan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'no_hp' => ['required', 'regex:/^[0-9+]{8,15}$/'],
            'konsol_id' => 'required|exists:konsols,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i',
            'durasi' => 'required|integer|min:1|max:8',
        ]);

        $mulai = Carbon::parse($data['jam_mulai']);
        $awal = $mulai->hour * 60 + $mulai->minute;
        $akhir = $awal + $data['durasi'] * 60;

        if ($awal < self::BUKA * 60 || $akhir > self::TUTUP * 60) {
            return back()->withInput()->withErrors(['jam_mulai' => 'Jam di luar jam operasional']);
        }

        if (Carbon::parse($data['tanggal'] . ' ' . $data['jam_mulai'])->lte(now())) {
            return back()->withInput()->withErrors(['jam_mulai' => 'Jam yang dipilih sudah lewat']);
        }

        $bookings = Booking::where('konsol_id', $data['konsol_id'])
            ->where('tanggal', $data['tanggal'])
            ->where('status', '!=', 'batal')
            ->get();

        if ($this->terisi($bookings, $awal, $akhir)) {
            return back()->withInput()->withErrors(['jam_mulai' => 'Jam yang dipilih baru saja terisi, silakan pilih jam lain']);
        }

        $konsol = Konsol::find($data['konsol_id']);
        $pelanggan = Pelanggan::firstOrCreate(
            ['no_hp' => $data['no_hp']],
            ['nama' => $data['nama']]
        );

        Booking::create([
            'pelanggan_id' => $pelanggan->id,
            'konsol_id' => $konsol->id,
            'tanggal' => $data['tanggal'],
            'jam_mulai' => $data['jam_mulai'],
            'durasi' => $data['durasi'],
            'total_harga' => $konsol->harga_per_jam * $data['durasi'],
            'status' => 'dipesan',
        ]);

        return redirect()->route('ketersediaan', ['tanggal' => $data['tanggal']])
            ->with('success', 'Booking berhasil! Admin akan menghubungi nomor kamu untuk konfirmasi.');
    }

    // true kalau rentang menit [awal, akhir) bentrok dengan salah satu booking
    private function terisi($bookings, $awal, $akhir)
    {
        foreach ($bookings as $b) {
            $mulai = Carbon::parse($b->jam_mulai);
            $bAwal = $mulai->hour * 60 + $mulai->minute;
            $bAkhir = $bAwal + $b->durasi * 60;

            if ($bAwal < $akhir && $bAkhir > $awal) {
                return true;
            }
        }

        return false;
    }
}