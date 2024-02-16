@include('structure.header')
@include('structure.navbarPenyelenggara')
<!-- gray bg -->
<section class="tm-white-bg section-padding-bottom">
    <div class="container" style="height: 600px;">
        <br><br><br>
        <h2 class="text-center"><b>BERANDA</b></h2>
        <hr>
        <h3 class="text-center"><b>Hello {{ ucwords($name) }} Selamat Datang!</b></h3>
        <h4 class="text-center">Hak akses penyelenggara adalah mengelola menu konser.</h4>
    </div>
</section>
@include('structure.footer')