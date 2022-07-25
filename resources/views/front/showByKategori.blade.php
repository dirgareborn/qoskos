@extends('layouts.front.app')
@section('description')
  Qos kos, cari kos dan apartement makin mudah hanya di Qos Kos
@endsection
@section('title')
{{ucfirst(strtolower($kategori))}} - Qos Kos
@endsection

@section('content')
  
  <h2 class="mb-2" style="font-weight: bold; color:black">Ditemukan {{$kamar->count()}} Kamar</h2>

  <div class="row match-height">
    @forelse ($kamar as $kamars)
    <div class="col-xl-3 col-md-6 col-sm-12">
      <div class="card">
        <div class="card-content">
          <a href="{{url('room', $kamars->slug)}}">
            <img class="card-img-top img-fluid" src="{{asset('storage/images/bg_foto/' .$kamars->bg_foto)}}" alt="Card image cap" style="max-height: 180px;min-height:180px">
          </a>
          <div class="card-body">
            <a href="{{url('room', $kamars->slug)}}">
              <h5 style="min-height: 40px">{{$kamars->nama_kamar}} {{ucfirst(strtolower($kamars->district->name))}}</h5>
              <div class="d-flex-justify-content-between">
                <a href="" class="btn gradient-light-warning btn-sm">{{$kamars->jenis_kamar}}</a>
                <a href="#" class="btn btn-outline-{{$kamars->sisa_kamar > 5 ? 'primary' : 'danger'}} btn-sm {{$kamars->sisa_kamar > 5 ? 'primary' : 'danger'}}">Tersisa {{$kamars->sisa_kamar}} kamar</a>
              </div>
              <p class="card-text mt-1 mb-0"><i class="feather icon-map-pin"></i> {{$kamars->district->name}}</p>
              <span class="card-text" style="color: rgb(96, 93, 93);text-decoration: line-through">
                @if ($kamars->promo != null && $kamars->promo->status == 1 && $kamars->promo->start_date_promo <= Carbon\carbon::now()->format('d F, Y'))
                    {{rupiah($kamars->harga_kamar)}}
                @endif
              </span> <br>
              <span class="card-text" style="color: black"> {{rupiah(
                $kamars->promo != null && $kamars->promo->status == 1 && $kamars->promo->start_date_promo <= Carbon\carbon::now()->format('d F, Y')
                ? $kamars->promo->harga_promo : $kamars->harga_kamar)}} / Bulan
              </span>
            </a>
            <div class="card-btn d-flex justify-content-between mt-2">
              <a href="#" class="btn gradient-light-{{$kamars->kategori == 'Kost' ? 'warning' : 'info'}} text-white btn-sm">{{$kamars->kategori}}</a>
              <a href="#" class="btn btn-outline-warning btn-sm {{$kamars->book == 0 ? 'hidden' : ''}}">Bisa Booking</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @empty
    <div class="col" style="text-align:center">
      <img src="{{asset('assets/images/draw/undraw_page_not_found_re_e9o6.svg')}}" style="max-height: 350px">
      <p class="mt-2">Kamar yang kamu cari tidak ditemukan.</p>
    </div>
    @endforelse
  </div>
  <div style="text-align: center;" class="mt-1 mb-5">
    {{ $kamar->links() }}
  </div>
@endsection
