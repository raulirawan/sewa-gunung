<?php

namespace App\Http\Controllers;

use App\Site;
use Exception;
use Whoops\Run;
use Midtrans\Snap;
use App\KuotaGunung;
use App\Transaction;
use Midtrans\Config;
use App\KetuaKelompok;
use Midtrans\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\KonfirmasiBooking;
use App\Mail\SuccessBooking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index()
    {
        $sites = Site::all();
        $site = Site::first();
        $periods = DB::table('kuota_gunung')
        ->select(DB::raw('YEAR(tanggal) as year, MONTH(tanggal) as month, MONTHNAME(tanggal) as month_name'))
        ->whereMonth('tanggal', Carbon::now()->month)
        ->groupBy('year')
        ->groupBy('month')
        ->orderBy('year','asc')
        ->orderBy('month','asc')
        ->get();

        $kuotaGunung = KuotaGunung::whereYear('tanggal', Carbon::now()->year)
                        ->whereMonth('tanggal', Carbon::now()->month)
                        ->where('site_id', $site->id)
                        ->orderBy('tanggal','asc')
                        ->where('tanggal', '>=', Carbon::today())
                        ->get();
        return view('booking', compact('sites','periods','kuotaGunung'));
    }

    public function tes(Request $request)
    {
        dd($request->all());
        $data_anggota = $request->data_anggota;

        $data_anggota = explode(',', $data_anggota);
        dd($data_anggota);

    }

    public function kuota(Request $request)
    {

        $sites = Site::all();
        $periods = DB::table('kuota_gunung')
        ->select(DB::raw('YEAR(tanggal) as year, MONTH(tanggal) as month, MONTHNAME(tanggal) as month_name'))
        ->whereMonth('tanggal', Carbon::now()->month)
        ->groupBy('year')
        ->groupBy('month')
        ->orderBy('year','asc')
        ->orderBy('month','asc')
        ->get();
        $bulan_tahun = explode('-', $request->bulan_tahun);

        $bulan = $bulan_tahun[0];
        $tahun = $bulan_tahun[1];
        $site_id = $request->site_id;

        $kuotaGunung = KuotaGunung::
          whereYear('tanggal', $tahun)
        ->whereMonth('tanggal', $bulan)
        ->where('site_id', $site_id)
        ->where('tanggal', '>=', Carbon::today())
        ->orderBy('tanggal','asc')
        ->get();

        return view('booking-kuota', compact('sites','periods','kuotaGunung','bulan','tahun','site_id'));
    }

    public function formBook($site_id, $tanggal)
    {
        $harga = Site::where('id',$site_id)->first()->harga;
        return view('booking-form', compact('site_id','tanggal','harga'));
    }

    public function formBookPost(Request $request)
    {
        // create Ketua Kelompok
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $kode_booking = 'GNG-'.mt_rand(00000,99999);
        $anggota_kelompok = $request->data_anggota_kelompok;

        if($anggota_kelompok != null) {
            $data_anggota = [];
            foreach ($anggota_kelompok as $key => $value) {
                $data_anggota [] = [
                    'nama_anggota' => $value[0],
                    'tanggal_lahir' => $value[1],
                    'jenis_kelamin' => $value[2],
                    'jenis_identitas' => $value[3],
                    'nomor_kartu' => $value[4],
                    'alamat_rumah' => $value[5],
                    'nomor_telepon' => $value[6],
                ];
            }

            $data_anggota = json_encode($data_anggota);
        }

        $ketua_kelompok = new KetuaKelompok();
        $ketua_kelompok->nama_ketua_kelompok = $request->nama_ketua;
        $ketua_kelompok->tanggal_lahir = $request->tanggal_lahir_ketua;
        $ketua_kelompok->jenis_kelamin = $request->jenis_kelamin_ketua;
        $ketua_kelompok->jenis_identitas = $request->jenis_identitas_ketua;
        $ketua_kelompok->nomor_kartu_identitas = $request->nomor_kartu_identitas_ketua;
        $ketua_kelompok->alamat_rumah = $request->alamat_rumah_ketua;
        $ketua_kelompok->provinsi = $request->provinsi;
        $ketua_kelompok->kota = $request->kota;
        $ketua_kelompok->kecamatan = $request->kecamatan;
        $ketua_kelompok->kelurahan = $request->kelurahan;
        $ketua_kelompok->nomor_telepon = $request->nonomor_telepon_ketuanmor;
        $ketua_kelompok->email = $request->email_ketua;
        $ketua_kelompok->save();

        // insert ke transaksi
        $transaction = new Transaction();

        $transaction->site_id = $request->site_id;
        $transaction->ketua_kelompok_id = $ketua_kelompok->id;
        $transaction->kode_booking = $kode_booking;
        $transaction->anggota_kelompok = $data_anggota ?? NULL;
        $transaction->tanggal_berangkat = $request->tanggal_kunjungan;
        $transaction->tanggal_pulang = $request->tanggal_pulang;
        $transaction->jumlah_pengunjung = $request->orang;
        $transaction->total_harga = $request->total_harga;
        $transaction->status = 'pending';
        $transaction->save();

        // kirim ke midtrans
        $midtrans_params = [
            'transaction_details' => [
                'order_id' => $kode_booking,
                'gross_amount' => (int) $request->total_harga,
            ],

            'customer_details' => [
                'first_name' => $request->nama_ketua,
                'email' => $request->email_ketua,
            ],
            'callbacks' => [
                'finish' => 'https://bookinggunungslamet.my.id/',
            ],
            'enable_payments' => ['bca_va','permata_va','bni_va','bri_va','gopay'],
            'vtweb' => [],
        ];

        try {
            //ambil halaman payment midtrans

            $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;

            $data = [
                'kode_booking' => $kode_booking,
                'nama_ketua' => $request->nama_ketua,
                'link_pembayaran' => $paymentUrl,
            ];

            if($ketua_kelompok != null && $transaction != null) {
                // kirim email
                Mail::to($request->email_ketua)->send(new KonfirmasiBooking($data));
                return response()->json([
                    'message' => 'Data Transaksi Berhasil di Buat',
                    'status'  => 'success',
                    'url' => $paymentUrl,
                ]);
            } else {
                return response()->json([
                    'message' => 'Data Transaksi Gagal di Buat, Coba Lagi Ya',
                    'status'  => 'gagal',
                    'url' => url('/booking'),
                ]);
            }
            //reditect halaman midtrans
        } catch (Exception $e) {
            echo $e->getMessage();
            return response()->json([
                'message' => 'Data Transaksi Gagal di Buat, Coba Lagi Ya',
                'status'  => 'gagal',
                'url' => url('/booking'),
            ]);
        }




    }

    public function callback(Request $request)
    {
            //set konfigurasi midtrans
            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            Config::$isSanitized = config('services.midtrans.isSanitized');
            Config::$is3ds = config('services.midtrans.is3ds');

            //buat instance midtrans
            $notification = new Notification();

            //assign ke variable untuk memudahkan coding

            $status = $notification->transaction_status;


            $transaction = Transaction::where('kode_booking', $notification->order_id)->first();

            // handler notification status midtrans
            if ($status == "settlement") {
                $transaction->status = 'disetujui';
                $transaction->save();

                $data = [
                    'nama_ketua' => $transaction->ketuaKelompok->nama_ketua_kelompok,
                    'kode_booking' => $transaction->kode_booking,
                ];
                Mail::to($transaction->ketuaKelompok->email)->send(new SuccessBooking($data));
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Success'
                    ]
                ]);
            } else if ($status == "pending") {
                $transaction->status = 'pending';
                $transaction->save();
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Pending'
                    ]
                ]);
            } else if ($status == 'deny') {
                $transaction->status = 'dibatalkan';
                $transaction->save();
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Deny'
                    ]
                ]);
            } else if ($status == 'expired') {
                $transaction->status = 'dibatalkan';
                $transaction->save();
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Expired'
                    ]
                ]);
            } else if ($status == 'cancel') {
                $transaction->status = 'dibatalkan';
                $transaction->save();
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Cancel'
                    ]
                ]);
            } else {
                $transaction->status = 'dibatalkan';
                $transaction->save();
                return response()->json([
                    'meta' => [
                        'code' => 500,
                        'message' => 'Midtrans Payment Gagal'
                    ]
                ]);
            }
    }
}
