<section id="component-swiper-centered-slides">
    <div class="card bg-transparent">
        <div class="card-header">
            <h4 style="color:black">Tesimonial Pemilik Kos</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="swiper-centered-slides swiper-container p-1">
                    <div class="swiper-wrapper">
                      @foreach ($testimoni as $testimonial)
                        <div class="swiper-slide rounded swiper-shadow">
                            @if ($testimonial->user->foto == NULL)
                            <img class="round" src="{{asset('assets/images/profile/profile.jpg')}}" alt="avatar" height="140" width="140">
                            @else
                                <img class="round" src="{{ url('storage/images/foto_profile/'. $testimonial->user->foto) }}" alt="avatar" height="140" width="140">
                            @endif
                            <div class="swiper-text pt-md-1 pt-sm-50"><small>{{$testimonial->testimoni}}</small></div>
                        </div>
                      @endforeach
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
</section>
