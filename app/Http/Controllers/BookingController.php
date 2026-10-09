<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Konsol;
use App\Models\Pelanggan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['pelanggan', 'konsol'])->latest()->get();
        return view('booking.index', compact('bookings'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::orderBy('nama')->get();
        $konsols = Konsol::orderBy('nama_konsol')->get();
        return view('booking.create', compact('pelanggans', 'konsols'));
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);

        if ($this->bentrok($data)) {
            return back()->withInput()->withErrors(['jam_mulai' => 'Konsol sudah dibooking pada jam tersebut']);
        }

        $data['total_harga'] = $this->hitungTotal($data);
        Booking::create($data);

        return redirect()->route('booking.index')->with('success', 'Booking berhasil ditambahkan');
    }

    public function edit(Booking $booking)
    {
        $pelanggans = Pelanggan::orderBy('nama')->get();
        $konsols = Konsol::orderBy('nama_konsol')->get();
        return view('booking.edit', compact('booking', 'pelanggans', 'konsols'));
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $this->validasi($request);

        if ($this->bentrok($data, $booking->id)) {
            return back()->withInput()->withErrors(['jam_mulai' => 'Konsol sudah dibooking pada jam tersebut']);
        }

        $data['total_harga'] = $this->hitungTotal($data);
        $booking->update($data);

        return redirect()->route('booking.index')->with('success', 'Booking berhasil diubah');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('booking.index')->with('success', 'Booking berhasil dihapus');
    }

    private function validasi(Request $request)
    {
        return $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'konsol_id' => 'required|exists:konsols,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'durasi' => 'required|integer|min:1|max:12',
            'status' => 'required|in:dipesan,selesai,batal',
        ]);
    }

    private function hitungTotal(array $data)
    {
        $konsol = Konsol::find($data['konsol_id']);
        return $konsol->harga_per_jam * $data['durasi'];
    }

    // true kalau jadwal bentrok dengan booking lain di konsol dan tanggal yang sama
    private function bentrok(array $data, $exceptId = null)
    {
        if ($data['status'] === 'batal') {
            return false;
        }

        $mulai = Carbon::parse($data['jam_mulai']);
        $selesai = $mulai->copy()->addHours((int) $data['durasi']);

        $lain = Booking::where('konsol_id', $data['konsol_id'])
            ->where('tanggal', $data['tanggal'])
            ->where('status', '!=', 'batal')
            ->when($exceptId, fn ($q) => $q->where('id', '!=', $exceptId))
            ->get();

        foreach ($lain as $b) {
            $bMulai = Carbon::parse($b->jam_mulai);
            $bSelesai = $bMulai->copy()->addHours($b->durasi);

            if ($mulai < $bSelesai && $selesai > $bMulai) {
                return true;
            }
        }

        return false;
    }
}