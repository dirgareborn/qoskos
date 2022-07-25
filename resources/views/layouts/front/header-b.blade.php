<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand d-xl-none" href="#">
        <img src="{{ asset('logo-footer.png')}}" width="150" height="auto" class="d-inline-block align-top" alt="logo-qos-kos">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

        <li class="nav-item active">
            <a class="nav-link" href="{{ route('download.apk') }}" style="color: black" ><i class="feather icon-airplay" data-toggle="tooltip" data-placement="bottom" title="Download Aplikasi"></i> Download Aplikasi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('show-all-room')}}" style="color: black"><i class="feather icon-calendar" data-toggle="tooltip" data-placement="top" title="Booking Kamar"></i> Booking Kamar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>


      </ul>






      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>fixe