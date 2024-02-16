<!-- Header -->
<div class="tm-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-3 tm-site-name-container">
                <a href="#" class="tm-site-name">Events App</a>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-9 flex">
                <div class="mobile-menu-icon" onclick="toggleMenu()">
                    <i class="fa fa-bars"></i>
                </div>
                <nav class="tm-nav">
                    <ul>
                        <?php
                        if ($pages == 'beranda') {
                            $m1 = 'active';
                            $m2 = '';
                            $m3 = '';
                            $m4 = '';
                            $m5 = '';
                        } elseif ($pages == 'dataKonser') {
                            $m1 = '';
                            $m2 = 'active';
                            $m3 = '';
                            $m4 = '';
                            $m5 = '';
                        } elseif ($pages == 'dataTransaksi') {
                            $m1 = '';
                            $m2 = '';
                            $m3 = 'active';
                            $m4 = '';
                            $m5 = '';
                        } elseif ($pages == 'dataPembeli') {
                            $m1 = '';
                            $m2 = '';
                            $m3 = '';
                            $m4 = 'active';
                            $m5 = '';
                        } else {
                            $m1 = '';
                            $m2 = '';
                            $m3 = '';
                            $m4 = '';
                            $m5 = 'active';
                        }
                        ?>
                        <li><a href="/admin" class="{{ $m1 }}">Beranda</a></li>
                        <li><a href="/admin/konser" class="{{ $m2 }}">Data Konser</a></li>
                        <li><a href="/admin/transaksi" class="{{ $m3 }}">Data Transaksi</a></li>
                        <li><a href="/admin/pembeli" class="{{ $m4 }}">Data Pembeli</a></li>
                        <li><a href="/logout" class="{{ $m5 }}">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
