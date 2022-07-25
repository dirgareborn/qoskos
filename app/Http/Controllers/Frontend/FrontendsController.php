<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{kamar,provinsi,Testimoni,User,SimpanKamar, Promo};
use Auth;
use Storage;
use Carbon\carbon;

class FrontendsController extends Controller
{
    // Homepage
    public function homepage(Request $request)
    {
      $cari = $request->cari;

      $kamar = kamar::with('promo')
      ->whereHas('provinsi', function($q) use ($cari) {
        $q->where('name', 'like', "%".$cari."%")
        ;
      })
      ->orwhereHas('regencies', function($q) use ($cari){
        $q->where('name', 'like', "%".$cari."%");
      })
      ->orwhereHas('district', function($q) use ($cari){
        $q->where('name', 'like', "%".$cari."%");
      })
      ->orwhere('nama_kamar', 'like', "%".$cari."%")
      ->orderBy('created_at','DESC')
      ->paginate(8);

      $promo = Promo::with('kamar')->where('status','1')->where('start_date_promo', '<=' ,carbon::now()->format('d F, Y'))->get();
      // return $promo;
      $testimoni = Testimoni::with('user')->orderby('created_at')->get();
      return view('front.index', \compact('kamar','promo','testimoni'));
    }

    // Pusat Bantuan

    public function pusatBantuan()
    {
      return view('front.pusatBantuan');
    }

    // Syarat dan Ketentuan

    public function syaratKetentuan()
    {
      return view('front.syaratKetentuan');
    }

    // Download APK

    public function downloadApk()
    {
        return response()->download('file/Qos_Kos_Situs__Pencarian_Kos_di_Kota_Makassar.apk');
    }

    // Show By Kategory

    public function showByKategori(Request $request)
    {
      $kategori = $request->category;
      $kamar = kamar::where('kategori', $kategori)
      ->orderBy('created_at','DESC')
      ->paginate(12);
      return view('front.showByKategori', \compact('kamar','kategori'));
    }

    // Show Kamar
    public function showkamar($slug)
    {
      $kamar = kamar::with('district')
      ->with('promo', function($q){
        $q->where('status','1');
      })
      ->where('slug', $slug)->first();
      $fav = SimpanKamar::where('kamar_id',$kamar->id)->where('user_id', Auth::id())->first();
      $relatedKos = kamar::with('promo')->whereNotIn('slug', [$slug])
        ->where('district_id', [$kamar->district_id])
        ->limit(4)->get();
      // dd($kamar);
      return view('front.show', compact('kamar','relatedKos','fav'));
    }

    // Show semua kamar
    public function showAllKamar(Request $request)
    {
      $cari = $request->cari;
      $allKamar = kamar::with('promo')
      ->whereHas('provinsi', function($q) use ($cari) {

        $q->where('name', 'like', "%".$cari."%")
        ;
      })
      ->orwhereHas('regencies', function($q) use ($cari){
        $q->where('name', 'like', "%".$cari."%");
      })
      ->orwhereHas('district', function($q) use ($cari){
        $q->where('name', 'like', "%".$cari."%");
      })

      ->orwhereHas('favorite', function($q) use ($cari){
        $q->where('user_id', 'like', "%".$cari."%")
        ->where('user_id', Auth::id());
      })
      ->orwhere('nama_kamar', 'like', "%".$cari."%")
      ->orderBy('created_at','DESC')
      ->paginate(12);

      $kecamatan = Kamar::with('district','promo')->select('district_id')->groupby('district_id')->get();
      $select = [];
      $select['jenis_kamar'] = $request->jenis_kamar;
      $select['name']        = $request->nama_district;
      $select['user_id']     = $request->user;
      return view('front.allCardContent', \compact('allKamar','select','kecamatan','cari'));
    }

    // Filter kamar
    public function filterKamar(Request $request)
    {
      if ($request->nama_district != 'all' && $request->jenis_kamar != 'all') {
        $allKamar = kamar::with('promo')->whereHas('district', function($q) use ($request) {
          $q->where('name', $request->nama_district);
        })
        ->where('jenis_kamar', $request->jenis_kamar)
        ->paginate(12);
      } elseif($request->nama_district == 'all' && $request->jenis_kamar != 'all') {
        $allKamar = kamar::with('promo')->where('jenis_kamar', $request->jenis_kamar)->paginate(12);
      } elseif($request->nama_district != 'all' && $request->jenis_kamar == 'all') {
          $allKamar = kamar::with('promo')->whereHas('district', function($q) use ($request) {
          $q->where('name', $request->nama_district);
        })
        ->orderBy('created_at','DESC')
        ->paginate(12);
      } else {
        $allKamar = kamar::with('promo')->orderBy('created_at','DESC')->paginate(12);
      }


      $select = [];
      $select['jenis_kamar'] = $request->jenis_kamar;
      $select['name']        = $request->nama_district;

      // select kecamatan
      $kecamatan = Kamar::with('district','promo')->select('district_id')->groupby('district_id')->get();
      return view('front.allCardContent', \compact('allKamar','select','kecamatan'));
    }

    // Show by Keccamatan
    public function showByKecamatan(Request $request)
    {
      $kecamatan = $request->kecamatan;
      $kamar = kamar::with('promo')->whereHas('district', function($q) use ($kecamatan) {
        $q->where('name', 'like', "%".$kecamatan."%");
      })
      ->orderBy('created_at','DESC')
      ->paginate(12);


      return view('front.showByKecamatan', \compact('kamar','kecamatan'));
    }

    // Simpan kamar
    public function simpanKamar(Request $request)
    {
      $simpan = new SimpanKamar;
      $simpan->user_id  = Auth::id();
      $simpan->kamar_id = $request->id;
      $simpan->save();

      return back();
    }

    // Hapus kamar disimpan
    public function hapusKamar(Request $request)
    {
      $hapus = SimpanKamar::find($request->id);
      $hapus->delete();

      return back();
    }

}
