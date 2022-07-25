<div class="horizontal-menu-wrapper ">
    <div class="header-navbar navbar-expand navbar navbar-horizontal floating-nav navbar-light" role="navigation" data-menu="menu-wrapper">
        <!-- Image and text -->
        <nav class="navbar navbar-light">
            <a class="navbar-brand" href="#">
            <img src="{{ asset('logo-footer.png')}}" width="140" height="auto" class="d-inline-block align-top" alt="logo-qos-kos">
            </a>
        </nav>
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <!-- include ../../../includes/mixins-->
            <ul class="nav navbar-nav pull-right" id="main-menu-navigation" data-menu="menu-navigation">
                <li data-menu="" class="dropdown">
                <a class="dropdown-toggle" data-i18n="Apartement" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #FF9F43;">
                    <i class="feather icon-grid"></i> Cari Apa?
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a  href="{{url('kategori')}}/apartment" data-i18n="Apartment" class="dropdown-item" style="color: #FF9F43;">
                        <i class="feather icon-grid"></i>Apartement</a>
                    <a class="dropdown-item" href="{{url('kategori')}}/kost" style="color: #FF9F43;"><i class="feather icon-home"></i>Kos</a>
                </div>
                </li>
                <li data-menu="">
                  <a href="/pusat-bantuan" data-i18n="Dashboard">
                    <i class="feather icon-help-circle"></i>Pusat Bantuan</a>
                </li>
                <li data-menu="">
                  <a href="/syarat-dan-ketentuan" data-i18n="Dashboard">
                    <i class="feather icon-book"></i>Syarat & Ketentuan</a>
                </li>
            </ul>
        </div>
    </div>
</div>
