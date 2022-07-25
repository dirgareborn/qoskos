@extends('layouts.front.app')
@section('description')
Qos Kos, cari kos dan apartement makin mudah hanya di Qos Kos
@endsection
@section('title')
  Selamat Datang di Qos Kos
@endsection
@section('content')
  @include('front.banner')
  @if ($promo->count() > 0)
    @include('front.sliderCard')
  @endif
  @include('front.cardContent')
  @include('front.byKecamatan')
  @include('front.testimoni')
@endsection
