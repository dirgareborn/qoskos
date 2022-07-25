<style>
  .navbar-bottom {
    overflow: hidden;
    background-color:#FFC107;
    position: fixed;
    bottom: 0;
    width: 100%;
    z-index:2;
  }

  .navbar-bottom a {
    /* float: left; */
    display: block;
    color: #FFC107;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }

  #navbar {
  transition: top 0.3s;
}

</style>

  <nav class="navbar navbar-bottom navbar-dark navbar-expand d-lg-none d-xl-none fixed-bottom" id="navbar">
    <ul class="navbar-nav nav-justified w-100">
      <li class="nav-item">
        <a href="/pusat-bantuan" class="nav-link text-white">Bantuan</a>
      </li>
      <li class="nav-item">
        <a href="/" class="nav-link text-white"><i class="feather icon-home"></i></a>
      </li>
      <li class="nav-item">
        <a href="/syarat-dan-ketentuan" class="nav-link text-white">Ketentuan</a>
      </li>
    </ul>
  </nav>
