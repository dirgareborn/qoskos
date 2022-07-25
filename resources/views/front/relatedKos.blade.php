<div class="card-btn d-flex justify-content-between mt-2">
    <h2 style="color:black">Kamu mungkin menyukainya</h2>
    <a href="{{url('show-all-room')}}" class="btn btn-outline-info mb-1" style="color:black">Lihat Lainnya</a>
</div>
<div class="row match-height">
  @forelse ($relatedKos as $kamars)
  <div class="col-xl-3 col-md-6 col-sm-12">
    <div class="card">
      <div class="card-content">
        <a href="{{url('room', $kamars->slug)}}">
          <img class="card-img-top img-fluid" src="{{asset('storage/images/bg_foto/' .$kamars->bg_foto)}}" alt="Card image cap" style="max-height: 180px">
        </a>
        <div class="card-body">
          <a href="{{url('room', $kamars->slug)}}">
            <h5 style="min-height: 40px">{{$kamars->nama_kamar}} {{ucfirst(strtolower($kamars->regencies->name))}}</h5>
            <div class="d-flex-justify-content-between">
              <a href="" class="btn gradient-light-warning btn-sm">{{$kamars->jenis_kamar}}</a>
              <a href="#" class="btn btn-outline-{{$kamars->sisa_kamar > 5 ? 'warning' : 'danger'}} btn-sm {{$kamars->sisa_kamar > 5 ? 'warning' : 'danger'}}">Tersisa {{$kamars->sisa_kamar}} kamar</a>
            </div>
            <p class="card-text mt-1 mb-0"><i class="feather icon-map-pin"></i> {{$kamars->village->name}} ,  {{$kamars->district->name}}</p>
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
  <div class="col-lg-12 col-md-12" style="text-align:center">
    <img src="{{asset('assets/images/draw/undraw_page_not_found_re_e9o6.svg')}}" style="max-height: 350px;width:100%">
    <p class="mt-2">Tidak ada kamar lain di temukan untuk kecamatan ini.</p>
  </div>
  @endforelse
</div>
